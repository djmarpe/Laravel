<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Indice</title>

    </head>
    <body>
        <form name="formulario" method="POST" action="recoger">
            {{ csrf_field() }}
            <input type="text" placeholder="Escribe algo..." name="nombre">
            <input type="number" placeholder="Introduce tu edad..." name="edad">
            <button type="submit" name="aceptar">Aceptar</button>
        </form>
    </body>
</html>
