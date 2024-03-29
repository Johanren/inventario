<?php

class ControladorVenta{
    function agregarVenta($dato){
        $agregar = new ModeloVenta();
        $res = $agregar->agregarVentaModelo($dato);
        return $res;
    }

    function consultarVentaDia(){
        if (isset($_POST['consultar'])) {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDia($_POST['buscar']);
            return $res;
        }else{
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDia('');
            return $res;
        }
    }

    function consultarVentaDiaCantidadTotal($id_producto){
        if (isset($_POST['consultar'])) {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDiaCantidadTotalModelo($id_producto, $_POST['buscar']);
            return $res;
        }else{
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDiaCantidadTotalModelo($id_producto, '');
            return $res;
        }
    }

    function ventaTotalDia(){
        if (isset($_POST['consultar'])) {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaTotalDia($_POST['buscar']);
            return $res;
        }else{
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaTotalDia('');
            return $res;
        }
    }

    function mostrarFacturaVenta($id){
        $mostrar = new ModeloVenta();
        $res = $mostrar->mostrarFacturaVentaModelo($id);
        return $res;
    }
}