<?php
require dirname(__FILE__)."/../enums/UsuarioType.php";
class Menu{
	private $items;
	private $userType;
	private $viewId;
	
	public function __construct($userType, $viewId){
		$this->userType = $userType;
		$this->viewId = $viewId;
		
		$this->items = array();
		$this->items[] = new MenuItem("inicio", 		".", 						UsuarioType::$TODOS);
		$this->items[] = new MenuItem("ponencias", 	"ponencias.php", 			UsuarioType::$TODOS);
		$this->items[] = new MenuItem("misponencias", "admin_ponencias.php", 	UsuarioType::$PONENTE);
		$this->items[] = new MenuItem("adminpanel", 	"adminpanel.php", 		UsuarioType::$ADMINISTRADOR);
		$this->items[] = new MenuItem("evaluar", 		"adminpanel.php", 		UsuarioType::$EVALUADOR);
		
		$item = new MenuItem("cuenta", 		"adminpanel.php", 			UsuarioType::$TODOS);
		$item = $item->addSubitem(new MenuItem("personal",	"admin_persona.php", 	UsuarioType::$TODOS));
		$item = $item->addSubitem(new MenuItem("acceso", 	"admin_access.php", 	UsuarioType::$TODOS));
		$item = $item->addSubitem(new MenuItem("logoff", 	"logoff.php", 			UsuarioType::$TODOS));
		$this->items[] = $item;
		
		$this->items[] = new MenuItem("registro", 		"register.php", 			UsuarioType::$PUBLICO);
	}
	
	public function getItems(){ return $this->items; }
	public function getViewId(){ return $this->viewId; }
	
	public function getHtml(){
		$html  = '<div id="navigation">';
		$html .= '		<ul>';
		foreach( $this->items as $item ){
			if( $item->getRole() == $this->userType ){
				$item->setSelected( $item->getKey() == $this->viewId );
				$html .= $item->getHtml();
			}
		}
		$html .= '		</ul>';
		$html .= '		<div class="clear"></div>';
		$html .= '</div>';
		
		return $html;
	}
	
	public function setItems($items){ $this->items = $items; }
	public function setViewId($viewId){ $this->viewId = $viewId; }
	
}
?>