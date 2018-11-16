<?php 
require_once "usuario.modelo.php";
$usuarioModelo = new UsuarioModelo();
$idstudent = isset($_POST["idstudent"]) ? limpiarCadena($_POST["idstudent"]) :'';
$name = isset($_POST["name"]) ? limpiarCadena($_POST["name"]) :'';
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) :'';
$web = isset($_POST["web"]) ? limpiarCadena($_POST["web"]) :'';

	$res = array('error'=>false);
	$action = 'listar';

	if(isset( $_GET['operacion'])){
		$action = $_GET['operacion'];
	}
	header( 'Content-type: application/json' );

	if($action == "insertaryactualizar"){
		if(empty($idstudent)){

			$rspta = $usuarioModelo->insertar($name,$email,$web);

			if($rspta){
				$res["message"] = "Estudiante registrado";
			}else{
				$res["error"] = true;
				$res["message"] = "Estudiante no se pudo registrar";
			}
			echo json_encode($res);
		}else{
			$rspta = $usuarioModelo->actualizar($idstudent,$name,$email,$web);
			if($rspta){
				$res["message"] = "Estudiante actualizado con exito";
			}else{
				$res["error"] = true;
				$res["message"] = "Estudiante no se pudo actualizar";
			}
			echo json_encode($res);
		}

	}
		
	// if($action =='mostrar'){
	// 	$rspta = $usuarioModelo->mostrar($idstudent);
	// 	$students = array();
	// 	array_push($students,$rspta);
	// 	$res["students"] = $students;
	// }

	if($action =='listar'){
		$rspta = $usuarioModelo->listar();
		$students = array();
		while($row = $rspta->fetch_assoc()){
			array_push($students,$row);
		}
		$res["students"] = $students;
		echo json_encode($res);
		
	}


	if($action == "eliminar"){
		$rspta = $usuarioModelo->eliminar($idstudent);
		if($rspta){
			$res["message"] = "Estudiante eliminado";
		}else{
			$res["error"] = true;
			$res["message"] = "Estudiante no se pudo eliminar";
		}
		
		echo json_encode($res);
	}

