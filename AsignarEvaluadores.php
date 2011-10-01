<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';
require_once dirname(__FILE__).'/controller/PonenciaController.php';
require_once dirname(__FILE__).'/controller/EvaluacionController.php';

class AsignarEvaluadores extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){

		$this->getMenu()->setSelectedItem("adminpanel");

		$action = $this->getQueryParameter("action");
		if( $action == save ){
			$pid = $this->getPostParameter("pid");
			$eids = $this->getPostParameter("evaluadores");

			$ponencia = PonenciaController::obtener($pid);
			$evaluadores = array();
			foreach( $eids as $eid  ){
				$evaluador = new Usuario();
				$evaluador->setId($eid);
				$evaluadores[] = UsuarioController::obtener($evaluador);
			}
			PonenciaController::asignarEvaluadores($ponencia, $evaluadores);
		}
			
		global $ponencia, $evaluaciones, $evaluadores;
		$id = $this->getQueryParameter("id");
		$ponencia = PonenciaController::obtener($id);
		$evaluaciones = EvaluacionController::todas($ponencia, $this->getUsuario());
		$evaluadores = UsuarioController::getByTipo(UsuarioType::$EVALUADOR);

		$this->setContent(new HtmlPage("./view/Administrador/AsignarEvaluadores.php"));
		$this->getMenu()->setSelectedSubItem("inicio");
		$this->getMenu()->setTitle( $ponencia->getTitulo() );
		
	}
}
$view = new AsignarEvaluadores();
$view->renderAll();
?>