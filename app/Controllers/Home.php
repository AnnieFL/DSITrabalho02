<?php
namespace App\Controllers;
use App\Models\usuarioModel;
use App\Models\extratoModel;
use App\Models\poupancaModel;
use App\Models\auditoriaModel;

class Home extends BaseController
{
    public function index()
    {
        if (!isset($_GET['login'])) {
            $_GET['login'] = false;
        }
        
        $numero = session()->get('user');
        if ($numero) {
            $Usuario = new UsuarioModel();
            $data['user'] = $Usuario->getData($numero);

            return view('index', $data);
        } else {
            return view('cadastro', $_GET);
        }
    }
    
    public function cadastrar()
    {
        $Usuario = new UsuarioModel();
        $Poupanca = new PoupancaModel();
        $Auditoria = new AuditoriaModel();
        if (isset($_GET['login']) && $_GET['login']) {

            $data = $Usuario->getDataName($_POST['nome']);
            if (isset($data['senha']) && password_verify($_POST['senha'], $data['senha'])) {
                date_default_timezone_set('America/Sao_Paulo'); 

                $year = date('Y', strtotime($data['dataLogin']));
                
                $data['dataLogin'] = date("Y-m-d H:i:s", time());
                $data['dataLogout'] = date("Y-m-d H:i:s", strtotime("+10 minutes"));
                
                $diff = date('Y', strtotime($data['dataLogin'])) > $year; 
                if ($diff > 0) {
                    $Poupanca->applyTax($data['numero'], $diff);
                }

                $data2['usuario'] = $data['numero'];
                $data2['data'] = $data['dataLogin'];
                $data2['tipo'] = "login";
                
                $Usuario->updateLogin($data);
                $Auditoria->insert($data2);
            } else {
                session()->setFlashdata('error', "Nome ou senha incorretos, tente novamente!");
                $data['login'] = true;
                return view('cadastro', $data);
            }
        } else {
            if ($Usuario->getDataName($_POST['nome']) == []) {
                if ($_POST['nome'] == "" || $_POST['senha'] == "") {
                    session()->setFlashdata('error', "Por favor, preencha todos os campos!");
                    $data['login'] = false;
                    return view('cadastro', $data);
                }
                $data['numero'] = rand(10000000,99999999);
                while ($Usuario->getData($data['numero']) != null) {
                    $data['numero'] = rand(10000000,99999999);
                }

                $data['nome'] = $_POST['nome'];
                $data['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                date_default_timezone_set('America/Sao_Paulo'); 
                $data['valor'] = 100;
                $data['dataLogin'] = date("Y-m-d H:i:s", time());
                $data['dataLogout'] = date("Y-m-d H:i:s", strtotime("+10 minutes"));
                
                $Usuario->insert($data);

                $data2['usuario'] = $data['numero'];
                $data2['valor'] = 0;
                
                $Poupanca->insert($data2);
            } else {
                session()->setFlashdata('error', "Nome em uso, tente novamente!");
                $data['login'] = false;
                return view('cadastro', $data);
            }
        }
                
        session()->set('user', $data['numero']);
        
        return redirect('/');
    }

    public function logout()
    {
        $Usuario = new UsuarioModel();
        $Auditoria = new AuditoriaModel();
        $data = $Usuario->getData(session()->get('user'));

        
        date_default_timezone_set('America/Sao_Paulo'); 
        $data['dataLogout'] = date("Y-m-d H:i:s", time());
        $Usuario->updateLogin($data);

        $data2['usuario'] = $data['numero'];
        $data2['data'] = $data['dataLogout'];
        $data2['tipo'] = "logout";
    
        $Auditoria->insert($data2);

        session()->set('user', null);
        return redirect('/');
    }

    public function extratos() 
    {
        $user = session()->get('user');
        if (!$user) {
            session()->setFlashData('error', "Cadastre-se primeiro!");
            $data['cadastro'] = false;
            return view('cadastro', $data);
        }
        $Extrato = new ExtratoModel();
        $data['extratos'] = $Extrato->getDataUser(session()->get('user'));

        return view('extratos',$data);
    }

    public function pagamentos() {
        $user = session()->get('user');
        if (!$user) {
            session()->setFlashData('error', "Cadastre-se primeiro!");
            $data['cadastro'] = false;
            return view('cadastro', $data);
        }
        $Usuario = new UsuarioModel();
        $data['user'] = $Usuario->getData(session()->get('user'));

        return view('pagamentos',$data);
    }

    public function detalhar($id) {
        $user = session()->get('user');
        if (!$user) {
            session()->setFlashData('error', "Cadastre-se primeiro!");
            $data['cadastro'] = false;
            return view('cadastro', $data);
        }
        $Extrato = new ExtratoModel();

        $data['extrato'] = $Extrato->getData($id);
        if ($data['extrato']['usuario'] == session()->get('user')) {
            return view('detalha', $data);
        } else {
            return redirect('/');
        }
    }

    public function pagar() {
        $user = session()->get('user');
        if (!$user) {
            session()->setFlashData('error', "Cadastre-se primeiro!");
            $data['cadastro'] = false;
            return view('cadastro', $data);
        }

        
        $data = $_POST;
        date_default_timezone_set('America/Sao_Paulo'); 
        $data['data'] = date("Y-m-d H:i:s", time());
        
        $Usuario = new UsuarioModel();
        $Extrato = new ExtratoModel();
        
        $ValorUsuario = $Usuario->getData(session()->get('user'));
        if ($_POST['valor'] > $ValorUsuario['valor']) {
            session()->setFlashData('error', "Saldo inválido");
            return redirect('/');       
        }

        $pago = $Usuario->getData($data['destino']);
        if ($pago != null) {
            $pagante = $Usuario->getData($data['usuario']);
            
            $data2 = $_POST;
            $data2['tipo'] .= ' (recebido)';
            $data2['data'] = $data['data'];
            $data2['destino'] = $pagante['nome']." (".$data['usuario'].')';
            $data2['usuario'] = $data['destino'];    
            $data['destino'] = $pago['nome']." (".$pago['numero'].")";
            
            $Extrato->insert($data2);
            
            $pago = $pago['numero'];
        }
        $Usuario->pagar($data['usuario'], $data['valor'], $pago);

        $Extrato->insert($data);
        
        return redirect('/');
    }

    public function transferencias() {
        $user = session()->get('user');
        if (!$user) {
            session()->setFlashData('error', "Cadastre-se primeiro!");
            $data['cadastro'] = false;
            return view('cadastro', $data);
        }
        
        $Usuario = new UsuarioModel();
        $data['user'] = $Usuario->getData(session()->get('user'));

        $data['users'] = $Usuario->getData();

        return view('transferencias',$data);
    }

    public function transferir() {
        $user = session()->get('user');
        if (!$user) {
            session()->setFlashData('error', "Cadastre-se primeiro!");
            $data['cadastro'] = false;
            return view('cadastro', $data);
        }
        
        
        $data = $_POST;
        date_default_timezone_set('America/Sao_Paulo'); 
        $data['data'] = date("Y-m-d H:i:s", time());
        
        $Usuario = new UsuarioModel();
        $Extrato = new ExtratoModel();

        $ValorUsuario = $Usuario->getData(session()->get('user'));
        if ($_POST['valor'] > $ValorUsuario['valor']) {
            session()->setFlashData('error', "Saldo inválido");
            return redirect('/');       
        }
        
        $pago = $Usuario->getData($data['destino']);
        if ($pago != null) {
            $pagante = $Usuario->getData($data['usuario']);
            
            $data2 = $_POST;
            $data2['tipo'] .= ' (recebido)';
            $data2['data'] = $data['data'];
            $data2['destino'] = $pagante['nome']." (".$data['usuario'].')';
            $data2['usuario'] = $data['destino'];    
            $data['destino'] = $pago['nome']." (".$pago['numero'].")";
            
            $Usuario->pagar($data['usuario'], $data['valor'], $pago['numero']);
            
            $Extrato->insert($data);
            $Extrato->insert($data2);
        } else {
            session()->setFlashData('error', "O destinatário não existe!");
        }

        
        return redirect('/');
    }

    public function poupanca() {
        $user = session()->get('user');
        if (!$user) {
            session()->setFlashData('error', "Cadastre-se primeiro!");
            $data['cadastro'] = false;
            return view('cadastro', $data);
        }

        $Usuario = new UsuarioModel();
        $Poupanca = new PoupancaModel();
        
        $data['user'] = $Usuario->getData(session()->get('user'));
        
        $data['poupanca'] = $Poupanca->getDataUser($data['user']['numero']);
        $data['poupanca'] = $data['poupanca'][0];

        return view('poupanca', $data);
    }

    public function depositar() {
        $user = session()->get('user');
        if (!$user) {
            session()->setFlashData('error', "Cadastre-se primeiro!");
            $data['cadastro'] = false;
            return view('cadastro', $data);
        }

        $Usuario = new UsuarioModel();
        $Poupanca = new PoupancaModel();

        if (isset($_POST['sacar']) && $_POST['sacar']) {
            $ValorPoupanca = $Poupanca->getData(session()->get('user'));
            if ($_POST['valor'] > $ValorPoupanca['valor']) {
                session()->setFlashData('error', "Saldo inválido");
                return redirect('/');       
            }

            $Usuario->alterValue(session()->get('user'), $_POST['valor']);
            $Poupanca->alterValue(session()->get('user'), -1*$_POST['valor']);
        } else {
            $ValorUsuario = $Usuario->getData(session()->get('user'));
            if ($_POST['valor'] > $ValorUsuario['valor']) {
                session()->setFlashData('error', "Saldo inválido");
                return redirect('/');       
            }

            $Poupanca->alterValue(session()->get('user'), $_POST['valor']);
            $Usuario->alterValue(session()->get('user'), -1*$_POST['valor']);
        }

        return redirect('/');
    }
    
    public function adicao() {
        $user = session()->get('user');
        if (!$user) {
            session()->setFlashData('error', "Cadastre-se primeiro!");
            $data['cadastro'] = false;
            return view('cadastro', $data);
        }
        
        $Usuario = new UsuarioModel();
        $data['user'] = $Usuario->getData(session()->get('user'));

        return view('adicionar',$data);
    }

    public function adicionar() {
        $user = session()->get('user');
        if (!$user) {
            session()->setFlashData('error', "Cadastre-se primeiro!");
            $data['cadastro'] = false;
            return view('cadastro', $data);
        }
        
        $Usuario = new UsuarioModel();
        $usuario = $Usuario->getData($user);
        
        $data = $_POST;
        date_default_timezone_set('America/Sao_Paulo'); 
        $data['data'] = date("Y-m-d H:i:s", time());
        $data['destino'] = $usuario['nome']." (".$data['usuario'].")";
        
        $Extrato = new ExtratoModel();
        
        $Usuario->pagar(null, $data['valor'], $data['usuario']);
            
        $Extrato->insert($data);
        
        return redirect('/');
    }


}
