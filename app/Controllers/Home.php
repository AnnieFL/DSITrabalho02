<?php
namespace App\Controllers;
use App\Models\usuarioModel;
use App\Models\extratoModel;

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
        if (isset($_GET['login']) && $_GET['login']) {

            $data = $Usuario->getDataName($_POST['nome']);
            if (isset($data['senha']) && password_verify($_POST['senha'], $data['senha'])) {
                date_default_timezone_set('America/Sao_Paulo'); 
                $data['dataLogin'] = date("Y-m-d H:i:s", time());
                $data['dataLogout'] = date("Y-m-d H:i:s", strtotime("+10 minutes"));
                
                $Usuario->updateLogin($data);
            } else {
                $data['error'] = "Nome ou senha incorretos, tente novamente!";
                $data['login'] = true;
                return view('cadastro', $data);
            }
        } else {
            if ($Usuario->getDataName($_POST['nome']) == []) {
                $data['numero'] = rand(10000000,99999999);
                $data['nome'] = $_POST['nome'];
                $data['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                date_default_timezone_set('America/Sao_Paulo'); 
                $data['valor'] = 100;
                $data['dataLogin'] = date("Y-m-d H:i:s", time());
                $data['dataLogout'] = date("Y-m-d H:i:s", strtotime("+10 minutes"));
                
                $Usuario->insert($data);
            } else {
                $data['error'] = "Nome em uso, tente novamente!";
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
        $data = $Usuario->getData(session()->get('user'));
        date_default_timezone_set('America/Sao_Paulo'); 
        $data['dataLogin'] = date("Y-m-d H:i:s", time());
        $data['dataLogout'] = date("Y-m-d H:i:s", strtotime("+10 minutes"));
        $Usuario->updateLogin($data);
    

        session()->set('user', null);
        return redirect('/');
    }

    public function extratos() 
    {
        $Extrato = new ExtratoModel();
        $data['extratos'] = $Extrato->getDataUser(session()->get('user'));

        return view('extratos',$data);
    }

    public function pagamentos() {
        $Usuario = new UsuarioModel();
        $data['user'] = $Usuario->getData(session()->get('user'));

        return view('pagamentos',$data);
    }

    public function pagar() {
        $data = $_POST;
        date_default_timezone_set('America/Sao_Paulo'); 
        $data['data'] = date("Y-m-d H:i:s", time());

        $Usuario = new UsuarioModel();
        $Extrato = new ExtratoModel();

        $pago = $Usuario->getData($data['destino']);
        if ($pago != []) {
            $pagante = $Usuario->getData($data['usuario']);
            
            $data2 = $_POST;
            $data2['tipo'] .= ' (recebido)';
            $data2['data'] = $data['data'];
            $data2['destino'] = $pagante['nome']." (".$data['usuario'].')';
            $data2['usuario'] = $data['destino'];    
            $data['destino'] = $pago['nome']." (".$pago['numero'].")";
            
            $Extrato->insert($data2);
            
            $pago = $pago['numero'];
        } else {
            $pago = null;
        }
        $Usuario->pagar($data['usuario'], $data['valor'], $pago);

        $Extrato->insert($data);
        
        return redirect('/');
    }

    public function transferencias() {
        $Usuario = new UsuarioModel();
        $data['user'] = $Usuario->getData(session()->get('user'));

        $data['users'] = $Usuario->getData();

        return view('transferencias',$data);
    }

    public function transferir() {
        $data = $_POST;
        date_default_timezone_set('America/Sao_Paulo'); 
        $data['data'] = date("Y-m-d H:i:s", time());

        $Usuario = new UsuarioModel();
        $Extrato = new ExtratoModel();

        $pago = $Usuario->getData($data['destino']);
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
        
        return redirect('/');
    }

    
}
