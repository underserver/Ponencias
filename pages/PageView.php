<?php
require dirname(__FILE__)."/../includes/Menu.php";
require dirname(__FILE__)."/../includes/MenuItem.php";
require dirname(__FILE__)."/../_exceptions/ViewException.php";

class PageView{
	private $menuItem;
	private $usuario;
	private $content;
	
	public function __construct($menuItem, $usuario){
		$this->menuItem = $menuItem;
		$this->usuario = $usuario;
	}
	
	public function header(){
		include_once dirname(__FILE__)."/../includes/header.inc";
	}
	
	public function menu(){
		$menu = new Menu($menuItem, $usuario);
		return $menu->getHtml();
	}
	
	public function submenu(){
	
	}
	
	public function setContent($content){
		$this->content = $content;
	}
	
	public function content(){
		if (file_exists('view/'.$content.'.php')){
			return include('view/'.$content.'.php');
		} else {
			throw new ViewException($content, ViewException::$NOT_FOUND);
		}
	}
}
?>