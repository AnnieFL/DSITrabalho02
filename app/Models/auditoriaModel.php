<?php

namespace App\Models;
use CodeIgniter\Model;

class auditoriaModel extends Model {

    protected $table = 'auditoria';
    protected $primarykey = 'id';
    protected $allowedFields = ['usuario','data', 'tipo'];

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