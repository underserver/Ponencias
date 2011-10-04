<?php
include_once dirname(__FILE__)."/../enums/UsuarioType.php";
include_once dirname(__FILE__)."/../enums/PonenciaStatus.php";
include_once dirname(__FILE__)."/../_exceptions/NoPermissionException.php";
include_once dirname(__FILE__)."/../controller/FileUploadController.php";
include_once dirname(__FILE__)."/../services/PonenciaManager.php";
include_once dirname(__FILE__)."/../dao/PonenciaDao.php";

class PonenciaController{

	public static function listar($usuario){
		try{
			switch( $usuario->getTipo() ){
				case UsuarioType::$PONENTE:
					return PonenciaManager::getByPonente($usuario->getId());
					break;
				case UsuarioType::$EVALUADOR:
					return PonenciaManager::getByEvaluador($usuario->getId());
					break;
				case UsuarioType::$COAUTOR:
					return PonenciaManager::getByCoautor($usuario->getId());
					break;
				case UsuarioType::$PUBLICO:
					return PonenciaManager::getByStatus(PonenciaStatus::$ACEPTADA);
					break;
			}
		} catch(QueryException $qe) {
			ApplicationContext::addMessage(new Message($qe->i18n(), Message::$ERROR, true, $qe));
		}
	}

	public static function getByStatus($status){
		try{
			if( empty($staus) ){
				return PonenciaManager::listar();
			} else {
				return PonenciaManager::getByStatus($status);
			}
		} catch(QueryException $qe) {
			ApplicationContext::addMessage(new Message($qe->i18n(), Message::$ERROR, true, $qe));
		}
	}

	public static function guardar($ponencia, $usuario){
		if( $usuario->getTipo() != UsuarioType::$ADMINISTRADOR ){
			$ponencia->setPonente($usuario);
		}
		try{
			$archivoConNombre = FileUploadController::upload($ponencia->getArchivoConNombre(), $ponencia->getPonente());
			$archivoSinNombre = FileUploadController::upload($ponencia->getArchivoSinNombre(), $ponencia->getPonente());
			$ponencia->setArchivoConNombre($archivoConNombre);
			$ponencia->setArchivoSinNombre($archivoSinNombre);
			return PonenciaManager::guardar($ponencia);
		} catch(FileUploadException $ex) {
			ApplicationContext::addMessage(new Message($ex->i18n(), Message::$ERROR, true, $qe));
		}
		return $ponencia;
	}

	public static function obtener($id){
		try{
			$ponencia = new Ponencia();
			$ponencia->setId($id);
			return PonenciaManager::obtener($ponencia);
		} catch( QueryException $qe ){
			throw $qe;
		}
	}

	public static function eliminar($ponencia, $usuario){
		try{
			if( $ponencia->getPonente()->getId() == $usuario->getId() || $usuario->getTipo() == UsuarioType::$ADMINISTRADOR ){
				return PonenciaManager::eliminar($ponencia);
			} else {
				throw  new NoPermissionException("Delete ponencia", 0x3);
			}
		} catch (TransactionException $te){
			throw $te;
		}
		return false;
	}

	public static function asignarEvaluadores($ponencia, $evaluadores){
		foreach( $evaluadores as $evaluador ){
			PonenciaManager::asignarEvaluador($ponencia, $evaluador);
		}
		ApplicationContext::addMessage("Se han asignado correctamente los evaluadores a la ponencia ".$ponencia->getTitulo(), Message::$INFO);
	}
}
?>