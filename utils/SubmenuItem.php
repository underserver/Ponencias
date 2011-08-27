<?php
class SubmenuItem implements Renderable{
	private $key;
	private $url;
	private $role;
	private $selected;
	
	public function __construct($key, $url, $role){
		$this->key = $key;
		$this->url = $url;
		$this->role = $role;
		$this->selected = false;
	}
	
	public function getKey(){ return $this->key; }
	public function getUrl(){ return $this->url; }
	public function getRole(){ return $this->role; }
	public function isSelected(){ return $this->selected; }
	public function getLabel(){ return i18n($this->key); }
	
	public function getHtml(){
		
		if( $this->isSelected() ){
			$html  = '<li class="selected">'. $this->getLabel() .'</li>';
		} else {
			$html  = '<li class=""><a href="'. $this->getUrl() .'">'. $this->getLabel() .'</a></li>';
		}
		
		return $html;
	}
	
	public function setKey($key){ $this->key = $key; }
	public function setUrl($url){ $this->url = $url; }
	public function setRole($role){ $this->role = $role; }
	public function setSelected($selected){ $this->selected = $selected; }
}
?>