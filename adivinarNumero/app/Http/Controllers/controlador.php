<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controlador extends Controller {

    public function recogerNum(Request $req) {
        if (session()->has('numOculto')) { //Si existe -> isset
            $numOculto = session()->get('numOculto');
            var_dump($numOculto);
            echo 'El número oculto vale: ' . $numOculto;
        } else {
            $numOculto = random_int(1, 50);
            var_dump($numOculto);
            session()->put('numOculto', $numOculto);
        }

        $numPrueba = $req->get('numeroPrueba');
        if ($numPrueba == $numOculto) {
            return view('exito');
        } else {
            return view('indice');
            $msg = "Fallaste, vuelve a intentarlo";
            session()->put('mensaje', $msg);
        }
    }

    public function cargarIndice() {
        return view('indice');
    }

}
