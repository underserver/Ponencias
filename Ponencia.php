<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';
require_once dirname(__FILE__).'/controller/PonenciaController.php';
require_once dirname(__FILE__).'/controller/EvaluacionController.php';

class ViewPonencia extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){

		$this->getMenu()->setSelectedItem("misponencias");

		$action = $this->getQueryParameter("action");
		if( $action == edit ){
			global $ponencia;
			$id = $this->getQueryParameter("id");
			$ponencia = PonenciaController::obtener($id);

			$this->setContent(new HtmlPage("./view/Ponente/EditPonencia.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle( $ponencia->getTitulo() );
		} else if( $action == create ){
			global $ponencia;
			$ponencia = new Ponencia();

			$this->setContent(new HtmlPage("./view/Ponente/EditPonencia.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle( "Nueva Ponencia" );
		} else if( $action == persist ){
			global $ponencia;
			$id = $this->getPostParameter("id");
			if( !empty($id) ){
				$ponencia = PonenciaController::obtener($id);
			} else {
				$ponencia = new Ponencia();
			}

			$ponencia->setTitulo($this->getPostParameter("titulo"));
			$ponencia->setFecha($this->getPostParameter("fecha"));
			$ponencia->setResumen($this->getPostParameter("resumen"));
			$ponencia->setEjeTematico($this->getPostParameter("ejetematico"));
			$ponencia->setArchivoConNombre("file1");
			$ponencia->setArchivoSinNombre("file2");

			$ponencia = PonenciaController::guardar($ponencia, $this->getUsuario());

			$this->setContent(new HtmlPage("./view/Ponente/EditPonencia.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle( $ponencia->getTitulo() );
		} else if( $action == remove){
			global $ponencias;
			$id = $this->getPostParameter("id");
			$ponencia = PonenciaController::obtener($id);

			PonenciaController::eliminar($ponencia, $this->getUsuario());

			$ponencias = PonenciaController::listar($this->getUsuario());

			$this->setHeader(NULL);
			$this->setMenu(NULL);
			$this->setFooter(NULL);
			$this->setContent(new HtmlPage("./view/Ponente/ListPonencias.php"));
		} else if( $action == removeAll){
			global $ponencias;
			$ids = $this->getPostParameter("ids");
			
			$ponenciasIds = explode(",", $ids);
			foreach( $ponenciasIds as $id ){
				$ponencia = PonenciaController::obtener($id);
				if( $ponencia->isWired() ){
					PonenciaController::eliminar($ponencia, $this->getUsuario());
				}
			}

			$ponencias = PonenciaController::listar($this->getUsuario());

			$this->setHeader(NULL);
			$this->setMenu(NULL);
			$this->setFooter(NULL);
			$this->setContent(new HtmlPage("./view/Ponente/ListPonencias.php"));
		} else {
			global $ponencia, $evaluacion;
			$id = $this->getQueryParameter("id");
			$ponencia = PonenciaController::obtener($id);
			$evaluacion = EvaluacionController::obtener($ponencia, $this->getUsuario());

			$this->setContent(new HtmlPage("./view/Ponente/ViewPonencia.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle( $ponencia->getTitulo() );
		}
	}
}
$view = new ViewPonencia();
$view->renderAll();
?>
