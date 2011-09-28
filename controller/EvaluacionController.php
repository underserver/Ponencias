<?php
include_once dirname(__FILE__)."/../enums/UsuarioType.php";
include_once dirname(__FILE__)."/../enums/PonenciaStatus.php";
include_once dirname(__FILE__)."/../_exceptions/NoPermissionException.php";
include_once dirname(__FILE__)."/../services/EvaluacionManager.php";
include_once dirname(__FILE__)."/../dao/EvaluacionDao.php";

class EvaluacionController{
	public static function obtener($ponencia, $usuario){
		$evaluacion = EvaluacionManager::getByPonenciaAndEvaluador($ponencia, $usuario);
		if( $evaluacion == NULL ){
			$evaluacion = new Evaluacion();
		}
		return $evaluacion;
	}

	public static function todas($ponencia, $usuario){
		$evaluaciones = EvaluacionManager::getByPonencia($ponencia);
		if( $evaluaciones == NULL ){
			$evaluaciones = array();
		} else {
			if( $ponencia->getPonente()->getId() != $usuario->getId() && $usuario->getTipo() != UsuarioType::$ADMINISTRADOR){
				$evaluaciones = array();
			}
		}
		return $evaluaciones;
	}
}

?>