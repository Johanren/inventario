<?php

class ControladorCaja
{
    function listarCaja()
    {
        $listarCaja = new ModeloCaja();
        $res = $listarCaja->listarCajaModelo();
        return $res;
    }

    function agregarCaja()
    {
        if (isset($_POST['agregar'])) {
            $dato = array(
                'caja' => $_POST['caja'],
                'activo' => $_POST['activo']
            );
            $agregar = new ModeloCaja();
            $res = $agregar->agregarCajaModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=cajaAgregado&pagina=1"</script>';
            }
        }elseif (isset($_POST['actualizar'])) {
            $dato = array(
                'caja' => $_POST['caja'],
                'activo' => $_POST['activo'],
                'id' => $_GET['id_caja']
            );
            $actaulizar = new ModeloCaja();
            $res = $actaulizar->actualizarCajaModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=cajaActualizar&pagina=1"</script>';
            }
        }
    }

    function contarDatosCajaControlador()
    {
        $con = new ModeloCaja();
        $res = $con->contarDatoaCajaModelo();
        return $res;
    }

    function listarCajaControlador($pagina, $articulo)
    {
        $lis = new ModeloCaja();
        if (isset($_POST['buscar'])) {

            if ($_POST['buscar'] != null) {
                $dato = $_POST['buscar'];
                $res = $lis->listarCajasModelo($dato, '');
                return $res;
            } else {
                $dato = $_POST['buscar'];
                $res = $lis->listarCajasModelo($dato, '');
                return $res;
            }
        } else {
            $inial = ($pagina - 1) * $articulo;
            $lim = array(
                'proeevedor' => null,
                'pagina' => $inial,
                'limit' => 10
            );
            $res = $lis->listarCajasModelo('', $lim);
            return $res;
        }
    }
}