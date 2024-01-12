<?php

require_once 'conexion.php';

class ModeloFacturaProeevedor
{
    public $tabla = "factura_proeevedor";
    function agregarFacturaProeevedorModelo($id_categoria, $proeevedor, $id_usuario, $id_medida, $codigo, $nombre, $valor, $cantidad)
    {
        $sql = "INSERT INTO $this->tabla (id_categoria, id_proeevedor, id_usuario, id_medida, codigo_producto, nombre_producto, precio_unitario, cantidad_producto) VALUES (?,?,?,?,?,?,?,?)";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($proeevedor != null) {
                $stms->bindParam(1, $id_categoria, PDO::PARAM_INT);
                $stms->bindParam(2, $proeevedor, PDO::PARAM_INT);
                $stms->bindParam(3, $id_usuario, PDO::PARAM_INT);
                $stms->bindParam(4, $id_medida, PDO::PARAM_INT);
                $stms->bindParam(5, $codigo, PDO::PARAM_STR);
                $stms->bindParam(6, $nombre, PDO::PARAM_STR);
                $stms->bindParam(7, $valor, PDO::PARAM_INT);
                $stms->bindParam(8, $cantidad, PDO::PARAM_INT);
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

    function contarDatoaFacturaProeevedorModelo()
    {
        $sql = "SELECT COUNT(DISTINCT(fecha_ingreso)) FROM $this->tabla";
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

    function listarFacturaProeevedoModelo($dato, $LIM)
    {
        if ($dato != null) {
            $sql = "SELECT DISTINCT proeevedor.id_proeevedor, proeevedor.nombre_proeevedor, factura_proeevedor.fecha_ingreso FROM $this->tabla INNER JOIN proeevedor ON proeevedor.id_proeevedor = factura_proeevedor.id_proeevedor WHERE fecha_ingreso like ?";
        } else {
            $sql = "SELECT DISTINCT proeevedor.id_proeevedor, proeevedor.nombre_proeevedor, factura_proeevedor.fecha_ingreso FROM $this->tabla INNER JOIN proeevedor ON proeevedor.id_proeevedor = factura_proeevedor.id_proeevedor ORDER BY factura_proeevedor.fecha_ingreso DESC LIMIT ?,?";
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

    function mostrarFacturaProeevedorModelo($id, $fecha){
        $sql = "SELECT * FROM $this->tabla INNER JOIN usuario ON usuario.id_usuario = factura_proeevedor.id_usuario INNER JOIN proeevedor ON factura_proeevedor.id_proeevedor = proeevedor.id_proeevedor INNER JOIN categoria ON factura_proeevedor.id_categoria = categoria.id_categoria INNER JOIN medida ON medida.id_medida = factura_proeevedor.id_medida WHERE factura_proeevedor.id_proeevedor = ? AND factura_proeevedor.fecha_ingreso like ?";
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($id != null) {
                $fecha = $fecha."%";
                $stms->bindParam(1, $id, PDO::PARAM_INT);
                $stms->bindParam(2, $fecha, PDO::PARAM_STR);
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
}