<?php

require_once "conexion.php";

class ModeloProyectosGerente{

	/*=============================================
	MOSTRAR Proyectos
	=============================================*/

	static public function mdlMostrarProyectosGererente($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProyecto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarProyectosGerente($id,$categoria, $presupuesto,$plazo,$hito,$tarea,$empleado,$horas,$numero,$ubicacion){


        $stmt = Conexion::conectar()->prepare("UPDATE `proyecto_gerente` SET `id_categoria`='$categoria',`presupuesto`='$presupuesto',`plazo`='$plazo',`id_hito`='$hito',`horas`='$horas',`numero`='$numero',`ubicacion`='$ubicacion',`empleado`='$empleado',`tareas`='$tarea' WHERE id = '$id'");


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	
}
?>