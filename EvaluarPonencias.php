<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';
require_once dirname(__FILE__).'/services/PonenciaManager.php';

class LoginView extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){
		global $ponencias;
		
		$ponencias = PonenciaManager::listar();

		$this->getMenu()->setSelectedItem("inicio");
		$this->setContent(new HtmlPage("./view/Evaluador/ListPonencias.php"));
		$this->getMenu()->setSelectedSubItem("inicio");
		$this->getMenu()->setTitle("Evaluar Ponencias");
	}
}
$view = new LoginView();
$view->renderAll();
?>