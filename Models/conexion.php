<?php
class Conexion{
    public function conectar(){
		$pdo = new PDO("mysql:host=localhost;dbname=inventario","root","");
		return $pdo;
	}
}
?>