<?php

class ControladorFacturaProeevedor
{
    function agregarFacturaProeevedor($id_categoria, $proeevedor, $id_usuario, $id_medida, $codigo, $nombre, $valor, $cantidad)
    {
        $agregarFactura = new ModeloFacturaProeevedor();
        $agregarFactura->agregarFacturaProeevedorModelo($id_categoria, $proeevedor, $id_usuario, $id_medida, $codigo, $nombre, $valor, $cantidad);
    }

    function contarDatosFacturaProeevedorControlador()
    {
        $con = new ModeloFacturaProeevedor();
        $res = $con->contarDatoaFacturaProeevedorModelo();
        return $res;
    }

    function listarFacturaProeevedoControlador($pagina, $articulo)
    {
        $lis = new ModeloFacturaProeevedor();
        if (isset($_POST['buscar'])) {

            if ($_POST['buscar'] != null) {
                $dato = $_POST['buscar'];
                $res = $lis->listarFacturaProeevedoModelo($dato, '');
                return $res;
            } else {
                $dato = $_POST['buscar'];
                $res = $lis->listarFacturaProeevedoModelo($dato, '');
                return $res;
            }
        } else {
            $inial = ($pagina - 1) * $articulo;
            $lim = array(
                'proeevedor' => null,
                'pagina' => $inial,
                'limit' => 10
            );
            $res = $lis->listarFacturaProeevedoModelo('', $lim);
            return $res;
        }
    }

    function mostrarFacturaProeevedor(){
        if(isset($_GET['id_proeevedor'])){
            $id = $_GET['id_proeevedor'];
            $fecha = $_GET['fecha'];
            $mostrar = new ModeloFacturaProeevedor();
            $res = $mostrar->mostrarFacturaProeevedorModelo($id, $fecha);
            return $res;
        }
    }
}