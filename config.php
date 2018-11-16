<?php 
require_once "global.php";

$conexion = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if($conexion->connect_error){
	echo "Ocurrio un error: ".mysqli_connect_error();
	exit();
}
if(!function_exists('ejecutarConsulta')){

	function ejecutarConsulta($sql){
		global $conexion;
		// $query = $conexion->query($sql);
		$query = mysqli_query($conexion,$sql);
		return $query;
		mysqli_close($conexion);
	}


	function ejecutarConsultaSimple($sql){
		global $conexion;
		$query = $conexion->query($sql);
		$rspta = $query->fetch_assoc();
		return $rspta;
		mysqli_close($conexion);
	}


	function limpiarCadena($str){
		global $conexion;
		$str = mysqli_real_escape_string($conexion,trim($str));
		return htmlspecialchars($str);
		mysqli_close($conexion);
	}

}
