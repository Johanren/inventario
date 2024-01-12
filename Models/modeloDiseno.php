<?php

require_once 'conexion.php';
class ModeloDiseno
{
    public $tabla = 'diseno_sistema';
    function agregarDisenoModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (nom_sistema, nit, telefono, direccion, icon_sistema, id_activo) VALUES (?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nombre'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['nit'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['telefono'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['direccion'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['icon'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['activo'], PDO::PARAM_INT);
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

    function contarDatoDisenoModelo()
    {
        $sql = "SELECT COUNT(id_diseno) FROM $this->tabla";
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

    function listarDisenoModelo($dato, $LIM)
    {
        if ($dato != null) {
            $sql = "SELECT * FROM $this->tabla INNER JOIN activo ON diseno_sistema.id_activo = activo.id_activo WHERE nom_sistema like ?";
        } else {
            $sql = "SELECT * FROM $this->tabla INNER JOIN activo ON diseno_sistema.id_activo = activo.id_activo LIMIT ?,?";
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

    function listarDisenoEditarModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_diseno=?";
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

    function actualizarDisenoModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET id_activo = ? WHERE id_diseno = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['activo'], PDO::PARAM_INT);
            $stms->bindParam(2, $dato['id'], PDO::PARAM_INT);
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

    function listarDisenoTempleteModelo()
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_activo=1";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
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
}