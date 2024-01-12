<?php

class ControladorCLiente
{
    function agregarCliente()
    {
        if (isset($_POST['agregar'])) {
            $dato = array(
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'cc' => $_POST['cc']
            );
            $agregar = new ModeloCliente();
            $res = $agregar->agregarClienteModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=clienteAgregado&pagina=1"</script>';
            }
        }
        elseif(isset($_POST['actualizar'])){
            $dato = array(
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'cc' => $_POST['cc'],
                'id' => $_GET['id_cliente']
            );
            $agregar = new ModeloCliente();
            $res = $agregar->actualizarClienteModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=clienteActualizado&pagina=1"</script>';
            }
        }
    }

    function contarDatosClienteControlador()
    {
        $con = new ModeloCliente();
        $res = $con->contarDatoaClienteModelo();
        return $res;
    }

    function listarClienteControlador($pagina, $articulo)
    {
        $lis = new ModeloCliente();
        if (isset($_POST['buscar'])) {

            if ($_POST['buscar'] != null) {
                $dato = $_POST['buscar'];
                $res = $lis->listarClienteModelo($dato, '');
                return $res;
            } else {
                $dato = $_POST['buscar'];
                $res = $lis->listarClienteModelo($dato, '');
                return $res;
            }
        } else {
            $inial = ($pagina - 1) * $articulo;
            $lim = array(
                'proeevedor' => null,
                'pagina' => $inial,
                'limit' => 10
            );
            $res = $lis->listarClienteModelo('', $lim);
            return $res;
        }
    }

    function listarClienteEditar()
    {
        if (isset($_GET['id_cliente'])) {
            $id = $_GET['id_cliente'];
            $listar = new ModeloCliente();
            $res = $listar->listarClienteEditarModelo($id);
            return $res;
        }
    }

    function consultarClienteAjax($dato){
        $consultar = new ModeloCliente();
        $res = $consultar->consultarClienteAjaxModelo($dato);
        return $res;
    }
}