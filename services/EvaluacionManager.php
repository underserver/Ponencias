<?php
include_once dirname(__FILE__)."/../enums/UsuarioType.php";
include_once dirname(__FILE__)."/../_exceptions/TransactionException.php";
include_once dirname(__FILE__)."/../_exceptions/QueryException.php";
include_once dirname(__FILE__)."/../dao/EvaluacionDao.php";

class EvaluacionManager{
	
	public static function getByPonenciaAndEvaluador($ponencia, $evaluador){
		try{
			$pid = $ponencia->getId();
			$eid = $evaluador->getId();
			$evaluaciones = EvaluacionDao::findByQuery("ponencia_id=1 and evaluador_id=$eid");
			if( count($evaluaciones) > 0 ){
				return $evaluaciones[0];
			} else
				return NULL;
		}catch(QueryException $qe){
    			throw $qe;
    		}
	}

	public static function getByPonencia($ponencia){
		try{
			$id = $ponencia->getId();
			$evaluaciones = EvaluacionDao::findByQuery("ponencia_id=$id");
			if( count($evaluaciones) > 0 ){
				return $evaluaciones;
			} else
				return NULL;
		}catch(QueryException $qe){
    			throw $qe;
    		}
	}

	public static function obtener($id){
		try{
			return EvaluacionDao::findById($id);
		}catch(QueryException $qe){
    			throw $qe;
    		}
	}
	
	public static function eliminar($evaluacion){
		try{
			EvaluacionDao::delete($evaluacion);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function actualizar($evaluacion){
		try{
			return EvaluacionDao::persist($evaluacion);
		}catch(TransactionException $te){
			throw $te;
		}
	}
}
?>