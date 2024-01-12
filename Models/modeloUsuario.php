<?php

require_once 'conexion.php';
class ModeloUsuario
{
    public $tabla = 'usuario';

    function ModeloLoginIngresar($dato)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN rol ON usuario.id_rol = rol.id_rol INNER JOIN activo ON usuario.id_activo = activo.id_activo INNER JOIN caja ON usuario.id_caja = caja.id_caja WHERE usuario.usuario = ? AND usuario.clave = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['usuario'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['clave'], PDO::PARAM_STR);
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

    function agregarUsuarioModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (usuario, clave, id_activo, id_rol, id_caja) VALUES (?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['usuario'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['clave'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['id_activo'], PDO::PARAM_INT);
            $stms->bindParam(4, $dato['id_rol'], PDO::PARAM_INT);
            $stms->bindParam(5, $dato['id_caja'], PDO::PARAM_INT);
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

    function contarDatoaUsuarioModelo()
    {
        $sql = "SELECT COUNT(id_usuario) FROM $this->tabla";
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

    function listarUsuarioModelo($dato, $LIM)
    {
        if ($dato != null) {
            $sql = "SELECT * FROM $this->tabla INNER JOIN activo ON usuario.id_activo = activo.id_activo INNER JOIN rol ON usuario.id_rol = rol.id_rol INNER JOIN caja ON usuario.id_caja = caja.id_caja WHERE usuario like ? OR rol.rol like ?";
        } else {
            $sql = "SELECT * FROM $this->tabla INNER JOIN activo ON usuario.id_activo = activo.id_activo INNER JOIN rol ON usuario.id_rol = rol.id_rol INNER JOIN caja ON usuario.id_caja = caja.id_caja LIMIT ?,?";
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

    function listarUsuarioEditarModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_usuario=?";
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

    function actualizarUsuarioModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET usuario=?,clave=?,id_activo=?,id_rol=?,id_caja=? WHERE id_usuario=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['usuario'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['clave'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['id_activo'], PDO::PARAM_INT);
            $stms->bindParam(4, $dato['id_rol'], PDO::PARAM_INT);
            $stms->bindParam(5, $dato['id_caja'], PDO::PARAM_INT);
            $stms->bindParam(6, $dato['id'], PDO::PARAM_INT);
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