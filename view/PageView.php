<?php
require_once dirname(__FILE__).'/../utils/Menu.php';
require_once dirname(__FILE__).'/../utils/MenuItem.php';
require_once dirname(__FILE__).'/../utils/Submenu.php';
require_once dirname(__FILE__).'/../utils/SubmenuItem.php';
require_once dirname(__FILE__).'/../utils/HtmlPage.php';
require_once dirname(__FILE__).'/../utils/Message.php';
require_once dirname(__FILE__).'/../_exceptions/ViewException.php';
require_once dirname(__FILE__).'/../controller/ViewController.php';
require_once dirname(__FILE__).'/../context/Applicationcontext.php';

abstract class PageView extends ViewController{
	private $header;
	private $menu;
	private $submenu;
	private $messages;
	private $content;
	private $footer;
	
	public function __construct(){
		parent::__construct();
		
		$this->header 	 = new HtmlPage(dirname(__FILE__)."/../includes/header.inc");
		$this->footer 	 = new HtmlPage(dirname(__FILE__)."/../includes/footer.inc");
		
		$subInicio = array();
		$subInicio[] = new SubmenuItem("inicio", 		".", 					UsuarioType::$TODOS);
			
		$menuitems = array();
		$menuitems[] = new MenuItem("inicio", 			".", 					UsuarioType::$TODOS, new Submenu($subInicio, ""));
		$menuitems[] = new MenuItem("ponencias", 		"ponencias.php", 			UsuarioType::$PUBLICO);
		$menuitems[] = new MenuItem("misponencias", 		"MisPonencias.php", 			UsuarioType::$PONENTE);
		$menuitems[] = new MenuItem("adminpanel", 		"AdminPanel.php", 			UsuarioType::$ADMINISTRADOR);
		$menuitems[] = new MenuItem("evaluar", 			"EvaluarPonencias.php",			UsuarioType::$EVALUADOR);
		
		$menuitems[] = new MenuItem("registro", 		"register.php", 			UsuarioType::$PUBLICO);
		
		$subitem = new MenuItem("cuenta", 			"#",		 			UsuarioType::$REGISTRADO);
		$subitem = $subitem->addSubitem(new MenuItem("personal","Usuario.php?action=personal", 		UsuarioType::$REGISTRADO));
		$subitem = $subitem->addSubitem(new MenuItem("acceso", 	"Usuario.php?action=account", 		UsuarioType::$REGISTRADO));
		$subitem = $subitem->addSubitem(new MenuItem("logoff", 	"UsuarioLogin.php?action=logout", 	UsuarioType::$REGISTRADO));
		$menuitems[] = $subitem;
		
		$this->menu	= new Menu($menuitems, $this);
		$this->messages = array();
		$this->content  = NULL;
	}
	
	protected function render($renderable){
		try{
			if( $renderable instanceof Renderable ){
				echo($renderable->getHtml());
			} else if ( $renderable != NULL ){
				print $renderable->getComponentId() . " is not renderable";
			}
		} catch(ViewException $ve) {
			print $ve->i18n();
		} catch(Exception $e) {
			print "Error al renderizar la vista";
		}
	}
	
	public function renderAll(){
		try{
			if($this->handleRequest() == PageView::$REDIRECT){
				return;
			}
      		} catch (GenericException $ge) {
			$this->addMessage( new Message($ge->i18n(), Message::$WARN, true, $ge) );
      		}
		$this->render($this->getHeader());
		$this->render($this->getMenu());
		$this->render($this->getSubmenu());
		foreach($this->getMessages() as $message){
			$this->render($message);
		}
		$this->render($this->getContent());
		$this->render($this->getFooter());

		ApplicationContext::clearMessages();
	}

	public function getHeader(){ return $this->header; }
	public function getMenu(){	return $this->menu; }
	public function getSubmenu(){ 
		if( $this->getMenu() != NULL )
			return $this->getMenu()->getSelectedItem()->getSubmenu(); 
		return NULL;
	}
	public function getMessages(){ return ApplicationContext::getMessages(); }
	public function getContent(){ return $this->content; }
	public function getFooter(){ return $this->footer; }
	
	public function getAction(){
		return $this->getQueryParameter("action");
	}
	
	public function setHeader($header){ $this->header = $header; }
	public function setContent($content){ $this->content = $content; }
	public function setMenu($menu){ $this->menu = $menu; }
	public function setMessages($messages){ $this->messages = $messages; }
	public function addMessage($message){  ApplicationContext::addMessage($message, NULL); }
	public function setFooter($footer){ $this->footer = $footer; }
	
	abstract protected function handleRequest();

	public static $REDIRECT = 1;
}
?>