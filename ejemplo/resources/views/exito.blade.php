<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Indice</title>

    </head>
    <body>
        <h1>Login correcto</h1>
        <h1>Bienvenido&nbsp;<?php echo $nom . ' de ' . $ed . ' años!' ?></h1>
        <?php
        if (session()->has('loquesea')) { //Si existe -> isset
            $sesion = session()->get('loquesea');
            echo 'La variable de sesion vale: ' . $sesion;
        }
        
        //eliminar variable concreta de la sesion
        session()->forget('loquesea');
        //eliminar todas las de la sesion
        session()->flush();
        ?>
        <br>
        <a href="principal">Volver</a>
    </body>
</html>
