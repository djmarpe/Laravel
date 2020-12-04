<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Calculadora Básica</title>
    </head>
    <body>
        <?php
        if (session()->has('resultado')) {
            $resultado = session()->get('resultado');
        }
        ?>
        <form action="calcular" name="formulario" method="POST">
            {{ csrf_field() }}
            Primer valor: <input type="number" name="valor1" value="" placeholder="Introduce el primer número" required>
            <br>
            Segundo número: <input type="number" name="valor2" value="" placeholder="Introduce el segundo número" required>
            <br>
            Resultado: <input type="text" name="resultado" value="<?php if(isset($resultado)){ echo $resultado;}?>" placeholder="Resultado de la operación" readonly>
            <br>
            <button type="submit" name="operacion" value="suma">+</button>
            <button type="submit" name="operacion" value="resta">-</button>
            <button type="submit" name="operacion" value="multiplicacion">x</button>
            <button type="submit" name="operacion" value="division">/</button>
        </form>
    </body>
</html>
