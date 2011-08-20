<?php
class Evaluacion{
	private $id;
	private $calificacion;
	private $observaciones;
	private $dictamen;
	private $fecha;
	private $ponencia_id;
	private $evaluador_id;
	
	public function __construct(){}
	
  	public function __construct($row){
  		$this->id = $row["evaluacion_id"];
  		$this->calificacion = $row["evaluacion_calificacion"];
  		$this->observaciones = $row["evaluacion_observaciones"];
  		$this->dictamen = $row["evaluacion_dictamen"];
  		$this->fecha = $row["evaluacion_fecha"];
  		$this->ponencia_id = $row["ponencia_id"];
  		$this->evaluador_id = $row["evaluador_id"];
  	}
  	
  	public function setId($id){ $this->id = $id; }
  	public function setCalificacion($calificacion){ $this->calificacion = $calificacion; }
  	public function setObservaciones($observaciones){ $this->observaciones = $observaciones; }
  	public function setDictamen($dictamen){ $this->dictamen = $dictamen; }
  	public function setFecha($fecha){ $this->fecha = $fecha; }
  	public function setPonencia($ponencia){ $this->ponencia_id = $ponencia->getId(); }
  	public function setEvaluador($evaluador){ $this->evaluador_id = $evaluador->getId(); }
  	
  	public function getId(){ return $id; }
  	public function getCalificacion(){ return $calificacion; }
  	public function getObservaciones(){ return $observaciones; }
  	public function getDictamen(){ return $dictamen; }
  	public function getFecha(){ return $fecha; }
  	public function getPonencia(){ 
  		$ponencia = PonenciaDao::findById($ponencia_id); 
  		if( isset($ponencia) ){
  			return $ponencia;
  		}
  		return new Ponencia();
  	}
  	public function getEvaluador(){ 
  		$evaluador = UsuarioDao::findById($evaluador_id); 
  		if( isset($evaluador) ){
  			return $evaluador;
  		}
  		return new Usuario();
  	}
}
?>