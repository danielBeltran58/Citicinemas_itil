<?php

namespace Models;

class Incidencia {

    public function __construct( public $id, public $activo, public $asunto, public $tecnico, public $inicio, public $termino, public $estado ) {
        $this->id = $id;
        $this->activo = $activo;
        $this->asunto = $asunto;
        $this->tecnico = $tecnico;
        $this->inicio = $inicio;
        $this->termino = $termino;
        $this->estado = $estado;
    }

    public function registrarIncidencia( $conn ) {
        $sql = mysqli_query($conn, "call levantar_incidencia('$this->activo', '$this->asunto', '$this->tecnico', '$this->inicio', '$this->termino')");
    }

    public function devolverContextoEstadoIncidencia() {
        switch ($this->estado) {
            case '1':
                return 'EN PROCESO';
                break;
            case '2':
                return 'RETRASADO';
                break;
            case '3':
                return 'COMPLETADO';
                break;
        }
    }

}

?>