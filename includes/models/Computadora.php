<?php

namespace Models;

class Computadora extends Activo {

    public function __construct( public $id, public $areaComplejo, public $estado, public $modelo, public $marca, public $almacenamiento, public $ram, public $procesador, public $tarjetaGrafica, public $sistemaOperativo ) {
        $this->id = $id;
        $this->areaComplejo = $areaComplejo;
        $this->estado = $estado;
        $this->modelo = $modelo;
        $this->marca = $marca;
        $this->almacenamiento = $almacenamiento;
        $this->ram = $ram;
        $this->procesador = $procesador;
        $this->tarjetaGrafica = $tarjetaGrafica;
        $this->sistemaOperativo = $sistemaOperativo;
    }

    public function registrarComputadora( $conn ) {
        $sql = mysqli_query($conn, "call registrar_computadora('$this->modelo', '$this->marca', '$this->sistemaOperativo', '$this->almacenamiento', '$this->ram', '$this->procesador', '$this->tarjetaGrafica', '$this->areaComplejo')");
    }

}

?>