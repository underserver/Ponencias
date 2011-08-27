<?php
require dirname(__FILE__)."/../includes/Menu.php";
require dirname(__FILE__)."/../includes/MenuItem.php";
require dirname(__FILE__)."/../_exceptions/ViewException.php";

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
		$this->menu 	 = NULL;
		$this->submenu  = NULL;
		$this->messages = array();
		$this->content  = NULL;
	}
	
	protected function render($renderable){
		try{
			print($renderable->getHtml());
		} catch(ViewException $ve) {
			throw $ve;
		}
	}
	
	public function renderAll(){
		try{
			$this->handleRequest();
      } catch (GenericException $ge) {
			this->addMessage( new Message($ge->i18n(), Message::$WARN, true, $ge) );
      }
		$this->render($this->getHeader());
		$this->render($this->getMenu());
		$this->render($this->getSubmenu());
		$this->render($this->getMessage());
		$this->render($this->getContent());
		$this->render($this->getFooter());
	}

	public function getHeader(){ return $this->header; }
	public function getMenu(){	return $this->menu; }
	public function getSubmenu(){ return $this->submenu; }
	public function getMessages(){ return $this->messages; }
	public function getContent(){ return $this->content; }
	public function getFooter(){ return $this->footer; }
	
	public function setContent($content){ $this->content = $content; }
	public function setMenu($menu){ $this->menu = $menu; }
	public function setSubmenu($submenu){ $this->submenu = $submenu; }
	public function setMessages($messages){ $this->messages = $messages; }
	public function addMessage($message){ $this->messages[] = $message; }
	public function setContent($content){ $this->content = $content; }
	public function setFooter($footer){ $this->footer = $footer; }
	
	abstract protected function handleRequest();
}
?>