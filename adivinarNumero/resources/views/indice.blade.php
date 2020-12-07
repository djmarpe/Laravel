<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Adivinar un número</title>
    </head>
    <body>
        <h1>Vamos a adivinar un número</h1>
        <?php
        if (session()->has('numOculto')) {
            $mensaje = session()->get('numOculto');
            echo $mensaje;
        }
        if (session()->has('mensaje')) {
            $mensaje2 = session()->get('mensaje');
            echo $mensaje2;
        }
        ?>
        <form action="adivinar" method="POST" name="formulario">
            {{ csrf_field() }}
            <input type="number" name="numeroPrueba" placeholder="Introduce un número a probar">
            <button type="submit" name="aceptar">Comprobar</button>
        </form>
    </body>
</html>
