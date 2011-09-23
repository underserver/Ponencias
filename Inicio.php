<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/utils/Message.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';

class Inicio extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){
		if( $this->getUsuario()->getTipo() == UsuarioType::$PUBLICO ){
			$this->redirect("UsuarioLogin.php");
		} else {
			if( $this->getUsuario()->getTipo() == UsuarioType::$EVALUADOR ){
				$this->redirect("EvaluarPonencias.php");
			} else if( $this->getUsuario()->getTipo() == UsuarioType::$PONENTE ){
				$this->redirect("MisPonencias.php");
			}
		}
	}
}
$view = new Inicio();
$view->renderAll();
?>