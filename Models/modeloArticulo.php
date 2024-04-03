<?php

require_once 'conexion.php';

class ModeloArticulo
{
    public $tabla = 'articulos';

    function consultarAritucloProeevedoridAjaxModelo($nit)
    {

        $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON articulos.id_proeevedor = proeevedor.id_proeevedor INNER JOIN categoria ON articulos.id_categoria = categoria.id_categoria INNER JOIN medida ON medida.id_medida = articulos.id_medida WHERE articulos.codigo_producto like ? OR articulos.nombre_producto like ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($nit != null) {
                $nombre = '%'. $nit . '%';
                $nit = $nit . '%';
                $stms->bindParam(1, $nit, PDO::PARAM_STR);
                $stms->bindParam(2, $nombre, PDO::PARAM_STR);
            }
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function consultarAritucloProeevedorAjaxModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON articulos.id_proeevedor = proeevedor.id_proeevedor INNER JOIN categoria ON articulos.id_categoria = categoria.id_categoria INNER JOIN medida ON medida.id_medida = articulos.id_medida WHERE articulos.id_articulo = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($id != null) {
                $stms->bindParam(1, $id, PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function actualizarAritucloModelo($id_categoria, $proeevedor,$iva, $nombre_articulo, $id_medida, $valor, $cantidad, $valor_iva, $id_articulo)
    {
        $sql = "UPDATE $this->tabla SET id_categoria=?,id_proeevedor=?,iva=?,nombre_producto=?,id_medida=?,precio_unitario=?,cantidad_producto=?,valor_producto_iva=? WHERE id_articulo=?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($id_articulo != null) {
                $stms->bindParam(1, $id_categoria, PDO::PARAM_INT);
                $stms->bindParam(2, $proeevedor, PDO::PARAM_INT);
                $stms->bindParam(3, $iva, PDO::PARAM_INT);
                $stms->bindParam(4, $nombre_articulo, PDO::PARAM_STR);
                $stms->bindParam(5, $id_medida, PDO::PARAM_INT);
                $stms->bindParam(6, $valor, PDO::PARAM_INT);
                $stms->bindParam(7, $cantidad, PDO::PARAM_INT);
                $stms->bindParam(8, $valor_iva, PDO::PARAM_INT);
                $stms->bindParam(9, $id_articulo, PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function agregarAritucloModelo($id_categoria, $proeevedor, $iva, $codigo, $nombre, $id_medida, $valor, $cantidad, $valir_pruducto_final)
    {
        $sql = "INSERT INTO $this->tabla (id_categoria, id_proeevedor, iva, codigo_producto, nombre_producto, id_medida, precio_unitario, cantidad_producto, valor_producto_iva) VALUES (?,?,?,?,?,?,?,?,?)";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($proeevedor != null) {
                $stms->bindParam(1, $id_categoria, PDO::PARAM_INT);
                $stms->bindParam(2, $proeevedor, PDO::PARAM_INT);
                $stms->bindParam(3, $iva, PDO::PARAM_INT);
                $stms->bindParam(4, $codigo, PDO::PARAM_STR);
                $stms->bindParam(5, $nombre, PDO::PARAM_STR);
                $stms->bindParam(6, $id_medida, PDO::PARAM_INT);
                $stms->bindParam(7, $valor, PDO::PARAM_INT);
                $stms->bindParam(8, $cantidad, PDO::PARAM_INT);
                $stms->bindParam(9, $valir_pruducto_final, PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function contarDatoaArticuloModelo()
    {
        $sql = "SELECT COUNT(id_articulo) FROM $this->tabla";
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function listarArticuloModelo($dato, $LIM)
    {
        if ($dato != null) {
            $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON articulos.id_proeevedor = proeevedor.id_proeevedor INNER JOIN categoria ON articulos.id_categoria = categoria.id_categoria INNER JOIN medida ON medida.id_medida = articulos.id_medida WHERE articulos.codigo_producto like ? OR articulos.nombre_producto like ?";
        } else {
            $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON articulos.id_proeevedor = proeevedor.id_proeevedor INNER JOIN categoria ON articulos.id_categoria = categoria.id_categoria INNER JOIN medida ON medida.id_medida = articulos.id_medida LIMIT ?,?";
        }
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $dato = '%' . $dato . '%';
                $stms->bindParam(1, $dato, PDO::PARAM_STR);
                $stms->bindParam(2, $dato, PDO::PARAM_STR);
            } else {
                $stms = $conn->conectar()->prepare($sql);
                $stms->bindParam(1, $LIM['pagina'], PDO::PARAM_INT);
                $stms->bindParam(2, $LIM['limit'], PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function mostrarArticuloModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON articulos.id_proeevedor = proeevedor.id_proeevedor INNER JOIN categoria ON articulos.id_categoria = categoria.id_categoria INNER JOIN medida ON medida.id_medida = articulos.id_medida WHERE articulos.id_articulo = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($id != null) {
                $stms->bindParam(1, $id, PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function actualizarArticuloCantidaModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET cantidad_producto=? WHERE id_articulo=?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $stms->bindParam(1, $dato['total_cantidad_articulo'], PDO::PARAM_INT);
                $stms->bindParam(2, $dato['id_articulo'], PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function pruebaSQl(){
        $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON articulos.id_proeevedor = proeevedor.id_proeevedor INNER JOIN categoria ON articulos.id_categoria = categoria.id_categoria INNER JOIN medida ON medida.id_medida = articulos.id_medida";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

}