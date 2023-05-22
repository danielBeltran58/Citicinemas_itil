<?php

namespace Models;

class Activo {

    public function __construct( public $id, public $areaComplejo, public $estado ) {
        $this->id = $id;
        $this->areaComplejo = $areaComplejo;
        $this->estado = $estado;
    }

    public function devolverContextoEstado() {
        switch ($this->estado) {
            case '1':
                return 'FUNCIONANDO';
                break;
            case '2':
                return 'EN PROCESO DE INCIDENCIA';
                break;
            case '3':
                return 'INUTILIZABLE';
                break;
        }
    }

    public function devolverInformacionSelect() {
        return $this->id . ' ' . $this->marca . ' ' . $this->modelo;
    }

}

?>