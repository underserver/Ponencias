<?php
class UsuarioManager{
	public static function registrarAdministrador($usuario){
		$usuario->setTipo(UsuarioType::ADMINISTRADOR);
		UsuarioDao::persist($usuario);
	}
	
	public static function registrarPonente($usuario){
		$usuario->setTipo(UsuarioType::PONENTE);
		UsuarioDao::persist($usuario);
	}
	
	public static function registrarCoautor($usuario){
		$usuario->setTipo(UsuarioType::COAUTOR);
		UsuarioDao::persist($usuario);
	}
	
	public static function registrarEvaluador($usuario){
		$usuario->setTipo(UsuarioType::EVALUADOR);
		UsuarioDao::persist($usuario);
	}
	
	public static function registrarAsistente($usuario){
		$usuario->setTipo(UsuarioType::ASISTENTE);
		UsuarioDao::persist($usuario);
	}
	
	public static function obtener($id){
		return UsuarioDao::findById($id);
	}
	
	public static function eliminar($usuario){
		UsuarioDao::delete($usuario);
	}
	
	public static function listar(){
		return UsuarioDao::findAll();
	}
	
	public static function actualizar($usuario){
		return UsuarioDao::persist($usuario);
	}
	
	public static function alreadyRegistered($alias){
		$usuario = UsuarioDao::findByQuery("usuario_alias='$alias'");
		if( iiset($usuario->getId()) ){
			return true;
		}
		return false;
	}
	
	public static function checkPassword($_usuario){
		$usuario = UsuarioDao::findByQuery("usuario_alias='$alias'");
		if( $usuario->getPassword() == $_usuario->getPassword() ){
			return true;
		}
		return false;
	}
}
?>