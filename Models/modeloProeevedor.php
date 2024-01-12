<?php

require_once 'conexion.php';
class ModeloProeevedor
{
    public $tabla = 'proeevedor';
    function agregarProeevedorModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (nit_proeevedor, nombre_proeevedor, telefono_proeevedor, direccion_proeevedor) VALUES (?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nit'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['nombre'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['tel'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['dire'], PDO::PARAM_STR);
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

    function contarDatoaProeevedorModelo()
    {
        $sql = "SELECT COUNT(id_proeevedor) FROM $this->tabla";
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

    function listarProeevedorModelo($dato, $LIM)
    {
        if ($dato != null) {
            $sql = "SELECT * FROM $this->tabla WHERE nit_proeevedor like ? OR nombre_proeevedor like ?";
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

    function actualizarProeevedorModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET nit_proeevedor=?,nombre_proeevedor=?,telefono_proeevedor=?,direccion_proeevedor=? WHERE id_proeevedor=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nit'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['nombre'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['tel'], PDO::PARAM_INT);
            $stms->bindParam(4, $dato['dire'], PDO::PARAM_STR);
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

    function listarProeevedorEditarModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_proeevedor=?";
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

    function consultarProeevedorAjaxModelo($dato)
    {
        if ($dato != '') {
            $dato = '%' . $dato . '%';
            $sql = "SELECT * FROM $this->tabla WHERE nit_proeevedor like ? OR nombre_proeevedor like ? ORDER BY id_proeevedor ";
        } else {
            $sql = "SELECT * FROM $this->tabla ORDER BY id_proeevedor";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != '') {
                $stms->bindParam(1, $dato, PDO::PARAM_STR);
                $stms->bindParam(2, $dato, PDO::PARAM_STR);
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