<?php

class ControladorDiseno
{
    function agregarDiseno()
    {
        if (isset($_POST['agregar'])) {
            //Recogemos el archivo enviado por el formulario
            $archivo = $_FILES['subirAntes']['name'];
            //Si el archivo contiene algo y es diferente de vacio
            if (isset($archivo) && $archivo != "") {
                //Obtenemos algunos datos necesarios sobre el archivo
                $tipo = $_FILES['subirAntes']['type'];
                $tamano = $_FILES['subirAntes']['size'];
                $temp = $_FILES['subirAntes']['tmp_name'];
                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "webp") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                    - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                } else {
                    //Si la imagen es correcta en tamaño y tipo
                    //Se intenta subir al servidor
                    if (move_uploaded_file($temp, 'Views/img/diseno_sistema/' . $archivo)) {
                        //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                        chmod('Views/img/diseno_sistema/' . $archivo, 0777);
                        //Mostramos el mensaje de que se ha subido co éxito
                        echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                        //Mostramos la imagen subida
                        //echo '<p><img src="Views/img/diseno_sistema/' . $archivo . '"></p>';
                    } else {
                        //Si no se ha podido subir la imagen, mostramos un mensaje de error
                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                    }
                }
            }
            $img = 'Views/img/diseno_sistema/' . $archivo . '';
            $dato = array(
                'nombre' => $_POST['nombre'],
                'nit' => $_POST['nit'],
                'telefono' => $_POST['telefono'],
                'direccion' => $_POST['direccion'],
                'icon' => $img,
                'activo' => 1
            );
            $agregar = new ModeloDiseno();
            $res = $agregar->agregarDisenoModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=disenoAgregado&pagina=1"</script>';
            }
        } elseif (isset($_POST['actualizar'])) {
            $dato = array(
                'activo' => $_POST['activo'],
                'id' => $_GET['id_diseno']
            );
            $actualizar = new ModeloDiseno();
            $res = $actualizar->actualizarDisenoModelo($dato);
            if ($res == true) {
                echo '<script>window.location="index.php?action=disenoActualizado&pagina=1"</script>';
            }
        }
    }

    function contarDatosDisenoControlador()
    {
        $con = new ModeloDiseno();
        $res = $con->contarDatoDisenoModelo();
        return $res;
    }

    function listarDisenoControlador($pagina, $articulo)
    {
        $lis = new ModeloDiseno();
        if (isset($_POST['buscar'])) {

            if ($_POST['buscar'] != null) {
                $dato = $_POST['buscar'];
                $res = $lis->listarDisenoModelo($dato, '');
                return $res;
            } else {
                $dato = $_POST['buscar'];
                $res = $lis->listarDisenoModelo($dato, '');
                return $res;
            }
        } else {
            $inial = ($pagina - 1) * $articulo;
            $lim = array(
                'proeevedor' => null,
                'pagina' => $inial,
                'limit' => 10
            );
            $res = $lis->listarDisenoModelo('', $lim);
            return $res;
        }
    }

    function listarDisenoEditar()
    {
        if (isset($_GET['id_diseno'])) {
            $id = $_GET['id_diseno'];
            $listar = new ModeloDiseno();
            $res = $listar->listarDisenoEditarModelo($id);
            return $res;
        }
    }

    function listarDisenoTemplete()
    {
        $listar = new ModeloDiseno();
        $res = $listar->listarDisenoTempleteModelo();
        return $res;
    }
}