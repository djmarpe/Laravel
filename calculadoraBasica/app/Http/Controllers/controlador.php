<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controlador extends Controller {

    public function hacerOperacion(Request $req) {

        $valor1 = $req->get('valor1');
        $valor2 = $req->get('valor2');
        $operacion = $req->get('operacion');

        switch ($operacion) {
            case 'suma':
                $resultado = $valor1 + $valor2;
                session()->put('resultado', $resultado);
                return view('welcome');
                break;

            case 'resta':
                $resultado = $valor1 - $valor2;
                session()->put('resultado', $resultado);
                return view('welcome');
                break;

            case 'multiplicacion':
                $resultado = $valor1 * $valor2;
                session()->put('resultado', $resultado);
                return view('welcome');
                break;

            case 'division':
                if ($valor2 == 0) {
                    $resultado = 'Error. Division por 0';
                    var_dump($resultado);
                    session()->put('resultado', $resultado);
                    return view('welcome');
                } else {
                    $resultado = $valor1 / $valor2;
                    session()->put('resultado', $resultado);
                    return view('welcome');
                }
                break;
        }
    }

}
