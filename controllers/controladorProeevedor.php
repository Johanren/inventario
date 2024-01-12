<?php

class ControladorProeevedor
{
    function agregarProeevedor()
    {
        if (isset($_POST['agregar'])) {
            $dato = array(
                'nit' => $_POST['nit'],
                'nombre' => $_POST['nombre'],
                'tel' => $_POST['tel'],
                'dire' => $_POST['dire']
            );

            $agregar = new ModeloProeevedor();
            $res = $agregar->agregarProeevedorModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=proeevedorAgregado&pagina=1"</script>';
            }
        } elseif (isset($_POST['actualizar'])) {
            $dato = array(
                'nit' => $_POST['nit'],
                'nombre' => $_POST['nombre'],
                'tel' => $_POST['tel'],
                'dire' => $_POST['dire'],
                'id' => $_GET['id_proeevedor']
            );
            $actualizar = new ModeloProeevedor();
            $res = $actualizar->actualizarProeevedorModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=proeevedorActualizado&pagina=1"</script>';
            }
        }
    }

    function contarDatosProeevedorControlador()
    {
        $con = new ModeloProeevedor();
        $res = $con->contarDatoaProeevedorModelo();
        return $res;
    }

    function listarProeevedorControlador($pagina, $articulo)
    {
        $lis = new ModeloProeevedor();
        if (isset($_POST['buscar'])) {

            if ($_POST['buscar'] != null) {
                $dato = $_POST['buscar'];
                $res = $lis->listarProeevedorModelo($dato, '');
                return $res;
            } else {
                $dato = $_POST['buscar'];
                $res = $lis->listarProeevedorModelo($dato, '');
                return $res;
            }
        } else {
            $inial = ($pagina - 1) * $articulo;
            $lim = array(
                'proeevedor' => null,
                'pagina' => $inial,
                'limit' => 10
            );
            $res = $lis->listarProeevedorModelo('', $lim);
            return $res;
        }
    }

    function listarProeevedorEditar()
    {
        if (isset($_GET['id_proeevedor'])) {
            $id = $_GET['id_proeevedor'];
            $listar = new ModeloProeevedor();
            $res = $listar->listarProeevedorEditarModelo($id);
            return $res;
        }
    }

    function consultarProeevedorAjaxControlador($dato)
    {
        $consultar = new ModeloProeevedor();
        $res = $consultar->consultarProeevedorAjaxModelo($dato);
        return $res;
    }

}