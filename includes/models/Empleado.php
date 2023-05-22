<?php

namespace Models;

use Models\Incidencia;

class Empleado {

    private $id;
    private $nombre;
    private $apellidoP;
    private $rol;
    private $apellidoM;
    private $email;
    private $contrasena;
    private $areaComplejo;

    public function __construct( $id, $nombre, $apellidoP, $apellidoM, $rol, $areaComplejo, $email, $contrasena ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidoP = $apellidoP;
        $this->apellidoM = $apellidoM;
        $this->areaComplejo = $areaComplejo;
        $this->rol = $rol;
        $this->email = $email;
        $this->contrasena = $contrasena;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidoP() {
        return $this->apellidoP;
    }
    
    public function getApellidoM() {
        return $this->apellidoM;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function getAreaComplejo() {
        return $this->areaComplejo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidoP($apellidoP) {
        $this->apellidoP = $apellidoP;
    }

    public function setApellidoM($apellidoM) {
        $this->apellidoM = $apellidoM;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function setAreaComplejo($areaComplejo) {
        $this->areaComplejo = $areaComplejo;
    }

    public function devolverNombreCompleto() {
        return $this->nombre . ' ' . $this->apellidoP . ' ' . $this->apellidoM;
    }

    public function devolverNombreAreaComplejoPorId( $conn ) {
        $sql = $conn->query("select areacomplejo.nombre from areacomplejo where areacomplejo.id = '{$this->areaComplejo}'");
        return $sql->fetch_assoc()['nombre'];
    }

    public function devolverNombreComplejo( $conn ) {
        $sql = $conn->query("select complejo.nombre from areacomplejo inner join complejo on complejo.id = areacomplejo.corporativo where areacomplejo.id = '{$this->areaComplejo}'");
        return $sql->fetch_assoc()['nombre'];
    }

    public function devolverTecnicosPorArea( $conn ) {
        $sql = $conn->query("select * from Empleado where rol = 'TECNICO' and areaComplejo = '{$this->areaComplejo}'");
        $tecnicos = [];
        while($tecnico = $sql->fetch_assoc()) {
            $tecnicos[] = new Empleado(
                $tecnico['id'],
                $tecnico['nombre'],
                $tecnico['apellidoP'],
                $tecnico['apellidoM'],
                $tecnico['rol'],
                $tecnico['areaComplejo'],
                $tecnico['email'],
                $tecnico['contrasena'],
            );
        }
        return $tecnicos; 
    }

    public function devolverIncidenciasDeTecnico( $conn ) {
        $sql = $conn->query("select * from Incidencia where tecnico = '{$this->id}'");
        $incidencias = [];
        while( $inc = $sql->fetch_assoc() ) {
            $incidencias[] = new Incidencia(
                $inc['id'],
                $inc['activo'],
                $inc['asunto'],
                $inc['tecnico'],
                $inc['inicio'],
                $inc['termino'],
                $inc['estado'],
            );
        }
        return $incidencias;
    }

    public function devolverIncidenciasDeAreaImpresora( $conn ) {
        $sql = $conn->query("select incidencia.id as idIncidencia, activo.id as idActivo, incidencia.asunto as asunto, incidencia.tecnico as tecnico, incidencia.inicio as inicio, incidencia.termino as termino, incidencia.estado as estado from ((incidencia inner join activo on activo.id = incidencia.activo)
        inner join impresora on impresora.activo = activo.id) where activo.areaComplejo = '{$this->areaComplejo}'");
        $incidencias = [];
        while( $inc = $sql->fetch_assoc() ) {
            $incidencias[] = new Incidencia(
                $inc['idIncidencia'],
                $inc['idActivo'],
                $inc['asunto'],
                $inc['tecnico'],
                $inc['inicio'],
                $inc['termino'],
                $inc['estado'],
            );
        }
        return $incidencias;
    }

    public function devolverIncidenciasDeAreaComputadora( $conn ) {
        $sql = $conn->query("select incidencia.id as idIncidencia, activo.id as idActivo, incidencia.asunto as asunto, incidencia.tecnico as tecnico, incidencia.inicio as inicio, incidencia.termino as termino, incidencia.estado as estado from ((incidencia inner join activo on activo.id = incidencia.activo)
        inner join computadora on computadora.activo = activo.id) where activo.areaComplejo = '{$this->areaComplejo}'");
        $incidencias = [];
        while( $inc = $sql->fetch_assoc() ) {
            $incidencias[] = new Incidencia(
                $inc['idIncidencia'],
                $inc['idActivo'],
                $inc['asunto'],
                $inc['tecnico'],
                $inc['inicio'],
                $inc['termino'],
                $inc['estado'],
            );
        }
        return $incidencias;
    }

}