<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';

class LoginView extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){
		global $usuarios;
		
		//$usuarios=UsuarioManager::listar();

		$this->getMenu()->setSelectedItem("inicio");
		
		$action = $this->getQueryParameter("action");
		if( $action == login ){
			$usuario = new Usuario();
			$usuario->setAlias($this->getPostParameter("userName"));
			$usuario->setPassword($this->getPostParameter("userPassword"));
			if( UsuarioController::inciarSesion($usuario) == UsuarioController::$LOGIN_OK ){
				$this->redirect("Index.php");
			}
		} else {
			$this->setContent(new HtmlPage("./view/index.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle("Entrar al Sistema");
		}
	}
}
$view = new LoginView();
$view->renderAll();
?>