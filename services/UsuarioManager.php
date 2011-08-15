<?php
class UsuarioManager{
	public static function registrarAdministrador($usuario){
		try{
			$usuario->setTipo(UsuarioType::ADMINISTRADOR);
			UsuarioDao::persist($usuario);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function registrarPonente($usuario){
		try{
			$usuario->setTipo(UsuarioType::PONENTE);
			UsuarioDao::persist($usuario);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function registrarCoautor($usuario){
		try{
			$usuario->setTipo(UsuarioType::COAUTOR);
			UsuarioDao::persist($usuario);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function registrarEvaluador($usuario){
		try{
			$usuario->setTipo(UsuarioType::EVALUADOR);
			UsuarioDao::persist($usuario);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function registrarAsistente($usuario){
		try{
			$usuario->setTipo(UsuarioType::ASISTENTE);
			UsuarioDao::persist($usuario);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function obtener($id){
		try{
			return UsuarioDao::findById($id);
		}catch(QueryException $qe){
    		throw $qe;
    	}
	}
	
	public static function eliminar($usuario){
		try{
			UsuarioDao::delete($usuario);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function listar(){
		try{
			return UsuarioDao::findAll();
		}catch(QueryException $qe){
    		throw $qe;
    	}
	}
	
	public static function actualizar($usuario){
		try{
			return UsuarioDao::persist($usuario);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function alreadyRegistered($alias){
		try{
			$usuarios = UsuarioDao::findByQuery("usuario_alias='$alias'");
			if( count($usuarios) > 0 ){
				return true;
			}
		}catch(QueryException $qe){
    		return true;
    	}
		return false;
	}
	
	public static function checkPassword($_usuario){
		try{
			$usuario = UsuarioDao::findByQuery("usuario_alias='$_usuario->getAlias()'");
			if( $usuario->getPassword() == $_usuario->getPassword() ){
				return true;
			}
		}catch(QueryException $qe){
    		return false;
    	}
    	return false;
	}
}
?>