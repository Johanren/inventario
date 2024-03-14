<?php

require_once "conexion.php";
class ModeloPromocion
{
    public $tabla = "promocion";
    function agregarPromocionModelo($id_promocion, $codigo, $nombre, $precio, $id_articulo, $id_estado)
    {
        $sql = "INSERT INTO $this->tabla (id_promocion_articulo, codigo_promocion, nombre_promocion, precio_promocion, id_articulo, id_activo) VALUES (?,?,?,?,?,?)";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($codigo != null) {
                $stms->bindParam(1, $id_promocion, PDO::PARAM_INT);
                $stms->bindParam(2, $codigo, PDO::PARAM_INT);
                $stms->bindParam(3, $nombre, PDO::PARAM_STR);
                $stms->bindParam(4, $precio, PDO::PARAM_INT);
                $stms->bindParam(5, $id_articulo, PDO::PARAM_INT);
                $stms->bindParam(6, $id_estado, PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return true;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function contarDatoaPromocionModelo()
    {
        $sql = "SELECT COUNT(codigo_promocion) FROM $this->tabla";
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

    function listarPromocionModelo($dato, $LIM)
    {
        if ($dato != null) {
            $sql = "SELECT DISTINCT id_promocion_articulo, codigo_promocion, nombre_promocion, precio_promocion, activo.nombre_activo FROM promocion INNER JOIN activo ON activo.id_activo = promocion.id_activo WHERE nombre_promocion like ?";
        } else {
            $sql = "SELECT DISTINCT id_promocion_articulo, codigo_promocion, nombre_promocion, precio_promocion, activo.nombre_activo FROM promocion INNER JOIN activo ON activo.id_activo = promocion.id_activo LIMIT ?,?";
        }
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $dato = '%' . $dato . '%';
                $stms->bindParam(1, $dato, PDO::PARAM_STR);
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

    function lstarArticuloPromocionModulo($codigo)
    {
        $sql = "SELECT DISTINCT articulos.nombre_producto, promocion.id_articulo FROM $this->tabla INNER JOIN articulos ON articulos.id_articulo = promocion.id_articulo WHERE codigo_promocion = ? OR id_promocion_articulo = ?";
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($codigo != null) {
                $stms->bindParam(1, $codigo, PDO::PARAM_INT);
                $stms->bindParam(2, $codigo, PDO::PARAM_INT);
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

    function ConsultarPromocionModelo($codigo)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN articulos ON articulos.id_articulo = promocion.id_articulo INNER JOIN activo ON activo.id_activo = promocion.id_activo WHERE codigo_promocion = ?";
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($codigo != null) {
                $stms->bindParam(1, $codigo, PDO::PARAM_INT);
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

    function actualizarPromocionModelo($estado, $id_articulo,$id_promocion)
    {
        $sql = "UPDATE $this->tabla SET id_activo = ? WHERE id_articulo = ? AND id_promocion_articulo = ?";
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($estado != null) {
                $stms->bindParam(1, $estado, PDO::PARAM_INT);
                $stms->bindParam(2, $id_articulo, PDO::PARAM_INT);
                $stms->bindParam(3, $id_promocion, PDO::PARAM_INT);
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
}