<?php
include_once "../services/UsuarioManager.php";

class UsuarioController{

    private $session = $_SESSION;
    
    public static function registrar($usuario){
    	 try{
	        $usuarioActual = usuarioActual();
	        if( UsuarioManager::alreadyRegistered($usuario) ){
	        	return 0x1;
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
	    	if( UsuarioManager::alreadyRegistered($usuario) ){
	    		if( UsuarioManager::checkPassword($usuario) ){
	    			$session["usuario_id"] = $usuarios = UsuarioDao::findByQuery("usuario_alias='$usuario->getAlias()'")[0]->getId();
	    			return $LOGIN_OK;
	    		} else {
	    			return $LOGIN_WRONG_PASSWORD;
	    		}
	    	} else {
	    		return $LOGIN_NO_USER_EXIST;
	    	}
    	}catch(QueryException $qe){
    		throw $qe;
    	}
    }
    
    public static function usuarioActual(){
    	try{
    		if( isset($session["usuario_id"]) ){
    			return UsuarioManager::obtener($session["usuario_id"]);
       		}
       }catch(QueryException $qe){
       		throw $qe;
       }
       return new Usuario();
    }
    
    public static function validar($usuario){
    	
    }
    
    private static $REGISTER_OK 				= "REGISTER.OK";
    private static $REGISTER_USER_EXIST 	= "REGISTER.USER_EXIST";
    
    private static $LOGIN_OK 				= "LOGIN.OK";
    private static $LOGIN_NO_USER_EXIST		= "LOGIN.NO_USER_EXIST";
    private static $LOGIN_WRONG_PASSWORD 	= "LOGIN.WRONG_PASSWORD";
}
?>