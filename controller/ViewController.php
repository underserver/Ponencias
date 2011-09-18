<?php
require_once dirname(__FILE__)."/../model/Usuario.php";

abstract class ViewController{
	private $usuario;
	public function __construct(){
		if( isset($_SESSION["uid"]) ){
			try{
				$this->usuario = UsuarioManager::obtener($_SESSION["uid"]); 
			}catch(QueryException $qe){
				$this->usuario = new Usuario();
			}
		}
	}
	
	public function getUsuario(){ return $this->usuario; }
	public function getQueryParameter($param){ return $_GET[$param]; }
	public function getPostParameter($param){ return $_POST[$param]; }
	public function redirect($view){ header("Location: ./" . $view); }
	
	public function setUsuarioActual($usuarioActual){ 
		$_SESSION["uid"] = $usuarioActual->getId();
		$this->usuarioActual = $usuarioActual; 
	}
}
?>