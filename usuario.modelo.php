<?php 
require_once "config.php";

Class UsuarioModelo{

	public function __construct(){

	}
	public function insertar($name,$email,$web){
		$query = "INSERT INTO students(name,email,web) VALUES ('$name','$email','$web')";
		return ejecutarConsulta($query);
	}

	public function actualizar($idstudent,$name,$email,$web){
		$query = "UPDATE students SET name='$name', email='$email', web='$web' WHERE idstudent='$idstudent'";
		return ejecutarConsulta($query);
	}
	public function eliminar($idstudent){
		$query = "DELETE FROM students WHERE idstudent='$idstudent'";
		return ejecutarConsulta($query);
	}

	public function mostrar($idstudent){
		$query = "SELECT * FROM students WHERE idstudent='$idstudent'";
		return ejecutarConsultaSimple($query);
	}
	public function listar(){
		$query = "SELECT * FROM students";
		return ejecutarConsulta($query);
	}



}