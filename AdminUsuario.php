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

		$this->getMenu()->setSelectedItem("adminpanel");

		$action = $this->getQueryParameter("action");
		if( $action == persist ){
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
			
			$newPassword = $this->getPostParameter("user_password"); 
			if( !empty($newPassword) ){
				$usuario->setPassword($newPassword);
			}

			$usuario = UsuarioController::guardar($usuario, $this->getUsuario());

			$this->setContent(new HtmlPage("./view/Administrador/EditUsuario.php"));
			$this->getMenu()->setSelectedSubItem("users");
			$this->getMenu()->setTitle( 'Editar Usuario: ' . $usuario->getAlias() );
		} else {
			global $usuario;
			$id = $this->getQueryParameter("id");
			$usuario = new Usuario();
			$usuario->setId($id);
			$usuario = UsuarioController::obtener($usuario);

			$this->setContent(new HtmlPage("./view/Administrador/EditUsuario.php"));
			$this->getMenu()->setSelectedSubItem("users");
			$this->getMenu()->setTitle( 'Editar Usuario: ' . $usuario->getAlias() );
		}
	}
}
$view = new ViewUsuario();
$view->renderAll();
?>
