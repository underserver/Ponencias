<?php
class Submenu implements Renderable{
	private $items;
	private $subtitle;
	public function __construct($items, $subtitle){
		$this->items = $items;
		$this->subtitle = $subtitle;
	}
	
	public function getItems(){ return $this->items; }
	
	public function getHtml(){
		$html  = '<div class="clear"></div>';
		$html  .= '<div id="nav2">';
		$html  .= '	<h2>' . $this->subtitle . '</h2>';
		if( count( $items ) > 0 ){
			$html  .= '<ul id="submain">';
			foreach($items as $item){
				if( $item->isSelected() )
				$html  .= g
			}
			$html  .= '</ul> ';
		}
		$html  .= '</div>';
	}
	
	public function setItems($items){ $this->items = $items; }
	public function setSubtitle($subtitle){$this->subtitle = $subtitle ;}
}
?>