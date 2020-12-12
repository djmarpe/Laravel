<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Clases;

/**
 * Description of Coche
 *
 * @author alejandro
 */
class Coche {
    private $matricula;
    private $marca;
    private $modelo;
    
    function __construct() {
        $this->matricula = '';
        $this->marca = '';
        $this->modelo = '';
    }

    function getMatricula() {
        return $this->matricula;
    }

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function setMatricula($matricula): void {
        $this->matricula = $matricula;
    }

    function setMarca($marca): void {
        $this->marca = $marca;
    }

    function setModelo($modelo): void {
        $this->modelo = $modelo;
    }

}
