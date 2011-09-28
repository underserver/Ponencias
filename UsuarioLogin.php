<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/utils/Message.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';

class LoginView extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){

		$this->getMenu()->setSelectedItem("inicio");
		
		$action = $this->getQueryParameter("action");
		if( $action == login ){
			$usuario = new Usuario();
			$usuario->setAlias($this->getPostParameter("userName"));
			$usuario->setPassword($this->getPostParameter("userPassword"));
			
			$usuario = UsuarioController::inciarSesion($usuario);
			if( $usuario->isWired() ){
				$this->setUsuarioActual($usuario);
				if( $usuario->getTipo() == UsuarioType::$EVALUADOR ){
					$this->redirect("EvaluarPonencias.php");
					return PageView::$REDIRECT;
				} else if( $usuario->getTipo() == UsuarioType::$PONENTE ){
					$this->redirect("MisPonencias.php");
					return PageView::$REDIRECT;
				} else if( $usuario->getTipo() == UsuarioType::$ADMINISTRADOR ){
					$this->redirect("AdminPanel.php");
					return PageView::$REDIRECT;
				}
			} else {
				$this->setContent(new HtmlPage("./view/index.php"));
				$this->getMenu()->setSelectedSubItem("inicio");
				$this->getMenu()->setTitle("Entrar al Sistema");
			}
		} else if( $action == logout ){
			$this->setUsuarioActual(new Usuario());
			$this->redirect("UsuarioLogin.php");
		} else {
			if( $this->getUsuario()->getTipo() == UsuarioType::$PUBLICO ){
				$this->setContent(new HtmlPage("./view/index.php"));
				$this->getMenu()->setSelectedSubItem("inicio");
				$this->getMenu()->setTitle("Entrar al Sistema");
			} else {
				if( $this->getUsuario()->getTipo() == UsuarioType::$EVALUADOR ){
					$this->redirect("EvaluarPonencias.php");
				} else if( $this->getUsuario()->getTipo() == UsuarioType::$PONENTE ){
					$this->redirect("MisPonencias.php");
				}
			}
		}
	}
}
$view = new LoginView();
$view->renderAll();
?>