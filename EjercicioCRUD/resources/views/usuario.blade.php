<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Usuario ...</title>
    </head>
    <body>
        <?php
        if (session()->has('usuarioLogin')) {
            $usuario = session()->get('usuarioLogin');
        }

        if (session()->has('listaCochesAlquilados')) {
            $listaCochesAlquilados = session()->get('listaCochesAlquilados');
        }
        
        if (session()->has('listaCochesDisponibles')) {
            $listaCochesDisponibles = session()->get('listaCochesDisponibles');
        }
        ?>

        <h2>Bienvenido: <?= $usuario->getNombre() . '&nbsp;' . $usuario->getApellidos() ?></h2>

        <hr style="background-color: black; border: 5px double black;">

        <form action="volverSeleccion" name="form_volverSeleccion" method="POST">
            {{ csrf_field() }}
            <input type="submit" name="volverSeleccion" value="Volver a selección de rol">
        </form>

        <hr style="background-color: black; border: 5px double black;">
        
        <h3>Lista de coches alquilados</h3>

        <?php
        if (isset($listaCochesAlquilados)) {
            ?>
            <table>
                <tr>
                    <th>Matrícula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                </tr>
                <?php
                foreach ($listaCochesAlquilados as $coche) {
                    ?>
                    <form action="devolverCoche" name="form_devolverCoche" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td><input type="text" name="matricula" value="<?= $coche->getMatricula() ?>" readonly></td>
                            <td><input type="text" name="marca" value="<?= $coche->getMarca() ?>" readonly></td>
                            <td><input type="text" name="modelo" value="<?= $coche->getModelo() ?>" readonly></td>
                            <td><input type="submit" name="devolver" value="Devolver"></td>
                        </tr>
                    </form>
                    <?php
                }
                ?>
            </table>
            <?php
        } else {
            echo 'No tienes coches alquilados en este momento.';
        }
        ?>

        <hr style="background-color: black; border: 5px double black;">

        <h3>Lista de coches disponibles</h3>
        <?php
        if (isset($listaCochesDisponibles)) {
            ?>
            <table>
                <tr>
                    <th>Matrícula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                </tr>
                <?php
                foreach ($listaCochesDisponibles as $coche) {
                    ?>
                    <form action="alquilarCoche" name="form_alquilarCoche" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td><input type="text" name="matricula" value="<?= $coche->getMatricula() ?>" readonly></td>
                            <td><input type="text" name="marca" value="<?= $coche->getMarca() ?>" readonly></td>
                            <td><input type="text" name="modelo" value="<?= $coche->getModelo() ?>" readonly></td>
                            <td><input type="submit" name="alquilar" value="Alquilar"></td>
                        </tr>
                    </form>
                    <?php
                }
                ?>
            </table>
            <?php
        } else {
            echo 'No hay coches disponibles en este momento.';
        }
        ?>

    </body>
</html>
