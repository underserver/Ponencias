<?php
class MenuItem{
	private $key;
	private $url;
	private $role;
	private $selected;
	private $subitems;
	
	public function __construct($key, $url, $role){
		$this->key = $key;
		$this->url = $url;
		$this->role = $role;
		$this->selected = false;
		$this->subitems = array();
	}
	
	public function getKey(){ return $this->key; }
	public function getUrl(){ return $this->url; }
	public function getRole(){ return $this->role; }
	public function isSelected(){ return $this->selected; }
	public function getLabel(){ return i18n($this->key); }
	public function getSubitems(){ return $this->subitems; }
	public function getHtml(){
		if( count($this->getSubitems()) > 0 ){
			$menu   = '<li class="'.($this->isSelected() ? 'selected' : '').'" id="services">';
			$menu  .= '<a href="javascript:showItem(\'servicelist\');">'.i18n("menu4").'<img src="styles/arrow.gif" alt=""></a>';
			$menu  .= '	<ul id="servicelist">';
			foreach( $this->subitems as $subitem ){
				$menu  .= $subitem->getHtml();
			}
			$menu  .= '	</ul>';
		} else {
			$menu   = '<li class="'.($this->isSelected() ? 'selected' : '').'">';
			$menu  .= '   <a href="'.$this->getUrl().'">'.$this->getLabel().'</a>';
		}
		$menu  .= '</li>';
		
		return $menu;
	}
	
	public function setKey($key){ $this->key = $key; }
	public function setUrl($url){ $this->url = $url; }
	public function setRole($role){ $this->role = $role; }
	public function setSelected($selected){ $this->selected = $selected; }
	public function setSubitems($subitems){ $this->subitems = $subitems; }
	public function addSubitem($subitem){ $this->subitems[] = $subitem; return $this;}
}
?>