<?php
include_once dirname(__FILE__)."/../enums/PonenciaStatus.php";
include_once dirname(__FILE__)."/../_exceptions/TransactionException.php";
include_once dirname(__FILE__)."/../_exceptions/QueryException.php";
include_once dirname(__FILE__)."/../dao/EvaluacionDao.php";
include_once dirname(__FILE__)."/../services/EvaluacionManager.php";
include_once dirname(__FILE__)."/../dao/PonenciaDao.php";

class PonenciaManager{
	
	public static function asignarEvaluador($ponencia, $evaluador){
		try{
			$evaluacion = EvaluacionManager::getByPonenciaAndEvaluador($ponencia, $evaluador);
			if( isset($evaluacion) ){
				EvaluacionDao::update($evaluacion);
			} else {
				$evaluacion = new Evaluacion();
				$evaluacion->setPonencia($ponencia);
				$evaluacion->setEvaluador($evaluador);
				EvaluacionDao::save($evaluacion);
			}
			$ponencia->setStatus(PonenciaStatus::$EN_EVALUACION);
			//PonenciaDao::persist($ponencia);
		}catch(QueryException $qe){
    			throw $qe;
    		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function evaluar($ponencia, $evaluador, $_evaluacion){
		try{
			$evaluacion = EvaluacionDao::findByQuery("ponencia_id=$ponencia->getId() and evaluador_id=$evaluador->getId()");
			$evaluacion->setDictamen($_evaluacion->getDictamen());
			$evaluacion->setObservaciones($_evaluacion->getObservaciones());
			$evaluacion->setCalificacion($_evaluacion->getCalificacion());
			$evaluacion->setFecha();
			EvaluacionDao::persist($evaluacion);
		}catch(QueryException $qe){
    			throw $qe;
    		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function finalizarEvaluacion($ponencia, $aprobada = false){
		try{
			if( $aporobada ){
				$ponencia->setStatus(PonenciaStatus::APROBADA);
			}else{
				$ponencia->setStatus(PonenciaStatus::RECHAZADA);
			}
			EvaluacionDao::persist($evaluacion);
			PonenciaDao::persist($ponencia);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function obtener($ponencia){
		try{
			return PonenciaDao::findById($ponencia->getId());
		}catch(QueryException $qe){
    			throw $qe;
    		}
	}
	
	public static function eliminar($ponencia){
		try{
			PonenciaDao::delete($ponencia);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
	public static function getByPonente($id){
		try{
			return PonenciaDao::findByQuery("usuario_id=$id");
		}catch(QueryException $qe){
    			throw $qe;
    		}
	}
	
	public static function getByEvaluador($id){
		try{
			return PonenciaDao::findByQuery("ponencia_id in (select ponencia_id from evaluaciones where evaluador_id=$id)");
		}catch(QueryException $qe){
    			throw $qe;
    		}
	}

	public static function getByCoautor($id){
		try{
			return PonenciaDao::findByQuery("ponencia_id in (select ponencia_id from ponencias_coautores where coautor_id=$id)");
		}catch(QueryException $qe){
    			throw $qe;
    		}
	}

	public static function getByStatus($status){
		try{
			return PonenciaDao::findByQuery("ponencia_estado=$status");
		}catch(QueryException $qe){
    			throw $qe;
    		}
	}

	public static function listar(){
		try{
			return PonenciaDao::findAll();
		}catch(QueryException $qe){
    			throw $qe;
    		}
	}
	
	public static function getEvaluadores($ponencia){
		$evaluadores = array();
		try{
			$evaluaciones = EvaluacionDao::findByQuery("ponencia_id=$ponencia->getId()");
			foreach( $evaluaciones as $evaluacion ){
				$evaluadores[] = $evaluacion->getEvaluador();
			}
		}catch(QueryException $qe){
    			throw $qe;
    		}
		return $evaluadores;
	}
	
	public static function guardar($ponencia){
		try{
			return PonenciaDao::persist($ponencia);
		}catch(TransactionException $te){
			throw $te;
		}
	}
	
}
?>