<?php
require_once dirname(__FILE__)."/../enums/UsuarioType.php";
require_once dirname(__FILE__)."/Renderable.php";

class Menu implements Renderable{
	private $items;
	private $userType;
	
	public function __construct($items = array(), $pageView){
		$this->userType = $pageView->getUsuario()->getTipo();
		$this->items = $items;
	}
	
	public function getItems(){ return $this->items; }
	public function getSelectedItem() {
		foreach( $this->items as $item ){
			if( $item->isSelected() ){
				return $item;
			}
		}
	}
	
	public function getHtml(){
		$html  = "<div id='navigation'>\n";
		$html .= "		<ul>\n";
		foreach( $this->items as $item ){
			if( $item->getRole() == $this->userType || 
				$item->getRole() == UsuarioType::$TODOS || (
										$item->getRole() == UsuarioType::$REGISTRADO && $this->userType != UsuarioType::$PUBLICO 
									  ) 
				)
			{
				$html .= $item->getHtml();
			}
		}
		$html .= "		</ul>\n";
		$html .= "</div>\n";
		
		return $html;
	}
	
	public function setItems($items){ $this->items = $items; }
	public function setSelectedItem($key){
		foreach( $this->items as $item ){
			if( $item->getKey() == $key ){
				$item->setSelected( true );
			}
		}
	}
	
	public function setSelectedSubItem($key){
		foreach( $this->getSelectedItem()->getSubmenu()->getItems() as $item ){
			if( $item->getKey() == $key ){
				$item->setSelected( "true" );
			}
		}
	}
	
	public function setTitle($title){
		$this->getSelectedItem()->getSubmenu()->setSubtitle($title);
	}
	
}
?>