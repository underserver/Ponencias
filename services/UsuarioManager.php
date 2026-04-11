<?php
class UsuarioManager{
	public static function registrarAdministrador($usuario){
		try{
			$usuario->setTipo(UsuarioType::ADMINISTRADOR);
			UsuarioDao::persist($usuario, $GLOBALS['db']);
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
			return UsuarioDao::findById($id, $GLOBALS['db']);
		}catch(QueryException $qe){
    		throw $qe;
    	}
	}
	
	public static function eliminar($usuario){
		try{
			UsuarioDao::delete($usuario, $GLOBALS['db']);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function listar(){
		try{
			return UsuarioDao::findAll($GLOBALS['db']);
		}catch(QueryException $qe){
    		throw $qe;
    	}
	}
	
	public static function actualizar($usuario){
		try{
			return UsuarioDao::persist($usuario, $GLOBALS['db']);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function alreadyRegistered($alias){
		try{
			$usuarios = UsuarioDao::findByQuery("usuario_alias='".$GLOBALS['db']->escape($alias)."'", $GLOBALS['db']);
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
			$usuario = UsuarioDao::findByQuery("usuario_alias='".$GLOBALS['db']->escape($_usuario->getAlias())."'", $GLOBALS['db']);
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