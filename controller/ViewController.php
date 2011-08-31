<?php
require_once dirname(__FILE__)."/../model/Usuario.php";

abstract class ViewController{
	private $usuarioActual;
	private $vistaActual;
	
	public function __construct(){
		$this->usuarioActual = new Usuario();
		$this->usuarioActual->setTipo(UsuarioType::$PUBLICO);
		
		if( isset($_SESSION["usuario_id"]) ){
			try{
				$this->usuarioActual = UsuarioManager::obtener($_SESSION["usuario_id"]); 
			}catch(QueryException $qe){
			}
		}
	}
	
	public function getUsuarioActual(){ return $this->usuarioActual; }
	public function getVistaActual(){ return $this->vistaActual; }
	
	public function setUsuarioActual($usuarioActual){ $this->usuarioActual = $usuarioActual; }
	public function setVistaActual($vistaActual){ $this->vistaActual = $vistaActual; }
}
?>