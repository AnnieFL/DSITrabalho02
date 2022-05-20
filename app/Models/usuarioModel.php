<?php

namespace App\Models;
use CodeIgniter\Model;

class usuarioModel extends Model {

    protected $table = 'usuario';
    protected $primaryKey = 'numero';
    protected $allowedFields = ['nome', 'senha','valor', 'dataLogin', 'dataLogout'];

    public function getData($id = null){
        if ($id == null){
            return $this->findAll();
        }
        return $this->asArray()->where(['id' => $id])->first();
    }

    public function insert_data($data)
    {            
        return $this->insert($data);
    }
}

?>