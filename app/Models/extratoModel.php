<?php

namespace App\Models;
use CodeIgniter\Model;

class extratoModel extends Model {

    protected $table = 'extrato';
    protected $primarykey = 'id';
    protected $allowedFields = ['tipo','data', 'descricao','valor','destino','usuario'];

    public function getData($id = null){
        if ($id == null){
            return $this->findAll();
        }
        return $this->asArray()->where(['id' => $id])->first();
    }

    public function getDataUser($user) {
        return $this->where(['usuario' => $user])->findAll();
    }

    public function getDataName($name){
        return $this->asArray()->where(['nome' => $name])->first();
    }

    public function insert_data($data)
    {            
        return $this->insert($data);
    }
}

?>