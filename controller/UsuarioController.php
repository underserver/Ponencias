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

	public static function guardar($usuario, $usuarioActual){
		if( $usuario->getId() != $usuarioActual->getId || $usuarioActual->getTipo() == UsuarioType::$ADMINISTRADOR){
			try{
				$usuario = UsuarioManager::actualizar($usuario);
				ApplicationContext::addMessage(i18n("USER.UPDATED"), Message::$INFO);
				return $usuario;
			} catch (TransactionException $te){
				ApplicationContext::addMessage(new Message($te->i18n(), Message::$ERROR, true, $qe));
			}
		} else {
			throw new NoPermissionException("Cant save user", 0x4);
		}
		return $usuario;
	}
    
	public static function inciarSesion($usuario){
		try{
			if( UsuarioManager::alreadyRegistered($usuario->getAlias()) ){
				if( UsuarioManager::checkPassword($usuario) ){
					$usuario = UsuarioManager::getByAlias($usuario->getAlias());

					ApplicationContext::addMessage(sprintf(i18n("LOGIN.OK"), $usuario->getNombre()), Message::$INFO);
					return $usuario;
				} else {
					ApplicationContext::addMessage(i18n("LOGIN.WRONG_PASSWORD"), Message::$WARN);
				}
			} else {
				ApplicationContext::addMessage(i18n("LOGIN.NO_USER_EXIST"), Message::$WARN);
			}
		} catch(QueryException $qe) {
			ApplicationContext::addMessage(new Message($qe->i18n(), Message::$ERROR, true, $qe));
		}
		return new Usuario();
	}

	public static function obtener($usuario){
		if( $usuario->getId() != 0 ){
			return UsuarioManager::obtener($usuario->getId());
		} else {
			return UsuarioManager::getByAlias($usuario->getAlias());
		}
	}

	public static function todos($usuario){
		if( $usuario->getTipo() == UsuarioType::$ADMINISTRADOR ){
			return UsuarioManager::listar();
		} else {
			throw new NoPermissionException("Cant view all users", 0x5);
		}
	}

	public static function getByTipo($tipo){
		return UsuarioManager::getByTipo($tipo);
	}
    
	public static $REGISTER_OK		= "REGISTER.OK";
	public static $REGISTER_USER_EXIST	= "REGISTER.USER_EXIST";
}
?>