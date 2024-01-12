<?php

require_once '../controllers/controladorProeevedor.php';
require_once '../controllers/controladorArticulo.php';
require_once '../controllers/controladorCategoria.php';
require_once '../controllers/controladorMedida.php';
require_once '../controllers/controladorCLiente.php';

require_once '../Models/modeloProeevedor.php';
require_once '../Models/modeloArticulo.php';
require_once '../Models/modeloCategoria.php';
require_once '../Models/modeloMedida.php';
require_once '../Models/modeloCliente.php';

class Ajax
{
    public $proeevedor;
    public $categoria;
    public $medida;
    public $articulo;
    public $idArticulo;
    public $cliente;

    function consultarProeevedorAjax()
    {
        $consultar = new ControladorProeevedor();
        $respuesta = $consultar->consultarProeevedorAjaxControlador($this->proeevedor);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_proeevedor'],
                'id' => $value['id_proeevedor'],
                'nom' => $value['nombre_proeevedor'],
                'nit' => $value['nit_proeevedor'],
                'tel' => $value['telefono_proeevedor'],
                'dire' => $value['direccion_proeevedor'],
            );
        }

        print json_encode($datos);
    }

    function consultarAritucloProeevedorid()
    {
        $consultar_id = new ControladorArticulo();
        $res = $consultar_id->consultarAritucloProeevedoridAjax($this->articulo);
        foreach ($res as $key => $value) {
            $datos[] = array(
                'value' => $value['id_articulo'],
                'label' => $value['codigo_producto'],
                'labelN' => $value['nombre_producto']
            );
        }

        print json_encode($datos);

    }

    function consultarAritucloProeevedorNombre()
    {
        $consultar_id = new ControladorArticulo();
        $res = $consultar_id->consultarAritucloProeevedoridAjax($this->articulo);
        foreach ($res as $key => $value) {
            $datos[] = array(
                'value' => $value['id_articulo'],
                'label' => $value['nombre_producto']
            );
        }

        print json_encode($datos);

    }

    function consultarAritucloProeevedorAgregarFactura()
    {
        $consultar_id = new ControladorArticulo();
        $res = $consultar_id->consultarAritucloProeevedoridAjax($this->articulo);
        foreach ($res as $key => $value) {
            $datos[] = array(
                'value' => $value['id_articulo'],
                'label' => $value['codigo_producto'],
            );
        }
        
        print json_encode($res);

    }

    function consultarAritucloProeevedor()
    {
        $consultar_id = new ControladorArticulo();
        $res = $consultar_id->consultarAritucloProeevedorAjax($this->idArticulo);
        foreach ($res as $key => $value) {
            $datos[] = array(
                'value' => $value['id_articulo'],
                'label' => $value['codigo_producto']
            );
        }

        print json_encode($res);

    }

    function consultarCategoria()
    {
        $consultar_id = new ControladorCategoria();
        $res = $consultar_id->consultarCategoriaAjax($this->categoria);

        print json_encode($res);
    }

    function consultarMedida()
    {
        $consultar_id = new ControladorMedida();
        $res = $consultar_id->consultarMedidaAjax($this->medida);

        print json_encode($res);
    }

    function consultarCliente()
    {
        $consultar_cliente = new ControladorCLiente();
        $res = $consultar_cliente->consultarClienteAjax($this->cliente);
        foreach ($res as $key => $value) {
            $datos[] = array(
                'label1' => $value['numero_cedula'],
                'label' => $value['nombre'] . " " . $value['apellido'],
                'id' => $value['id_cliente']
            );
        }

        print json_encode($datos);

    }

}

$ajax = new Ajax();

if (isset($_GET['proeevedor'])) {
    $ajax->proeevedor = $_GET['proeevedor'];
    $ajax->consultarProeevedorAjax();
}

if (isset($_GET['codigo'])) {
    $ajax->articulo = $_GET['codigo'];
    $ajax->consultarAritucloProeevedorid();
}

if (isset($_GET['codigo1'])) {
    $ajax->articulo = $_GET['codigo1'];
    $ajax->consultarAritucloProeevedorAgregarFactura();
}

if (isset($_GET['nombre'])) {
    $ajax->articulo = $_GET['nombre'];
    $ajax->consultarAritucloProeevedorNombre();
}

if (isset($_GET['categoria'])) {
    $ajax->categoria = $_GET['categoria'];
    $ajax->consultarCategoria();
}

if (isset($_GET['medida'])) {
    $ajax->medida = $_GET['medida'];
    $ajax->consultarMedida();
}


if (isset($_GET['cc'])) {
    $ajax->cliente = $_GET['cc'];
    $ajax->consultarCliente();
}

$request = 0;
if (isset($_GET['request'])) {
    $request = $_GET['request'];
}
if ($request == 2) {
    $userid = 0;
    if (isset($_GET['userid'])) {
        $ajax->idArticulo = $_GET['userid'];
        $ajax->consultarAritucloProeevedor();
    }

}