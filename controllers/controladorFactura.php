<?php

class ControladorFactura
{
    function agregarFactura()
    {
        if (isset($_POST['imprimir'])) {

            $id_caja = $_SESSION['id_caja'];
            $id_usuario = $_SESSION['id_usuario'];
            $id_cliente = $_POST['id_cliente'];
            $id_articulo = $_POST['id_articulo'];
            $descuento = $_POST['descuento'];
            $pago = $_POST['pago'];
            $peso = $_POST['peso'];
            $cantidad = $_POST['cantidad'];
            $total_factura = 0;
            $cambio = 0;
            for ($i = 0; $i < count($id_articulo); $i++) {
                $buscar = new ControladorArticulo();
                $res = $buscar->mostrarArticulo($id_articulo[$i]);
                if ($peso[$i] > 0) {
                    if ($descuento[$i] == 0) {
                        $valor_gramo = $res[0]['valor_producto_iva'] / 1000;
                        $multiplicar = $valor_gramo * $peso[$i];
                    } else {
                        $valor_gramo = $descuento[$i] / 1000;
                        $multiplicar = $valor_gramo * $peso[$i];
                    }
                } else {
                    if ($descuento[$i] == 0) {
                        $multiplicar = $res[0]['valor_producto_iva'] * $cantidad[$i];
                    } else {
                        $multiplicar = $descuento[$i] * $cantidad[$i];
                    }
                }
                $total_factura += $multiplicar;
            }
            $total_factura;
            $cambio = $pago - $total_factura;
            $dato = array(
                'id_caja' => $id_caja,
                'id_usuario' => $id_usuario,
                'total_factura' => $total_factura,
                'tarjeta' => NULL,
                'efectivo' => $pago,
                'cambio' => $cambio,
                'id_cliente' => $id_cliente
            );
            $agregarFactura = new ModeloFactura();
            $resFactura = $agregarFactura->agregarFacturaModelo($dato);
            $resUltimoId = $agregarFactura->mostrarUltimoId();
            if ($resUltimoId) {
                $idFactura = $resUltimoId[0]['MAX(id_factura)'];
                for ($i = 0; $i < count($id_articulo); $i++) {
                    $buscar = new ControladorArticulo();
                    $res = $buscar->mostrarArticulo($id_articulo[$i]);
                    if ($descuento[$i] == 0) {
                        $valor_unitario = $res[0]['valor_producto_iva'];
                    }else{
                        $valor_unitario = $descuento[$i];
                    }
                    if ($peso[$i] > 0) {
                        if ($descuento[$i] == 0) {
                            $valor_gramo = $res[0]['valor_producto_iva'] / 1000;
                            $multiplicar = $valor_gramo * $peso[$i];
                        } else {
                            $valor_gramo = $descuento[$i] / 1000;
                            $multiplicar = $valor_gramo * $peso[$i];
                        }
                    } else {
                        if ($descuento[$i] == 0) {
                            $multiplicar = $res[0]['valor_producto_iva'] * $cantidad[$i];
                        } else {
                            $multiplicar = $descuento[$i] * $cantidad[$i];
                        }
                    }
                    $datoVenta = array(
                        'id_factura' => $idFactura,
                        'id_usuario' => $id_usuario,
                        'id_caja' => $id_caja,
                        'id_articulo' => $id_articulo[$i],
                        'peso' => $peso[$i],
                        'cantidad' => $cantidad[$i],
                        'valor_unitario' => $valor_unitario,
                        'precio_compra' => $multiplicar
                    );
                    $agregarVenta = new ControladorVenta();
                    $resVenta = $agregarVenta->agregarVenta($datoVenta);
                    if ($resVenta == true) {
                        $buscar = new ControladorArticulo();
                        $res = $buscar->mostrarArticulo($id_articulo[$i]);
                        $cantidad_articulo = $res[0]['cantidad_producto'];
                        if ($peso[$i] > 0) {
                            $total_cantidad_articulo = $cantidad_articulo - $peso[$i];
                        } else {
                            $total_cantidad_articulo = $cantidad_articulo - $cantidad[$i];
                        }
                        $dato_articulo = array(
                            'total_cantidad_articulo' => $total_cantidad_articulo,
                            'id_articulo' => $id_articulo[$i]
                        );
                        $actualizar_articulo = new ControladorArticulo();
                        $res_articulo = $actualizar_articulo->actualizarArticuloCantida($dato_articulo);
                        if ($res_articulo = true) {
                            echo '<script>window.location="factura_pdf"</script>';
                        }
                    }
                }
            }
        }
    }
}