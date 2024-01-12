<?php

require_once 'conexion.php';
class ModeloCaja
{
    public $tabla = 'caja';
    function listarCajaModelo()
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_activo = 1";
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

    function agregarCajaModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (nombre_caja, id_activo) VALUES (?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['caja'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['activo'], PDO::PARAM_INT);
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

    function contarDatoaCajaModelo()
    {
        $sql = "SELECT COUNT(id_caja) FROM $this->tabla";
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

    function listarCajasModelo($dato, $LIM)
    {
        if ($dato != null) {
            $sql = "SELECT * FROM $this->tabla INNER JOIN activo ON caja.id_activo = activo.id_activo WHERE nombre_caja like ? OR activo.nombre_activo like ?";
        } else {
            $sql = "SELECT * FROM $this->tabla INNER JOIN activo ON caja.id_activo = activo.id_activo LIMIT ?,?";
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

    function actualizarCajaModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET nombre_caja = ?, id_activo = ? WHERE  id_caja = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['caja'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['activo'], PDO::PARAM_INT);
            $stms->bindParam(3, $dato['id'], PDO::PARAM_INT);
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
}