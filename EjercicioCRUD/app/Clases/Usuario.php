<?php
namespace App\Clases;
/**
 * Description of Usuario
 *
 * @author alejandro
 */
class Usuario {
    private $dni;
    private $nombre;
    private $apellidos;
    private $email;
    private $contra;
    private $activado;
    private $roles;
    
    function __construct() {
        $this->dni = '';
        $this->nombre = '';
        $this->apellidos = '';
        $this->email = '';
        $this->contra = '';
        $this->activado = '';
        $this->roles = [];
    }

    function getDni() {
        return $this->dni;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getContra() {
        return $this->contra;
    }

    function getActivado() {
        return $this->activado;
    }

    function setDni($dni): void {
        $this->dni = $dni;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setContra($contra): void {
        $this->contra = $contra;
    }

    function setActivado($activado): void {
        $this->activado = $activado;
    }
    
    function getRoles() {
        return $this->roles;
    }

    public function addRol($rol) {
        $this->roles[] = $rol;
    }

}
