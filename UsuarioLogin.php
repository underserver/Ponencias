<?php
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./controller/ViewController.php";
include_once "./controller/UsuarioController.php";
include_once "./pages/PageView.php";

class LoginView extends ViewController{
	
	public function handleRequest(){
		$usuario = UsuarioController::usuarioActual();
		$pageView = new PageView("inicio", $usuario);
		$pageView->setContent("login");
		$this->render($pageView);
	}
}

new LoginView();
?>