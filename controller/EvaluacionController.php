<?php
include_once dirname(__FILE__)."/../enums/UsuarioType.php";
include_once dirname(__FILE__)."/../enums/PonenciaStatus.php";
include_once dirname(__FILE__)."/../_exceptions/NoPermissionException.php";
include_once dirname(__FILE__)."/../services/EvaluacionManager.php";
include_once dirname(__FILE__)."/../dao/EvaluacionDao.php";

class EvaluacionController{
	public static function obtener($ponencia, $usuario){
		$evaluacion = EvaluacionManager::getByPonencia($ponencia);
		if( $evaluacion == NULL ){
			$evaluacion = new Evaluacion();
		} else {
			if( $evaluacion->getEvaluador()->getId() != $usuario->getId() ){
				throw new NoPermissionException("No tiene permisos para evaluar la ponencia");
			}
		}
		return $evaluacion;
	}
}

?>