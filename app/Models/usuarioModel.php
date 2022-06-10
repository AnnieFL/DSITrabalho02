<?php

namespace App\Models;
use CodeIgniter\Model;

class usuarioModel extends Model {

    protected $table = 'usuario';
    protected $primarykey = 'id';
    protected $allowedFields = ['numero', 'nome', 'senha','valor', 'dataLogin', 'dataLogout'];

    public function getData($numero = null){
        if ($numero == null){
            return $this->findAll();
        }
        return $this->asArray()->where(['numero' => $numero])->first();
    }

    public function getDataName($name){
        return $this->asArray()->where(['nome' => $name])->first();
    }

    public function updateLogin($data) {
        $this->set('dataLogin', $data['dataLogin']);
        $this->set('dataLogout', $data['dataLogout']);
        $this->where('numero', $data['numero']);
        return $this->update();
    }

    public function pagar($pagante = null, $valor, $pago = null) {
        if ($pago != null) {
            $result = $this->getData($pago);
            $result['valor'] += $valor;

            $this->set('valor', $result['valor']);
            $this->where('numero', $pago);
            $this->update();
        }
        if ($pagante != null) {
            $result = $this->getData($pagante);
            $result['valor'] -= $valor;
            
            $this->set('valor', $result['valor']);
            $this->where('numero', $pagante);
            return $this->update();
        }
    }

    public function alterValue($usuario, $valor) {
        $data = $this->asArray()->where(['numero' => $usuario])->first();

        $valor = $data['valor'] + $valor;
        $this->set('valor', $valor);
        $this->where('numero', $usuario);
        return $this->update();
    }

    public function insert_data($data)
    {            
        return $this->insert($data);
    }
}

?>