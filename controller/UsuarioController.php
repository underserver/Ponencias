<?php
class UsuarioController{
    private $session = $_SESSION;
    
    public static function registrar($usuario){
    	 try{
	        $usuarioActual = usuarioActual();
	        switch( $usuario->getTipo() ){
	            case UsuarioType::PONENTE:
	                UsuarioManager::registrarPonente($usuario);
	                break;
	            case UsuarioType::COAUTOR:
	                UsuarioManager::registrarCoautor($usuario);
	                break;
	            case UsuarioType::EVALUADOR:
	                UsuarioManager::registrarEvaluador($usuario);
	                break;
	            case UsuarioType::ASISTENTE:
	                UsuarioManager::registrarAsistente($usuario);
	                break;
	            case UsuarioType::ADMINISTRADOR:
	                if( $usuarioActual->getTipo() == UsuarioType::ADMINISTRADOR ){
	                    UsuarioManager::registrarAdministrador($usuario);
	                }else{
					     throw new NoPermissionException("Register Admin User");
	                }
	                break;
           }catch(TransactionException $te){
				throw $te;
			}
        }
    }
    
    public static function inciarSesion($usuario){
    	if( UsuarioManager::alreadyRegistered($usuario) ){
    		if( UsuarioManager::checkPassword($usuario) ){
    			$session["usuario_id"] = $
    		}
    	} else {
    		throw new Exception(i18n("LOGIN.0x1"));
    	}
    }
    
    public static function usuarioActual(){
    	if( isset($session["usuario_id"]) ){
    		return UsuarioManager::obtener($session["usuario_id"]);
       }
       return new Usuario();
    }
}
?>