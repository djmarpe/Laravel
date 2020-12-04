<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class miControlador extends Controller {

    public function cargarIndice() {
        return view('indice');
    }

    public function recogerDatos(Request $req) {
        $nombre = $req->get('nombre'); //$nombre = $_REQUEST['nombre'];
        $edad = $req->get('edad');
        $loquesea = 1000;
        session()->put('loquesea', $loquesea);
        //var_dump($nombre);
        //var_dump($edad);
        //dd($nombre) -> Para depurar y mostrar lo que vale la variable
        if ($nombre == 'Alejandro' || $nombre == 'Maki') {
            //Meto los datos en un vecto asociativo
            $datos = [
                'nom' => $nombre,
                'ed' => $edad
            ];
            //redirigir a exito, pasando los datos
            return view('exito', $datos);
        } else {
            return view('error');
        }
    }

}
