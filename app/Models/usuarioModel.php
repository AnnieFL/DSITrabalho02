<?php

namespace App\Models;
use CodeIgniter\Model;

class usuarioModel extends Model {

    protected $table = 'usuario';
    protected $primarykey = 'numero';
    protected $allowedFields = ['nome', 'senha','valor', 'dataLogin', 'dataLogout'];

    public function getData($id = null){
        if ($id == null){
            return $this->findAll();
        }
        return $this->asArray()->where(['numero' => $id])->first();
    }

    public function getDataName($name){
        return $this->asArray()->where(['nome' => $name])->first();
    }

    public function updateLogin($data) {
        $this->set('dataLogin', $data['dataLogin']);
        $this->set('dataLogout', $data['dataLogout']);
        $this->where('numero', $data['numero']);
        $this->update();
    }

    public function pagar($pagante, $valor, $pago = null) {
        if ($pago != null) {
            $result = $this->getData($pago);
            $result['valor'] += $valor;

            $this->set('valor', $result['valor']);
            $this->where('numero', $pago);
            $this->update();
        }
        $result = $this->getData($pagante);
        $result['valor'] -= $valor;

        $this->set('valor', $result['valor']);
        $this->where('numero', $pagante);
        return $this->update();
    }

    public function insert_data($data)
    {            
        return $this->insert($data);
    }
}

?>