<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>tabla de multiplicar</title>
    </head>
    <body>
        <?php
        if (session()->has('num')) {
            $numero = session()->get('num');
        }
        if (session()->has('resultadosJugada')) {
            $resultados = session()->get('resultadosJugada');
        }
        if (session()->has('resultadoJugador')) {
            $solJugador = session()->get('resultadoJugador');
        }
        if (session()->has('solVerdadera')) {
            $solVerdadera = session()->get('solVerdadera');
        }
        ?>
        <h1>Ejercicio tabla de multiplicar</h1>
        <form action="comprobar" name="tabla" method="POST">
            {{ csrf_field() }}
            <table>
                <?php
                for ($i = 0; $i < 10; $i++) {
                    ?>
                    <tr>
                        <td>
                            <input type="text" name="val1" value="<?php
                            if (isset($numero)) {
                                echo $numero;
                            }
                            ?>"readonly>
                        </td>
                        <td>x</td>
                        <td>
                            <input type="text" name="val2" value="<?php echo $i + 1; ?>" readonly>
                        </td>
                        <td>=</td>
                        <td>
                            <?php
                            if (isset($resultados)) {
                                if ($resultados[$i]) {
                                    ?>
                                    <input type = "number" name = "sol[]" value = "<?php echo $solJugador[$i]; ?>" required style="background-color: green;">
                                    <?php
                                } else {
                                    ?>
                                    <input type = "number" name = "sol[]" value = "<?php echo $solJugador[$i]; ?>" required style="background-color: red;">
                                    <?php
                                }
                            } elseif (isset($solVerdadera)) {
                                ?>
                                <input type = "number" name = "sol[]" value = "<?php echo $solVerdadera[$i]; ?>" required style="background-color: green;">
                                <?php
                            } else {
                                ?>
                                <input type = "number" name = "sol[]" value = "" required>
                                <?php
                            }
                            ?>

                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table> 
            <button type="submit" name="check">Comprobar</button>
        </form>

        <form action="volver" name="form_volver" method="GET">
            <button type="submit" name="volver">Volver</button>
        </form>

        <form action="rendirse" name="rendirse" method="POST">
            {{ csrf_field() }}
            <button type="submit" name="btn_rendirse">Rendirse</button>
        </form>
    </body>
</html>
