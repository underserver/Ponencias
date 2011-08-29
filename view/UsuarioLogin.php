<?php
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./view/PageView.php";

class LoginView extends PageView{
	
	public function __construct(){
		$parent::__construct();
	}
	
	public function handleRequest(){
		$this->setContent("login");
	}
}

$view = new LoginView();
$view->renderAll();
?>