<?php
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./controller/ViewController.php";
//include_once "./controller/UsuarioController.php";

class LoginView extends ViewController{
	
	public function handleRequest(){
		$this->render("login");
	}
}

new LoginView();
?>