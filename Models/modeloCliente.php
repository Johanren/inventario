<?php

require_once 'conexion.php';
class ModeloCliente
{
    public $tabla = 'cliente';
    function agregarClienteModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (nombre, apellido, numero_cedula, correo) VALUES (?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nombre'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['apellido'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['cc'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['email'], PDO::PARAM_STR);
        }
        try {
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function contarDatoaClienteModelo()
    {
        $sql = "SELECT COUNT(id_cliente) FROM $this->tabla";
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

    function listarClienteModelo($dato, $LIM)
    {
        if ($dato != null) {
            $sql = "SELECT * FROM $this->tabla WHERE nombre like ? OR apellido like ?";
        } else {
            $sql = "SELECT * FROM $this->tabla LIMIT ?,?";
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

    function listarClienteEditarModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_cliente=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id != '') {
            $stms->bindParam(1, $id, PDO::PARAM_INT);
        }
        try {
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function actualizarClienteModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET nombre=?,apellido=?,numero_cedula=?,correo=? WHERE id_cliente=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nombre'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['apellido'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['cc'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['email'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['id'], PDO::PARAM_INT);
        }
        try {
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function consultarClienteAjaxModelo($dato)
    {
        if ($dato != '') {
            $sql = "SELECT * FROM $this->tabla WHERE numero_cedula like '%$dato%' ORDER BY id_cliente";
        } else {
            $sql = "SELECT * FROM $this->tabla ORDER BY id_cliente";
        }

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

    function mostrarClienteFacturaVentaModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_cliente = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($id != null) {
                $stms->bindParam(1, $id, PDO::PARAM_STR);
            }
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

    }

}