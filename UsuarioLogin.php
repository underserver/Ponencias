<?php
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./view/PageView.php";
include_once "./services/UsuarioManager.php";

class LoginView extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){
		global $usuarios;
		
		$usuarios=UsuarioManager::listar();
		$this->setContent(new HtmlPage("./view/login.php"));
	}
}

$view = new LoginView();
$view->renderAll();
?>