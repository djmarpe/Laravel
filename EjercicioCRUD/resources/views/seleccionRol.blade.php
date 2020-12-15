<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SeleccionRol</title>
    </head>
    <body>
        <?php
        if (session()->has('usuarioLogin')) {
            $usuario = session()->get('usuarioLogin');
        }
        ?>

        <h2>Bienvenido: <?= $usuario->getNombre() . '&nbsp;' . $usuario->getApellidos() ?></h2>

        <hr style="background-color: black; border: 5px double black;">

        <form action="selecionarRol" name="from_seleccionRol" method="POST">
            {{ csrf_field() }}
            Iniciar como:
            <select name="rolSeleccionado">
                <option value="usuario">Usuario</option>
                <option value="administrador">Administrador</option>
            </select>
            <input type="submit" name="continuar" value="Continuar">
        </form>
        
        <hr style="background-color: black; border: 5px double black;">

        <form action="cerrarSesion" name="form_cerrarSesion" method="POST">
            {{ csrf_field() }}
            <input type="submit" name="cerrarSesion" value="Cerrar Sesión">
        </form>

    </body>
</html>
