<?php
class Ponencia{
	private $id;
	private $titulo;
	private $status;
	private $resumen;
	private $archivoConNombre;
	private $archivoSinNombre;
	private $observaciones;
	private $ponenteId;
	private $fecha;
	private $ejeTematico;
	private $sala;
	private $hora;
	
  	public function __construct($row = NULL){
		if( $row != NULL ){
	    		$this->id = $row->ponencia_id;
			$this->titulo = $row->ponencia_titulo;
			$this->status = $row->ponencia_estado;
			$this->resumen = $row->ponencia_resumen;
			$this->archivoConNombre = $row->ponencia_archivo1;
			$this->archivoSinNombre = $row->ponencia_archivo2;
			$this->observaciones = $row->ponencia_observaciones;
			$this->ponenteId = $row->usuario_id;
			$this->fecha = $row->ponencia_fecha;
			$this->ejeTematico = $row->ponencia_ejetematico;
			$this->sala = $row->ponencia_sala;
			$this->hora = $row->ponencia_hora;
		}
  	}
	
	public function setId($id){ $this->id = $id; }
	public function setTitulo($titulo){ $this->titulo = $titulo; }
	public function setStatus($status){ $this->status = $status; }
	public function setResumen($resumen){ $this->resumen = $resumen; }
	public function setArchivoConNombre($archivoConNombre){ $this->archivoConNombre = $archivoConNombre; }
	public function setArchivoSinNombre($archivoSinNombre){ $this->archivoSinNombre = $archivoSinNombre; }
	public function setObservaciones($observaciones){ $this->observaciones = $observaciones; }
	public function setPonente($ponente){ $this->ponenteId = $ponente->getId(); }
	public function setFecha($fecha){ $this->fecha = $fecha; }
	public function setEjeTematico($ejeTematico){ $this->ejeTematico = $ejeTematico; }
	public function setSala($sala){ $this->sala = $sala; }
	
	public function getId(){ return $this->id; }
	public function getTitulo(){ return $this->titulo; }
	public function getStatus(){ return $this->status; }
	public function getResumen(){ return $this->resumen; }
	public function getArchivoConNombre(){ return $this->archivoConNombre; }
	public function getArchivSinNombre(){ return $this->archivoSinNombre; }
	public function getObservaciones(){ return $this->observaciones; }
	public function getPonente(){ 
		$ponente = UsuarioDao::findById($this->ponenteId); 
		if( isset($ponente) ){
			return $ponente;
		}
		return new Usuario();
	}
	public function getFecha(){ return $this->fecha; }
	public function getEjeTematico(){ return $this->ejeTematico; }
	public function getSala(){ return $this->sala; }
	public function getHora(){ return $this->hora; }
}
?>