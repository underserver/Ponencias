<?php
include_once dirname(__FILE__)."/../enums/UsuarioType.php";
include_once dirname(__FILE__)."/../_exceptions/NoPermissionException.php";
include_once dirname(__FILE__)."/../services/UsuarioManager.php";
include_once dirname(__FILE__)."/../dao/UsuarioDao.php";

class UsuarioController{
    
	public static function registrar($usuario){
		try{
			$usuarioActual = usuarioActual();
			if( UsuarioManager::alreadyRegistered($usuario) ){
				return $REGISTER_USER_EXIST;
			} else {
				switch( $usuario->getTipo() ){
					case UsuarioType::PONENTE:
						UsuarioManager::registrarPonente($usuario);
						return $REGISTER_OK;
					case UsuarioType::COAUTOR:
						UsuarioManager::registrarCoautor($usuario);
						return $REGISTER_OK;
						case UsuarioType::EVALUADOR:
						UsuarioManager::registrarEvaluador($usuario);
						return $REGISTER_OK;
					case UsuarioType::ASISTENTE:
						UsuarioManager::registrarAsistente($usuario);
						return $REGISTER_OK;
					case UsuarioType::ADMINISTRADOR:
						if( $usuarioActual->getTipo() == UsuarioType::ADMINISTRADOR ){
							UsuarioManager::registrarAdministrador($usuario);
							return $REGISTER_OK;
						}else{
							throw new NoPermissionException("Register Admin User");
						}
						break;
				}
			}
		}catch(TransactionException $te){
			throw $te;
		}
	}
    
	public static function inciarSesion($usuario){
		try{
			if( UsuarioManager::alreadyRegistered($usuario->getAlias()) ){
				if( UsuarioManager::checkPassword($usuario) ){
					$alias = $usuario->getAlias();
					$usuarios = UsuarioDao::findByQuery("usuario_alias='$alias'");
					$_SESSION["usuario_id"] = $usuarios[0]->getId();
					return UsuarioController::$LOGIN_OK;
				} else {
					return UsuarioController::$LOGIN_WRONG_PASSWORD;
				}
			} else {
				return UsuarioController::$LOGIN_NO_USER_EXIST;
			}
		}catch(QueryException $qe){
			throw $qe;
		}
	}

	public static function obtener($usuario){
		if( $usuario->getId() != 0 ){
			return UsuarioManager::obtener($usuario->getId());
		} else {
			return UsuarioManager::getByAlias($usuario->getAlias());
		}
	}
    
	public static function validar($usuario){
		
	}
    
	public static $REGISTER_OK		= "REGISTER.OK";
	public static $REGISTER_USER_EXIST	= "REGISTER.USER_EXIST";

	public static $LOGIN_OK		= "LOGIN.OK";
	public static $LOGIN_NO_USER_EXIST	= "LOGIN.NO_USER_EXIST";
	public static $LOGIN_WRONG_PASSWORD	= "LOGIN.WRONG_PASSWORD";
}
?>