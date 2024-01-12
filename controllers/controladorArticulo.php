<?php

class ControladorArticulo
{
    function consultarAritucloProeevedoridAjax($nit)
    {
        $conusltar = new ModeloArticulo();
        $res = $conusltar->consultarAritucloProeevedoridAjaxModelo($nit);
        return $res;
    }

    function consultarAritucloProeevedorAjax($id)
    {
        $conusltar = new ModeloArticulo();
        $res = $conusltar->consultarAritucloProeevedorAjaxModelo($id);
        return $res;
    }

    function agregarArticulo()
    {
        if (isset($_POST['agregar'])) {
            $id_articulo = $_POST['id_articulo'];
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $id_categoria = $_POST['id_categoria'];
            $categoria = $_POST['categoria'];
            $id_medida = $_POST['id_medida'];
            $medida = $_POST['medida'];
            $iva = $_POST['iva'];
            $valor = $_POST['valor'];
            $cantidad = $_POST['cantidad'];
            $cantidad_articulo = $_POST['cantidad_articulo'];
            $proeevedor = $_POST['proeevedor'];
            for ($i = 0; $i < count($id_medida); $i++) {
                if ($id_articulo[$i] != null) {
                    $iva_prociento = $iva[$i] / 100;
                    $valor_iva = $valor[$i] * $iva_prociento;
                    $valir_pruducto_final = $valor_iva + $valor[$i];
                    $suma_articulo = $cantidad[$i] + $cantidad_articulo[$i];
                    $actualizar = new ModeloArticulo();
                    $resActualizar = $actualizar->actualizarAritucloModelo($id_categoria[$i], $proeevedor,$iva[$i], $nombre[$i], $id_medida[$i], $valor[$i], $suma_articulo, $valir_pruducto_final, $id_articulo[$i]);
                } else {
                    $iva_prociento = $iva[$i] / 100;
                    $valor_iva = $valor[$i] * $iva_prociento;
                    $valir_pruducto_final = $valor_iva + $valor[$i];
                    $agregar = new ModeloArticulo();
                    $resAgregar = $agregar->agregarAritucloModelo($id_categoria[$i], $proeevedor, $iva[$i], $codigo[$i], $nombre[$i], $id_medida[$i], $valor[$i], $cantidad[$i], $valir_pruducto_final);

                }

                //Agregar factura proeevedor
                $iva_prociento = $iva[$i] / 100;
                $valor_iva = $valor[$i] * $iva_prociento;
                $valir_pruducto_final = $valor_iva + $valor[$i];
                $agregarFactura = new ControladorFacturaProeevedor();
                $agregarFactura->agregarFacturaProeevedor($id_categoria[$i], $proeevedor, $_SESSION['id_usuario'], $id_medida[$i], $codigo[$i], $nombre[$i], $valor[$i], $cantidad[$i]);
            }
            if ($resActualizar == true) {
                echo '<script>window.location="index.php?action=articuloActualizar&pagina=1"</script>';
            }
            if ($resAgregar == true) {
                echo '<script>window.location="index.php?action=articuloRegistrado&pagina=1"</script>';
            }
        }
    }

    function contarDatosArticuloControlador()
    {
        $con = new ModeloArticulo();
        $res = $con->contarDatoaArticuloModelo();
        return $res;
    }

    function listarArticuloControlador($pagina, $articulo)
    {
        $lis = new ModeloArticulo();
        if (isset($_POST['buscar'])) {

            if ($_POST['buscar'] != null) {
                $dato = $_POST['buscar'];
                $res = $lis->listarArticuloModelo($dato, '');
                return $res;
            } else {
                $dato = $_POST['buscar'];
                $res = $lis->listarArticuloModelo($dato, '');
                return $res;
            }
        } else {
            $inial = ($pagina - 1) * $articulo;
            $lim = array(
                'proeevedor' => null,
                'pagina' => $inial,
                'limit' => 10
            );
            $res = $lis->listarArticuloModelo('', $lim);
            return $res;
        }
    }

    function mostrarArticulo($dato){
        $buscar = new ModeloArticulo();
        $res = $buscar->mostrarArticuloModelo($dato);
        return $res;
    }

    function actualizarArticuloCantida($dato){
        $actualizar = new ModeloArticulo();
        $res = $actualizar->actualizarArticuloCantidaModelo($dato);
        return $res;
    }
}