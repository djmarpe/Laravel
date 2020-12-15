<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clases\Usuario;
use App\Clases\Coche;

class controlador extends Controller {

    //**************************************************************************
    //************************* Ventana Login **********************************
    //**************************************************************************
    public function getUsuario(Request $req) {
        $email = $req->get('email');
        $password = $req->get('password');

        $usuario = \DB::select("Select Persona.Nombre, Persona.Apellidos, Persona.DNI, Persona.Email, Persona.Contra, Persona.Activado, Rol.Rol from Persona, Rol, AsignacionRol where Persona.Email = ?", [$email], " and Persona.Contra = ?", [$password], " and AsignacionRol.DNI = Persona.DNI and AsignacionRol.idRol=Rol.idRol");
//        $usuario = \DB::table('Persona','Rol','AsignacionRol')
//          ->select('Persona.Nombre', 'Persona.Apellidos', 'Persona.DNI', 'Persona.Email', 'Persona.Contra', 'Persona.Activado', 'Rol.Rol')
//          ->where('Persona.Email', '=', [$email])
//          ->where('Persona.Contra','=',[$password])
//          ->where('AsignacionRol.DNI = Persona.DNI and AsignacionRol.idRol=Rol.idRol')
//          ->get();
        //var_dump($usuario);
        if (!empty($usuario) > 0) {
            $usuarioLogin = New Usuario();
            for ($i = 0; $i < sizeof($usuario); $i++) {

                $usuarioLogin->setNombre($usuario[$i]->Nombre);
                $usuarioLogin->setApellidos($usuario[$i]->Apellidos);
                $usuarioLogin->setDni($usuario[$i]->DNI);
                $usuarioLogin->setEmail($usuario[$i]->Email);
                $usuarioLogin->setContra($usuario[$i]->Contra);
                $usuarioLogin->setActivado($usuario[$i]->Activado);
                $usuarioLogin->addRol($usuario[$i]->Rol);
            }

            if ($usuarioLogin->getActivado() == 0) {
                session()->put('mensajeLogin', 'Usuario deshabilitado, contacte con su administrador.');
                return view('welcome');
            } else {
                session()->put('usuarioLogin', $usuarioLogin);
                $this->cargarListaUsuarios();
                $this->cargarCochesAlquilados($usuarioLogin->getDni());
                $this->cargarCochesDisponibles();
                session()->put('mensajeLogin', 'Usuario correcto');
                if ($usuarioLogin->getRolSize() == 1) {
                    if ($usuarioLogin->getRoles()[0] == 'Administrador') {
                        return view('crud');
                    }
                    if ($usuarioLogin->getRoles()[0] == 'Usuario') {
                        return view('usuario');
                    }
                } else {
                    return view('seleccionRol');
                }
            }
        } else {
            session()->put('mensajeLogin', 'Usuario y/o contraseña incorrectos');
            return view('welcome');
        }
    }

    //**************************************************************************
    //*************** Función cargar usuarios **********************************
    //**************************************************************************
    function cargarListaUsuarios() {
        //$listaUsuarios = \DB::select("SELECT * FROM Persona");
        $listaUsuarios =\DB::table('Persona')->get();

        $usuarios = [];

        if (sizeof($listaUsuarios) > 0) {
            for ($i = 0; $i < sizeof($listaUsuarios); $i++) {
                $usuarioAux = new Usuario();
                $usuarioAux->setNombre($listaUsuarios[$i]->Nombre);
                $usuarioAux->setApellidos($listaUsuarios[$i]->Apellidos);
                $usuarioAux->setDni($listaUsuarios[$i]->DNI);
                $usuarioAux->setEmail($listaUsuarios[$i]->Email);
                $usuarioAux->setContra($listaUsuarios[$i]->Contra);
                $usuarioAux->setActivado($listaUsuarios[$i]->Activado);
                $usuarios[] = $usuarioAux;
            }
        }
        session()->put('listaUsuarios', $usuarios);
    }

    //**************************************************************************
    //*********** Función coches alquilados ************************************
    //**************************************************************************
    function cargarCochesAlquilados($dni) {
        $listaCoches = \DB::select('SELECT Coche.Matricula, Coche.Marca, Coche.Modelo FROM Coche, Alquilado, Persona WHERE Alquilado.Matricula = Coche.Matricula AND Alquilado.DNI=Persona.DNI AND Persona.DNI=?', [$dni]);
        $listaCochesAlquilados = [];

        if ($listaCoches > 0) {
            for ($i = 0; $i < sizeof($listaCoches); $i++) {
                $cocheAux = new Coche();
                $cocheAux->setMarca($listaCoches[$i]->Marca);
                $cocheAux->setMatricula($listaCoches[$i]->Matricula);
                $cocheAux->setModelo($listaCoches[$i]->Modelo);
                $listaCochesAlquilados[] = $cocheAux;
            }
            session()->put('listaCochesAlquilados', $listaCochesAlquilados);
            return view('usuario');
        }
    }

    //**************************************************************************
    //***************** Función cargar coches disponibles **********************
    //**************************************************************************
    function cargarCochesDisponibles() {
        $listaCoches = \DB::select("Select Matricula, Marca, Modelo from Coche WHERE Matricula not in (SELECT Matricula from Alquilado)");
        $listaCochesDisponibles = [];

        if ($listaCoches > 0) {
            for ($i = 0; $i < sizeof($listaCoches); $i++) {
                $cocheAux = new Coche();
                $cocheAux->setMarca($listaCoches[$i]->Marca);
                $cocheAux->setMatricula($listaCoches[$i]->Matricula);
                $cocheAux->setModelo($listaCoches[$i]->Modelo);
                $listaCochesDisponibles[] = $cocheAux;
            }
            session()->put('listaCochesDisponibles', $listaCochesDisponibles);
            return view('usuario');
        }
    }

    //**************************************************************************
    //******************** Función get Usuario por tipo ************************
    //**************************************************************************
    public function getUsuarios(Request $req) {
        $tipo = $req->get('tipo');
        if (session()->has('tipoUsuario')) {
            $tipo = session()->get('tipoUsuario');
        } else {
            session()->put('tipoUsuario', $tipo);
        }

        switch ($tipo) {
            case 'desactivados':
                $usuariosDesactivados = \DB::select("SELECT * FROM Persona WHERE Activado = 0");
                session()->put('usuariosDesactivados', $usuariosDesactivados);
                return view('crud');
                break;

            case 'activados':
                $usuariosActivados = \DB::select("SELECT * FROM Persona WHERE Activado = 1");
                session()->put('usuariosActivados', $usuariosActivados);
                return view('crud');
                break;
        }
    }

    //**************************************************************************
    //************************* Ventana Selección de rol ***********************
    //**************************************************************************
    public function seleccionRol(Request $req) {
        $rolSeleccionado = $req->get('rolSeleccionado');

        switch ($rolSeleccionado) {
            case 'administrador':
                return view('crud');
                break;
            case 'usuario':
                return view('usuario');
                break;
        }
    }

    //**************************************************************************
    //***************** Función editar usuario *********************************
    //**************************************************************************
    public function editarBorrarUsuario(Request $req) {
        $dni = $req->get('dni');
        $nombre = $req->get('nombre');
        $apellidos = $req->get('apellidos');
        $email = $req->get('email');
        $password = $req->get('password');
        $onOff = $req->get('onOff');
        if ($onOff == 'activado') {
            $activado = 1;
        } else {
            $activado = 0;
        }

        //Editar usuario
        if ($req->get('editar')) {
            $afectadas = \DB::update("UPDATE Persona SET Email = '" . $email . "', Contra = '" . $password . "', Activado=" . $activado . " WHERE DNI = ?", [$dni]);
            $this->cargarListaUsuarios();
            return view('crud');
        }

        //Borrar usuario
        if ($req->get('borrar')) {
            if (\DB::delete("DELETE FROM Persona WHERE DNI = ?", [$dni])) {
                if (\DB::delete("DELETE FROM AsignacionRol WHERE DNI = ?", [$dni])) {
                    $this->cargarListaUsuarios();
                }
            }
            return view('crud');
        }
    }

    //**************************************************************************
    //***************** Función insertar usuario *******************************
    //**************************************************************************
    public function insertarUsuario(Request $req) {
        $nombre = $req->get('nombreUsuario');
        $apellidos = $req->get('apellidoUsuario');
        $dni = $req->get('dniUsuario');
        $correo = $req->get('correoUsuario');
        $password = $req->get('passwordUsuario');
        $opcion = $req->get('opcionUsuario');
        if ($opcion == 'activado') {
            $activado = 1;
        } else {
            $activado = 0;
        }
        $rol = 1;

        if (\DB::insert('insert into Persona (DNI, Nombre, Apellidos, Email, Contra, Activado) values (?, ?, ?, ?, ?, ?)', [$dni, $nombre, $apellidos, $correo, $password, $activado])) {
            if (\DB::insert('insert into AsignacionRol (DNI, idRol) values(?, ?)', [$dni, $rol])) {
                $this->cargarListaUsuarios();
                return view('crud');
            }
        }
    }

    
    //**************************************************************************
    //***************** Función devolver coche *********************************
    //**************************************************************************
    public function devolverCoche(Request $req) {
        $usuarioLogin = session()->get('usuarioLogin');
        $matricula = $req->get('matricula');
        $marca = $req->get('marca');
        $modelo = $req->get('modelo');

        if (\DB::delete("Delete from Alquilado where DNI = ?", [$usuarioLogin->getDni()], " AND Matricula = ?", [$matricula])) {
            $this->cargarCochesAlquilados($usuarioLogin->getDni());
            $this->cargarCochesDisponibles();
            return view('usuario');
        }
    }

    //**************************************************************************
    //***************** Función alquilar coche *********************************
    //**************************************************************************
    public function alquilarCoche(Request $req) {
        $usuarioLogin = session()->get('usuarioLogin');
        $matricula = $req->get('matricula');

        if (\DB::insert('insert into Alquilado (Matricula, DNI)values(?, ?)', [$matricula, $usuarioLogin->getDni()])) {
            $this->cargarCochesAlquilados($usuarioLogin->getDni());
            $this->cargarCochesDisponibles();
            return view('usuario');
        }
    }

    //**************************************************************************
    //***************** Función cambiar a selección de rol *********************
    //**************************************************************************
    public function volverSeleccion(Request $req) {
        $volver = $req->get('volverSeleccion');
        return view('seleccionRol');
    }

    //**************************************************************************
    //***************** Función cerrar sesión *********************************
    //**************************************************************************
    public function cerrarSesion(Request $req) {
        session()->forget('usuarioLogin');
        session()->forget('listaUsuarios');
        session()->forget('listaCochesDisponibles');
        session()->put('mensajeLogin', 'Sesión cerrada correctamente');
        return view('welcome');
    }

}
