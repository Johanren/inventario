<?php

class ControladorUsuario
{

    function loginControlador()
    {
        if (isset($_POST['ingresar'])) {
            $datos = array('usuario' => $_POST['usuario'], 'clave' => $_POST['password']);

            $consultarUsuario = new ModeloUsuario();
            $res = $consultarUsuario->ModeloLoginIngresar($datos);
            if ($res[0]['nombre_activo'] != 'Inactivo') {
                if ($res[0]['usuario'] == $_POST['usuario'] && $res[0]['clave'] == $_POST['password']) {
                    session_start();
                    $_SESSION['id_caja'] = $res[0]['id_caja'];
                    $_SESSION['id_usuario'] = $res[0]['id_usuario'];
                    $_SESSION['usuario'] = $res[0]['usuario'];
                    $_SESSION['rol'] = $res[0]['rol'];
                    $_SESSION['validar'] = true;
                    header('location:inicio');
                } else {
                    header('location:loginFallido');
                }
            } else {
                header('location:loginInactivo');
            }
        }
    }

    function agregarUsuario()
    {
        if (isset($_POST['agregar'])) {
            $dato = array(
                'usuario' => $_POST['usuario'],
                'clave' => $_POST['clave'],
                'id_activo' => $_POST['activo'],
                'id_rol' => $_POST['rol'],
                'id_caja' => $_POST['caja']
            );
            $agregar = new ModeloUsuario();
            $res = $agregar->agregarUsuarioModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=usuarioAgregado&pagina=1"</script>';
            }
        } elseif (isset($_POST['actualizar'])) {
            $dato = array(
                'usuario' => $_POST['usuario'],
                'clave' => $_POST['clave'],
                'id_activo' => $_POST['activo'],
                'id_rol' => $_POST['rol'],
                'id_caja' => $_POST['caja'],
                'id' => $_GET['id_usuario']
            );
            $actualizar = new ModeloUsuario();
            $res = $actualizar->actualizarUsuarioModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=usuarioActualizado&pagina=1"</script>';
            }
        }
    }

    function contarDatosUsuarioControlador()
    {
        $con = new ModeloUsuario();
        $res = $con->contarDatoaUsuarioModelo();
        return $res;
    }

    function listarUsuarioControlador($pagina, $articulo)
    {
        $lis = new ModeloUsuario();
        if (isset($_POST['buscar'])) {

            if ($_POST['buscar'] != null) {
                $dato = $_POST['buscar'];
                $res = $lis->listarUsuarioModelo($dato, '');
                return $res;
            } else {
                $dato = $_POST['buscar'];
                $res = $lis->listarUsuarioModelo($dato, '');
                return $res;
            }
        } else {
            $inial = ($pagina - 1) * $articulo;
            $lim = array(
                'proeevedor' => null,
                'pagina' => $inial,
                'limit' => 10
            );
            $res = $lis->listarUsuarioModelo('', $lim);
            return $res;
        }
    }

    function listarUsuarioEditar()
    {
        if (isset($_GET['id_usuario'])) {
            $id = $_GET['id_usuario'];
            $listar = new ModeloUsuario();
            $res = $listar->listarUsuarioEditarModelo($id);
            return $res;
        }
    }

    
}