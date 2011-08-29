<?php
require_once dirname(__FILE__)."/../utils/Menu.php";
require_once dirname(__FILE__)."/../utils/MenuItem.php";
require_once dirname(__FILE__)."/../utils/Submenu.php";
require_once dirname(__FILE__)."/../utils/SubmenuItem.php";
require_once dirname(__FILE__)."/../utils/HtmlPage.php";
require_once dirname(__FILE__)."/../_exceptions/ViewException.php";
require_once dirname(__FILE__)."/../controller/ViewController.php";

abstract class PageView extends ViewController{
	private $header;
	private $menu;
	private $submenu;
	private $messages;
	private $content;
	private $footer;
	
	public function __construct(){
		parent::__construct();
		
		$this->header 	 = dirname(__FILE__)."/../includes/header.inc";
		$this->footer 	 = dirname(__FILE__)."/../includes/footer.inc";
		$this->menu 	 = new Menu($this->getUsuarioActual()->getTipo(), "inicio");
		$this->submenu  = new Submenu(NULL, "Inicio");
		$this->messages = array();
		$this->content  = NULL;
	}
	
	protected function render($renderable){
		try{
			if( $renderable instanceof Renderable ){
				echo($renderable->getHtml());
			} else {
				print $renderable . " is not renderable";
			}
		} catch(ViewException $ve) {
			print $ve->i18n();
		}
	}
	
	public function renderAll(){
		try{
			$this->handleRequest();
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
	}

	public function getHeader(){ return new HtmlPage($this->header); }
	public function getMenu(){	return $this->menu; }
	public function getSubmenu(){ return $this->submenu; }
	public function getMessages(){ return $this->messages; }
	public function getContent(){ return $this->content; }
	public function getFooter(){ return new HtmlPage($this->footer); }
	
	public function setContent($content){ $this->content = $content; }
	public function setMenu($menu){ $this->menu = $menu; }
	public function setSubmenu($submenu){ $this->submenu = $submenu; }
	public function setMessages($messages){ $this->messages = $messages; }
	public function addMessage($message){ $this->messages[] = $message; }
	public function setFooter($footer){ $this->footer = $footer; }
	
	abstract protected function handleRequest();
}
?>