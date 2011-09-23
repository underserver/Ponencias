<?php
include_once dirname(__FILE__)."/../enums/UsuarioType.php";
include_once dirname(__FILE__)."/../enums/PonenciaStatus.php";
include_once dirname(__FILE__)."/../_exceptions/NoPermissionException.php";
include_once dirname(__FILE__)."/../controller/FileUploadController.php";
include_once dirname(__FILE__)."/../services/PonenciaManager.php";
include_once dirname(__FILE__)."/../dao/PonenciaDao.php";

class PonenciaController{

	public static function listar($usuario){
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
		} catch(FileUploadException $ex) {
			throw $ex;
		}
		return PonenciaManager::guardar($ponencia);
	}

	public static function obtener($id){
		$ponencia = new Ponencia();
		$ponencia->setId($id);
		return PonenciaManager::obtener($ponencia);
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
	}
}
?>