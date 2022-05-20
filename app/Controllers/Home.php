<?php

namespace App\Controllers;
use App\Models\usuarioModel;

class Home extends BaseController
{
    public function index()
    {
        $data['user'] = session()->get('user');
        if ($data['user']) {
            return view('index', $data);
        } else {
            return view('cadastro');
        }
    }

    public function cadastrar()
    {
        $data = $_POST;
        $data['numero'] = rand(10000000,99999999);
        date_default_timezone_set('America/Sao_Paulo'); 
        $data['dataLogout'] = date("Y-m-d H:i:s", strtotime("+10 minutes"));
        $data['valor'] = 100;
        $data['dataLogin'] = date("Y-m-d H:i:s", time());
        
        $Usuario = new UsuarioModel();
        $Usuario->insert($data);
        
        session()->set('user', $data['nome']);
        
        return redirect('/');
    }

    public function logout()
    {
        session()->set('user', null);
        return redirect('/');
    }
}
