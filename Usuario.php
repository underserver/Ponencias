<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';
require_once dirname(__FILE__).'/controller/PonenciaController.php';
require_once dirname(__FILE__).'/controller/EvaluacionController.php';

class ViewUsuario extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){

		$this->getMenu()->setSelectedItem("cuenta");

		$action = $this->getQueryParameter("action");
		if( $action == edit ){
			global $ponencia;
			$id = $this->getQueryParameter("id");
			$ponencia = PonenciaController::obtener($id);

			$this->setContent(new HtmlPage("./view/Ponente/EditPonencia.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle( $ponencia->getTitulo() );
		} else if( $action == register ){
			global $ponencia;
			$ponencia = new Ponencia();

			$this->setContent(new HtmlPage("./view/Ponente/EditPonencia.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle( "Nueva Ponencia" );
		} else if( $action == persist ){
			global $usuario;
			$id = $this->getPostParameter("id");
			$usuario = new Usuario();
			$usuario->setId($id);
			if( !empty($id) ){
				$usuario = UsuarioController::obtener($usuario);
			} else {
				throw new QueryException("User not found", 0x5);
			}

			$usuario->setNombre($this->getPostParameter("user_name"));
			$usuario->setApellidos($this->getPostParameter("user_lastname"));
			$usuario->setFechaNacimiento($this->getPostParameter("user_born"));
			$usuario->setDireccion($this->getPostParameter("user_address"));
			$usuario->setTelefono($this->getPostParameter("user_phone"));
			$usuario->setCorreo($this->getPostParameter("user_mail"));

			$usuario = UsuarioController::guardar($usuario, $this->getUsuario());

			$this->setContent(new HtmlPage("./view/Usuario/PersonalInfo.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle( $usuario->getAlias() );
		} else if( $action == account ){
			global $usuario;
			$usuario = $this->getUsuario();

			$this->setContent(new HtmlPage("./view/Usuario/AccountInfo.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle( "Informacion de la Cuenta" );
		} else if( $action == personal ){
			global $usuario;
			$usuario = $this->getUsuario();

			$this->setContent(new HtmlPage("./view/Usuario/PersonalInfo.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle( "Informacion Personal" );
		}
	}
}
$view = new ViewUsuario();
$view->renderAll();
?>
