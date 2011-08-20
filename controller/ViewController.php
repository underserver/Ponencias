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
	
	protected function render($view){
		if (file_exists('view/'.$view.'.php')){
			$this->currentView = $view;
			include('view/'.$view.'.php');
		} else {
			throw new ViewException($view, ViewException::NOT_FOUND);
		}
	}
	
	public function getCurrentView(){
		return $currentView;
	}
	
	abstract protected function handleRequest();
}
?>