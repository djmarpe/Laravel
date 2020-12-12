<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Iniciar sesión</title>
    </head>
    <body>
        <?php
        if (session()->has('mensajeLogin')) {
            $mensaje = session()->get('mensajeLogin');
            echo $mensaje;
        }
        ?>
        <h1>Iniciar sesion</h1>
        <form action="login" name="form_login" method="POST">
            {{ csrf_field() }}
            <input type="email" name="email" id="email" placeholder="Introduce tu email" maxlength="50" required>
            <br>
            <input type="password" name="password" id="password" placeholder="Introduce tu contraseña" maxlength="50" required>
            <br>
            <input type="submit" name="login" value="Iniciar sesion">
        </form>
    </body>
</html>
