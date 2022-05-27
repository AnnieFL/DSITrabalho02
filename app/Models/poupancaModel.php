<?php

namespace App\Models;
use CodeIgniter\Model;

class poupancaModel extends Model {

    protected $table = 'poupanca';
    protected $primarykey = 'id';
    protected $allowedFields = ['valor','dataAumento', 'numero'];

    public function getData($id = null){
        if ($id == null){
            return $this->findAll();
        }
        return $this->asArray()->where(['numero' => $id])->first();
    }

    public function getDataUser($user) {
        return $this->where(['usuario' => $user])->findAll();
    }

    public function insert_data($data)
    {            
        return $this->insert($data);
    }
}

?>