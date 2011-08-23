<?php
require dirname(__FILE__)."/../includes/Menu.php";
require dirname(__FILE__)."/../includes/MenuItem.php";
require dirname(__FILE__)."/../_exceptions/ViewException.php";

abstract class PageView{
	private $header;
	private $menu;
	private $submenu;
	private $message;
	private $content;
	private $footer;
	
	public function __construct(){
    $this->header = dirname(__FILE__)."/../includes/header.inc";
    $this->footer = dirname(__FILE__)."/../includes/footer.inc";
		$this->menu = NULL;
		$this->submenu = NULL;
		$this->message = NULL;
		$this->content = NULL;
	}
	
	
	
	protected function render($pageView){
		try{
			print($this->);
			print($pageView->getMenu());
			//print($pageView->content());
			$this->currentView = $pageView;
		} catch(Exception $e) {
			throw $ve;
		}
	}
	
	
	protected function service(){
    try{
			$this->handleRequest();
		} catch (ViewException $ve) {
			echo $ve;
		}
	}

	public function getHeader(){ return $this->header; }
	public function getMenu(){	return $this->menu; }
	public function getSubmenu(){ return $this->submenu; }
	public function getMessage(){ return $this->message; }
	public function getContent(){ return $this->content; }
	public function getFooter(){ return $this->footer; }
	
	public function setContent($content){ $this->content = $content; }
	public function setMenu($menu){ $this->menu = $menu; }
	public function setSubmenu($submenu){ $this->submenu = $submenu; }
	public function setMessage($message){ $this->message = $message; }
	public function setContent($content){ $this->content = $content; }
	public function setFooter($footer){ $this->footer = $footer; }
	
	abstract protected function handleRequest();
}
?>