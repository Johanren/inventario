<?php

class ControladorMedida
{
    function agregarMedida()
    {
        if (isset($_POST['agregar'])) {
            $dato = $_POST['medida'];
            $agregar = new ModeloMedida();
            $res = $agregar->agregarMedidaModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=medidaAgregado&pagina=1"</script>';
            }
        }
    }

    function contarDatosMedidaControlador()
    {
        $con = new ModeloMedida();
        $res = $con->contarDatoaMedidaModelo();
        return $res;
    }

    function listarMedidaControlador($pagina, $articulo)
    {
        $lis = new ModeloMedida();
        if (isset($_POST['buscar'])) {

            if ($_POST['buscar'] != null) {
                $dato = $_POST['buscar'];
                $res = $lis->listarMedidaModelo($dato, '');
                return $res;
            } else {
                $dato = $_POST['buscar'];
                $res = $lis->listarMedidaModelo($dato, '');
                return $res;
            }
        } else {
            $inial = ($pagina - 1) * $articulo;
            $lim = array(
                'proeevedor' => null,
                'pagina' => $inial,
                'limit' => 10
            );
            $res = $lis->listarMedidaModelo('', $lim);
            return $res;
        }
    }

    function consultarMedidaAjax($dato){
        $con = new ModeloMedida();
        $res = $con->consultarMedidaAjaxModelo($dato);
        return $res;
    }
}