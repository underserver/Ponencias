<?php
require_once dirname(__FILE__)."/Renderable.php";
class MenuItem implements Renderable{
	private $key;
	private $url;
	private $role;
	private $selected;
	private $subitems;
	private $submenu;
	
	public function __construct($key, $url, $role, $submenu = new Submenu()){
		$this->key = $key;
		$this->url = $url;
		$this->role = $role;
		$this->selected = false;
		$this->subitems = array();
		$this->submenu = $submenu;
	}
	
	public function getKey(){ return $this->key; }
	public function getUrl(){ return $this->url; }
	public function getRole(){ return $this->role; }
	public function isSelected(){ return $this->selected; }
	public function getLabel(){ return i18n($this->key); }
	public function getSubitems(){ return $this->subitems; }
	public function getSubmenu(){ return $this->submenu; }
	public function getHtml(){
		if( count($this->getSubitems()) > 0 ){
			$menu   = "<li class='".($this->isSelected() ? "selected" : "")."' id='services'>\n";
			$menu  .= "<a href='javascript:showItem(\"servicelist\");'>".$this->getLabel()."<img src='styles/arrow.gif' alt=''></a>\n";
			$menu  .= "	<ul id='servicelist'>\n";
			foreach( $this->subitems as $subitem ){
				$menu  .= $subitem->getHtml();
			}
			$menu  .= "	</ul>\n";
		} else {
			$menu   = "<li class='".($this->isSelected() ? "selected" : "")."'>\n";
			$menu  .= "   <a href='".$this->getUrl()."'>".$this->getLabel()."</a>\n";
		}
		$menu  .= "</li>\n";
		
		return $menu;
	}
	
	public function setKey($key){ $this->key = $key; }
	public function setUrl($url){ $this->url = $url; }
	public function setRole($role){ $this->role = $role; }
	public function setSelected($selected){ $this->selected = $selected; }
	public function setSubitems($subitems){ $this->subitems = $subitems; }
	public function setSubmenu($submenu){ $this->submenu = $submenu; }
	public function addSubitem($subitem){ $this->subitems[] = $subitem; return $this;}
}
?>