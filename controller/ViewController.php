<?php
require_once dirname(__FILE__)."/../model/Usuario.php";

abstract class ViewController{
	private $usuario;
	
	public function __construct(){
		$this->usuario = new Usuario();
		$this->usuario->setTipo(UsuarioType::$PUBLICO);
		
		if( isset($_SESSION["usuario_id"]) ){
			try{
				$this->usuario = UsuarioManager::obtener($_SESSION["usuario_id"]); 
			}catch(QueryException $qe){
				$this->usuario = new Usuario();
			}
		}
	}
	
	public function getUsuario(){ return $this->usuario; }
	public function getQueryParameter($param){ return $_GET[$param]; }
	public function getPostParameter($param){ return $_POST[$param]; }
	
	public function setUsuarioActual($usuarioActual){ $this->usuarioActual = $usuarioActual; }
}
?>