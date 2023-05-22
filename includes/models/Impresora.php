<?php

namespace Models;

class Impresora extends Activo {

    public function __construct( public $id, public $areaComplejo, public $estado, public $marca, public $modelo, public $tipoConector, public $tecnologiaImpresion, public $velocidadImpresionMonocromatrica, public $velocidadImpresionColor ) {
        $this->id = $id;
        $this->areaComplejo = $areaComplejo;
        $this->estado = $estado;
        $this->modelo = $modelo;
        $this->marca = $marca;
        $this->tipoConector = $tipoConector;
        $this->tecnologiaImpresion = $tecnologiaImpresion;
        $this->velocidadImpresionMonocromatrica = $velocidadImpresionMonocromatrica;
        $this->velocidadImpresionColor = $velocidadImpresionColor;
    }

    public function registrarImpresora( $conn ) {
        $sql = mysqli_query($conn, "call registrar_impresora('$this->modelo', '$this->marca', '$this->tipoConector', '$this->tecnologiaImpresion', '$this->velocidadImpresionColor', '$this->velocidadImpresionMonocromatrica', '$this->areaComplejo')");
    }

    public function devolverContextoTipoConector() {
        switch($this->tipoConector) {
            case '1':
                return 'USB';
                break;
            case '2':
                return 'BLUETOOTH';
                break;
            case '3':
                return 'USB Y BLUETOOTH';
                break;
        }
    }

    public function devolverContextoTecnologiaImpresion() {
        switch($this->tecnologiaImpresion) {
            case '1':
                return 'INYECCION DE TINTA';
                break;
            case '2':
                return 'LASER';
                break;
            case '3':
                return 'TERMICA';
                break;
        }
    }

}

?>