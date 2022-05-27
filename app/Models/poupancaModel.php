<?php

namespace App\Models;
use CodeIgniter\Model;

class poupancaModel extends Model {

    protected $table = 'poupanca';
    protected $primarykey = 'id';
    protected $allowedFields = ['valor', 'usuario'];

    public function getData($id = null){
        if ($id == null){
            return $this->findAll();
        }
        return $this->asArray()->where(['id' => $id])->first();
    }

    public function applyTax($usuario, $years) {
        $valor = $this->asArray()->where(['usuario' => $usuario])->first();
        $valor = $valor['valor'];
        $valor += ((6.2/100)*$valor)*$years;
        
        $this->set('valor', $valor);
        $this->where('usuario', $usuario);
        return $this->update();
    }

    public function getDataUser($user) {
        return $this->where(['usuario' => $user])->findAll();
    }

    public function alterValue($usuario, $valor) {
        $data = $this->asArray()->where(['usuario' => $usuario])->first();

        $valor = $data['valor'] + $valor;
        $this->set('valor', $valor);
        $this->where('usuario', $usuario);
        return $this->update();
    }

    public function insert_data($data)
    {            
        return $this->insert($data);
    }
}

?>