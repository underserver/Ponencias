<?phP
class PonenciaManager{
	public static function registrar($ponencia){
		$ponencia->setStatus(PonenciaStatus::SIN_ASIGNAR);
		PonenciaDao::persist($ponencia);
	}
	
	public static function asignarEvaluador($ponencia, $evaluador){
		$evaluacion = EvaluacionDao::findByQuery("ponencia_id=$ponencia->getId() and evaluador_id=$evaluador->getId()");
		if( isset($evaluacion) ){
			EvaluacionDao::update($evaluacion);
		} else {
			$evaluacion = new Evaluacion();
			$evaluacion->setPonencia($ponencia);
			$evaluacion->setEvaluador($evaluador);
			EvaluacionDao::save($evaluacion);
		}
		$ponencia->setStatus(PonenciaStatus::EN_EVALUACION);
		PonenciaDao::persist($ponencia);
	}
	
	public static function finalizarEvaluacion($ponencia, $status){
		$ponencia->setStatus(status);
		PonenciaDao::persist($ponencia);
	}
	
	public static function obtener($ponencia){
		return PonenciaDao::findById($ponencia);
	}
	
	public static function eliminar($ponencia){
		PonenciaDao::delete($ponencia);
	}
	
	public static function listar(){
		return PonenciaDao::findAll();
	}
	
	public static function getEvaluadores($ponencia){
		$evaluadores = array();
		$evaluaciones = EvaluacionDao::findByQuery("ponencia_id=$ponencia->getId()");
		foreach( $evaluaciones as $evaluacion ){
			$evaluadores[] = $evaluacion->getEvaluador();
		}
		return $evaluadores;
	}
	
	public static function actualizar($ponencia){
		return PonenciaDao::persist($ponencia);
	}
	
}
?>