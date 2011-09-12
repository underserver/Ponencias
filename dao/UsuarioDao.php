<?php
include_once dirname(__FILE__)."/Dao.php";
include_once dirname(__FILE__)."/../model/Usuario.php";

class UsuarioDao implements Dao{
	
	public static function deleteAll($usuarios){
		foreach( $usuarios as $usuario ){
			try{
				UsuarioDao::delete($usuario);
			}catch(TransactionException $te){
				throw $te;
			}
		}
	}
	
	public static function save($usuario){
		require dirname(__FILE__)."/../includes/db.php";
		
		try{
			$sql  = "insert into usuarios(usuario_nombre, usuario_apellidos, usuario_correo, usuario_telefono, usuario_direccion, usuario_nacimiento, usuario_alias, usuario_password, usuario_tipo) ";
		  	$sql .= "values('$usuario->getNombre()','$usuario->getApellidos()' ";
		 	$sql .= ",'$usuario->getCorreo()','$usuario->getTelefono()'";
			$sql .= ",'$usuario->getDireccion()','$usuario->getFechaNacimiento()'";
		 	$sql .= ",'$usuario->getAlias()','$usuario->getPassword()'";
		  	$sql .= ",'$usuario->getTipo()')";
			
			$db->query($sql);
		}catch(Exception $e){
    			throw new TransactionExcepion($e->getMessage(), $usuario, TransactionExcepion::SAVE_CODE, $e);
    		}
	}
	
	public static function update($usuario){
		require dirname(__FILE__)."/../includes/db.php";
		
		try{
			$sql  = "update usuarios set";
		  	$sql .= "       usuario_nombre = '$usuario->getNombre()',";
		 	$sql .= "       usuario_apellidos = '$usuario->getApellidos()',";
			$sql .= "       usuario_correo = '$usuario->getCorreo()',";
			$sql .= "       usuario_telefono = '$usuario->getTelefono()',";
			$sql .= "       usuario_direccion = '$usuario->getDireccion()',";
			$sql .= "       usuario_nacimiento = '$usuario->getFechaNacimiento()',";
			$sql .= "       usuario_alias = '$usuario->getAlias()',";
			$sql .= "       usuario_password = '$usuario->getPassword()',";
			$sql .= "       usuario_tipo = '$usuario->getTipo()'";
			$sql .= " where usuario_id=$usuario->getId()";
			
			$db->query($sql);
		}catch(Exception $e){
    			throw new TransactionExcepion($e->getMessage(), $usuario, TransactionExcepion::UPDATE_CODE, $e);
		}
	}
	
	public static function persist($usuario){
		try{
			$id = $usuario->getId();
			if( !empty($id) ){
				UsuarioDao::save($usuario);
			}else{
				UsuarioDao::update($usuario);
			}
		}catch(TransactionException $te){
			throw $te;
		}		
	} 
	
	public static function delete($usuario){
		require dirname(__FILE__)."/../includes/db.php";
		
		try {
			$db->query("delete from usuarios where usuario_id=$usuario->getId()");
		}catch(Exception $e){
			throw new TransactionExcepion($e->getMessage(), $usuario, TransactionExcepion::DELETE_CODE, $e);
		}
	}
	
	public static function findByQuery($query){
		require dirname(__FILE__)."/../includes/db.php";
		
		$users = array();
		$sql = "select * from usuarios where $query";
		try{
			$rows = $db->get_results( $sql );
			foreach( $rows as $row ){
				$users[] = new Usuario($row);
			}
		}catch(Exception $e){
    			throw new QueryException($e->getMessage(), $sql, 0, $e);
    		}
		return $users;
	} 
	
	public static function merge($usuario){
		echo "Merge [Usuario]: Not Implemented";
	}
	
	public static function findAll(){
		$users = array();
		try{
			$users = UsuarioDao::findByQuery( "1=1" );
		}catch(QueryException $qe){
			throw $qe;
		}
		return $users;
	}
	
	public static function findById($id){
		require dirname(__FILE__)."/../includes/db.php";
		
		$sql = "select * from usuarios where usuario_id=$id";
		$usuario = new Usuario();
		try{
			$row = $db->get_results( $sql );
			$usuario = new Usuario($row);
		}catch(Exception $e){
			throw new QueryException($e->getMessage(), $sql, 0, $e);
		}
		return $usuario;
	}
}
?>