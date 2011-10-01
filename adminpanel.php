<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';
require_once dirname(__FILE__).'/controller/PonenciaController.php';
require_once dirname(__FILE__).'/controller/EvaluacionController.php';

class AdminPanel extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){

		$this->getMenu()->setSelectedItem("adminpanel");

		$this->setContent(new HtmlPage("./view/Administrador/Panel.php"));
		$this->getMenu()->setSelectedSubItem("inicio");
		$this->getMenu()->setTitle( "Panel de Administracion" );
	}
}
$view = new AdminPanel();
$view->renderAll();
?>
