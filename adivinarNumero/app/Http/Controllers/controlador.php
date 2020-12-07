<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controlador extends Controller {

    public function recogerNum(Request $req) {
        if (session()->has('numOculto')) { //Si existe -> isset
            $numOculto = session()->get('numOculto');
            echo 'El número oculto vale: ' . $numOculto;
        } else {
            $numOculto = rand(1, 10);
            session()->put('numOculto', $numOculto);
        }

        $numPrueba = $req->get('numeroPrueba');
        if ($numPrueba == $numOculto) {
            return view('exito');
        } else {
            $msg = "Fallaste, vuelve a intentarlo";
            session()->put('mensaje', $msg);
            return view('indice');
        }
    }

    public function cargarIndice() {
        return view('indice');
    }

}
