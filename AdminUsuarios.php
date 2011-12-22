<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';
require_once dirname(__FILE__).'/controller/PonenciaController.php';
require_once dirname(__FILE__).'/controller/EvaluacionController.php';

class AdminUsuarios extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){

		$this->getMenu()->setSelectedItem("adminpanel");

		$action = $this->getQueryParameter("action");
		if( $action == edit ){
			global $ponencia;
			$id = $this->getQueryParameter("id");
			$ponencia = PonenciaController::obtener($id);

			$this->setContent(new HtmlPage("./view/Ponente/EditPonencia.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle( $ponencia->getTitulo() );
		} else {
			global $usuarios;
			$type = $this->getQueryParameter("type");
			if( empty($type) ){
				$usuarios = UsuarioController::todos($this->getUsuario());
			} else {
				$usuarios = UsuarioController::getByTipo($type);
			}

			$this->setContent(new HtmlPage("./view/Administrador/ListUsuarios.php"));
			$this->getMenu()->setSelectedSubItem("users");
			$this->getMenu()->setTitle( "Administrar usuarios" );
		}
	}
}
$view = new AdminUsuarios();
$view->renderAll();test
?>
