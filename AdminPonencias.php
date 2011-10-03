<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';
require_once dirname(__FILE__).'/controller/PonenciaController.php';
require_once dirname(__FILE__).'/controller/EvaluacionController.php';

class MisPonencias extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){

		$this->getMenu()->setSelectedItem("adminpanel");

		$action = $this->getQueryParameter("action");
		if( $action == view ){
			global $ponencia;
			$id = $this->getQueryParameter("id");
			$ponencia = PonenciaController::obtener($id);

			$this->setContent(new HtmlPage("./view/Evaluador/ViewPonencia.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle( $ponencia->getTitulo() );
		} else {
			global $ponencias;
			$status = $this->getQueryParameter("status");
			$ponencias = PonenciaController::getByStatus($status);

			$this->setContent(new HtmlPage("./view/Administrador/ListPonencias.php"));
			$this->getMenu()->setSelectedSubItem("ponencias");
			$this->getMenu()->setTitle("Administrar Ponencias");
		}
	}
}
$view = new MisPonencias();
$view->renderAll();
?>