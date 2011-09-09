<?php
require_once dirname(__FILE__)."/../enums/UsuarioType.php";
require_once dirname(__FILE__)."/Renderable.php";

class Submenu implements Renderable{
	private $items;
	private $subtitle;
	public function __construct($items = array(), $subtitle){
		$this->subtitle = $subtitle;
		$this->items = $items;
	}
	
	public function getItems(){ return $this->items; }
	
	public function getHtml(){
		$html   = "<div id='nav2'>\n";
		$html  .= "	<h2>" . $this->subtitle . "</h2>\n";
		if( count( $this->items ) > 0 ){
			$html  .= "<ul id='submain'>\n";
			foreach($this->items as $item){
				//if( $item->isSelected() ){
					$html  .= $item->getHtml();
				//}
			}
			$html  .= "</ul>\n";
		}
		$html  .= "</div>\n";
		$html .= "<div class='clear'></div>\n";
		
		return $html;
	}
	
	public function setItems($items){ $this->items = $items; }
	public function addItem($item){ $this->items[] = $item; }
	public function setSubtitle($subtitle){ $this->subtitle = $subtitle; }
}
?>