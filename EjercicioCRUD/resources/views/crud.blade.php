<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administración ...</title>
    </head>
    <body>
        <?php
        if (session()->has('usuarioLogin')) {
            $usuario = session()->get('usuarioLogin');
        }

        if (session()->has('listaUsuarios')) {
            $listaUsuarios = session()->get('listaUsuarios');
        }
        ?>

        <h2>Bienvenido: <?= $usuario->getNombre() . '&nbsp;' . $usuario->getApellidos() ?></h2>

        <hr style="background-color: black; border: 5px double black;">

        <form action="volverSeleccion" name="form_volverSeleccion" method="POST">
            {{ csrf_field() }}
            <input type="submit" name="volverSeleccion" value="Volver a selección de rol">
        </form>

        <hr style="background-color: black; border: 5px double black;">

        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Correo electrónico</th>
                <th>Contraseña</th>
                <th>Activado</th>
            </tr>

            <?php
            foreach ($listaUsuarios as $user) {
                ?>
                <form action="crudUser" name="form_crudUser" method="POST">
                    {{ csrf_field() }}
                    <tr>
                        <td><input type="text" name="nombre" value="<?php echo $user->getNombre() ?>" readonly></td>
                        <td><input type="text" name="apellidos" value="<?php echo $user->getApellidos() ?>" readonly></td>
                        <td><input type="text" name="dni" value="<?php echo $user->getDNI() ?>" readonly></td>
                        <td><input type="text" name="email" value="<?php echo $user->getEmail() ?>"></td>
                        <td><input type="password" name="password" placeholder="Nueva contraseña"></td>
                        <td>
                            <select name="onOff">
                                <?php
                                if ($user->getActivado() == 0) {
                                    ?>
                                    <option value="activado">Activado</option>
                                    <option value="activado" selected>Desactivado</option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="activado" selected>Activado</option>
                                    <option value="desactivado">Desactivado</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="submit" name="editar" value="Editar">
                        </td>
                        <td>
                            <input type="submit" name="borrar" value="Borrar">
                        </td>
                    </tr>
                </form>
                <?php
            }
            ?>

        </table>

        <hr style="background-color: black; border: 5px double black;">

        <h3>Insertar nuevo usuario</h3>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Correo electrónico</th>
                <th>Contraseña</th>
                <th>Activado / Desactivado</th>
            </tr>
            <form action="insertarUsuario" name="form_insertarCRUD" method="POST">
                {{ csrf_field() }}
                <tr>
                    <td><input type="text" name="nombreUsuario" placeholder="Nombre ..." required></td>
                    <td><input type="text" name="apellidoUsuario" placeholder="Apellidos ..." required></td>
                    <td><input type="text" name="dniUsuario" placeholder="DNI ..." required></td>
                    <td><input type="text" name="correoUsuario" placeholder="Correo eletrónico ..." required></td>
                    <td><input type="password" name="passwordUsuario" placeholder="Contraseña ..." required></td>
                    <td>
                        <select name="opcionUsuario">
                            <option value="activado">Activado</option>
                            <option value="desactivado">Desactivado</option>
                        </select>
                    </td>
                    <td>
                        <input type="submit" name="insertar" value="Añadir usuario">
                    </td>
                </tr>
            </form>
        </tr>
    </table>

    <hr style="background-color: black; border: 5px double black;">

    <form action="cerrarSesion" name="form_cerrarSesion" method="POST">
        {{ csrf_field() }}
        <input type="submit" name="cerrarSesion" value="Cerrar Sesión">
    </form>
</body>
</html>
