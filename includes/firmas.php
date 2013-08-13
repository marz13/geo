<?php

require_once 'database.php';

class firmas extends DataBase {

	
	
	function getAllFirmas($busqueda=''){
		$retorno = false;
		$sql = "SELECT * FROM firmas WHERE estado='1' ";
		if($busqueda!=''){
			$sql .= "and concat(persona,'',tarjetaProfesional) like('%".$this->real_escape_string($busqueda)."%')";
		}
		$respuesta = $this->query($sql);
		if ( $respuesta ) {
			$matriz = array();
			while ( $fila = $respuesta->fetch_object() ) {
				$matriz[] = $fila;
			}
			$respuesta->free();
			$retorno = $matriz;
		}
		return $retorno;
	}

	function addFirma( $cedula, $usuario, $clave, $confirmar_clave, $nombres, $apellidos, $cargo) {
		$retorno = false;
		if($clave!=$confirmar_clave){
			$retorno= false;	
		}
		else{
			if($cargo=="Administrador" || $cargo=="Ingeniero" || $cargo=="Laboratorista" ){	
				$sql = "INSERT INTO usuarios (id_usuario,cedula,nombres,apellidos,tipo,nombre_usuario,password,estado)"
							."VALUES (NULL,'".$this->real_escape_string($cedula)."','".$this->real_escape_string($nombres)
							."','".$this->real_escape_string($apellidos)."','".$this->real_escape_string($cargo)
							."','".$this->real_escape_string($usuario)."','".$this->real_escape_string($clave)
							."','1')";
				$respuesta = $this -> query($sql);
			}
		}
		if ( $respuesta ) {
			$retorno = true;
		}
		return $retorno;
	}

	function eliminarFirma($id) {
		$retorno = false;
		$sql = "UPDATE proyectos SET estado='0' WHERE id_proyecto='".$this->real_escape_string($id)."' ";
		$respuesta = $this-> query($sql);
		if ( $respuesta ) {
			$retorno = true;
		}
		return $retorno;
	}

	function ModificarFirma($id_usuario,$cedula, $usuario, $clave, $confirmar_clave, $nombres, $apellidos, $cargo) {
		$retorno = false;
		if($clave==""){
			if(isset($cargo)){
				$sql = "UPDATE usuarios SET cedula='$cedula', nombres='$nombres', apellidos='$apellidos', tipo='$cargo', nombre_usuario='$usuario'  WHERE id_usuario='".$this->real_escape_string($id_usuario)."' ";
				$respuesta = $this-> query($sql);
			}
			else{
				$sql = "UPDATE usuarios SET cedula='$cedula', nombres='$nombres', apellidos='$apellidos',nombre_usuario='$usuario'  WHERE id_usuario='".$this->real_escape_string($id_usuario)."' ";
				$respuesta = $this-> query($sql);
			}
		}
		else if($clave!="" && $clave==$confirmar_clave){
			if(isset($cargo)){
				$sql = "UPDATE usuarios SET cedula='$cedula', nombres='$nombres', apellidos='$apellidos', tipo='$cargo', nombre_usuario='$usuario'  WHERE id_usuario='".$this->real_escape_string($id_usuario)."' ";
				$respuesta = $this-> query($sql);
			}
			else{
				$sql = "UPDATE usuarios SET cedula='$cedula', nombres='$nombres', apellidos='$apellidos',nombre_usuario='$usuario'  WHERE id_usuario='".$this->real_escape_string($id_usuario)."' ";
				$respuesta = $this-> query($sql);
			}
		}
		if ( $respuesta ) {
			$retorno = true;
		}
		return $retorno;
	}
	
}
?>