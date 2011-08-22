<?php
abstract class ViewController{
	private $currentView;
	
	public function __construct(){
		try{
			$this->handleRequest();
		} catch (ViewException $ve) {
			echo $ve;
		}
	}
	
	public function getSession(){
		return $_SESSION;
	}
	
	public function getAction(){
		return $_GET["_action"];
	}
	
	protected function render($pageView){
		try{
			print($pageView->header());
			print($pageView->menu());
			//print($pageView->content());
			$this->currentView = $pageView;
		} catch(ViewException $ve) {
			throw $ve;
		}
	}
	
	public function getCurrentView(){
		return $currentView;
	}
	
	abstract protected function handleRequest();
}
?>