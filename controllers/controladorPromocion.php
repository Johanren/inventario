<?php

class ControladorPromocion
{
    function agregarPromocion()
    {
        if (isset($_POST['agregar'])) {
            $id_promocion = $_POST['id_promocion'];
            $codigo = $_POST['codigo'];
            $nombre = $_POST['articulo'];
            $precio = $_POST['precio'];
            $id_estado = 1;
            $id_articulo = $_POST['id_articulo'];
            for ($i = 0; $i < count($id_articulo); $i++) {
                $agregar = new ModeloPromocion();
                $res = $agregar->agregarPromocionModelo($id_promocion, $codigo, $nombre, $precio, $id_articulo[$i], $id_estado);
                if ($res == true) {
                    echo '<script>window.location="index.php?action=okPromocion&pagina=1"</script>';
                }
            }
        }
    }

    function contarDatosPromocionControlador()
    {
        $con = new ModeloPromocion();
        $res = $con->contarDatoaPromocionModelo();
        return $res;
    }

    function listarPromocionControlador($pagina, $articulo)
    {
        $lis = new ModeloPromocion();
        if (isset($_POST['buscar'])) {

            if ($_POST['buscar'] != null) {
                $dato = $_POST['buscar'];
                $res = $lis->listarPromocionModelo($dato, '');
                return $res;
            } else {
                $dato = $_POST['buscar'];
                $res = $lis->listarPromocionModelo($dato, '');
                return $res;
            }
        } else {
            $inial = ($pagina - 1) * $articulo;
            $lim = array(
                'proeevedor' => null,
                'pagina' => $inial,
                'limit' => 10
            );
            $res = $lis->listarPromocionModelo('', $lim);
            return $res;
        }
    }

    function lstarArticuloPromocion($codigo)
    {
        $consul = new ModeloPromocion();
        $res = $consul->lstarArticuloPromocionModulo($codigo);
        return $res;
    }

    function ConsultarPromocion()
    {
        if (isset($_GET['codigo_promocion'])) {
            $codigo = $_GET['codigo_promocion'];
            $consultar = new ModeloPromocion();
            $res = $consultar->ConsultarPromocionModelo($codigo);
            return $res;
        }
    }

    function actualizarPromocion()
    {
        if (isset($_POST['agregar'])) {
            $Codigopromocion = $_POST['Codigopromocion'];
            $id_articulo = $_POST['id_articulo'];
            $id_promocion = $_POST['id_promocion'];
            $codigo = $_POST['codigo'];
            $articulo = $_POST['articulo'];
            $precio = $_POST['precio'];
            $id_articulo = $_POST['id_articulo'];
            $estado = $_POST['estado'];
            for ($i = 0; $i < count($Codigopromocion); $i++) {
                if (isset($estado[$i])) {
                    $actualizar = new ModeloPromocion();
                    $res = $actualizar->actualizarPromocionModelo($estado[$i], $id_articulo[$i], $id_promocion);
                    if ($res == true) {
                        echo '<script>window.location="index.php?action=okPromocionActu&pagina=1"</script>';
                    }
                } else {
                    if ($id_articulo[$i] != 0) {
                        $agregar = new ModeloPromocion();
                        $res = $agregar->agregarPromocionModelo($id_promocion, $codigo, $articulo, $precio, $id_articulo[$i], $estado);
                        if ($res == true) {
                            echo '<script>window.location="index.php?action=okPromocion&pagina=1"</script>';
                        }
                    }
                }
            }
        }
    }
}