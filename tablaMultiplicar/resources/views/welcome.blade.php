<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>tabla de multiplicar</title>
    </head>
    <body>
        <h1>Ejercicio tabla de multiplicar</h1>
        <form action="crearTabla" name="formulario" method="POST">
            {{ csrf_field() }}
            <input type="number" name="numero" placeholder="Introduce un número" required>
            <button type="submit" name="aceptar">Aceptar</button>
        </form>
    </body>
</html>
