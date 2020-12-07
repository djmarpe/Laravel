<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controlador extends Controller {

    public function crearTabla(Request $req) {
        session()->put('num', $req->get('numero'));
        return view('tabla');
    }

    public function volver() {
        session()->forget('resultadosJugada');
        session()->forget('resultadoJugador');
        session()->forget('solVerdadera');
        return view('welcome');
    }

    public function check(Request $req) {
        $num1 = $req->get('val1');
        $solUsuario = $req->get('sol');
        $solVerdadera = [];
        $resultadosJugada = [];

        for ($i = 1; $i <= 10; $i++) {
            $solVerdadera[] = $num1 * $i;
        }

        for ($i = 0; $i < 10; $i++) {
            if ($solVerdadera[$i] == $solUsuario[$i]) {
                $resultadosJugada[] = true;
            } else {
                $resultadosJugada[] = false;
            }
        }

        session()->put('resultadosJugada', $resultadosJugada);
        session()->put('solVerdadera', $solVerdadera);
        session()->put('resultadoJugador', $solUsuario);

        return view('tabla');
    }

    public function surrender(Request $req) {
        $num1 = session()->get('num');
        $solVerdadera = [];

        for ($i = 1; $i <= 10; $i++) {
            $solVerdadera[] = $num1 * $i;
        }

        session()->put('solVerdadera', $solVerdadera);
        return view('tabla');
    }

}
