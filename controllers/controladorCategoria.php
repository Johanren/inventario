<?php

class ControladorCategoria
{
    function agregarCategoria()
    {
        if (isset($_POST['agregar'])) {
            $dato = $_POST['nombre'];
            $agregar = new ModeloCategoria();
            $res = $agregar->agregarCategoriaModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=categoriaAgregado&pagina=1"</script>';
            }
        }
    }
    function contarDatosCategoriaControlador()
    {
        $con = new ModeloCategoria();
        $res = $con->contarDatoaCategoriaModelo();
        return $res;
    }

    function listarCategoriaControlador($pagina, $articulo)
    {
        $lis = new ModeloCategoria();
        if (isset($_POST['buscar'])) {

            if ($_POST['buscar'] != null) {
                $dato = $_POST['buscar'];
                $res = $lis->listarCategoriaModelo($dato, '');
                return $res;
            } else {
                $dato = $_POST['buscar'];
                $res = $lis->listarCategoriaModelo($dato, '');
                return $res;
            }
        } else {
            $inial = ($pagina - 1) * $articulo;
            $lim = array(
                'proeevedor' => null,
                'pagina' => $inial,
                'limit' => 10
            );
            $res = $lis->listarCategoriaModelo('', $lim);
            return $res;
        }
    }

    function consultarCategoriaAjax($dato){
        $con = new ModeloCategoria();
        $res = $con->consultarCategoriaAjaxModelo($dato);
        return $res;
    }
}