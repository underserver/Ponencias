<?php
require_once dirname(__FILE__)."/../enums/UsuarioType.php";
require_once dirname(__FILE__)."/Renderable.php";

class Menu implements Renderable{
	private $items;
	private $userType;
	private $viewId;
	private $selectedItem;
	
	public function __construct($userType, $viewId){
		$this->userType = $userType;
		$this->viewId = $viewId;
		
		$this->items = array();
		$this->items[] = new MenuItem("inicio", 				".", 						UsuarioType::$TODOS);
		$this->items[] = new MenuItem("ponencias", 			"ponencias.php", 			UsuarioType::$TODOS);
		$this->items[] = new MenuItem("misponencias", 		"admin_ponencias.php", 	UsuarioType::$PONENTE);
		$this->items[] = new MenuItem("adminpanel", 		"adminpanel.php", 			UsuarioType::$ADMINISTRADOR);
		$this->items[] = new MenuItem("evaluar", 			"adminpanel.php", 			UsuarioType::$EVALUADOR);
		
		$this->items[] = new MenuItem("registro", 			"register.php", 			UsuarioType::$PUBLICO);
		
		$item = new MenuItem("cuenta", 						"adminpanel.php", 			UsuarioType::$REGISTRADO);
		$item = $item->addSubitem(new MenuItem("personal",	"admin_persona.php", 		UsuarioType::$REGISTRADO));
		$item = $item->addSubitem(new MenuItem("acceso", 	"admin_access.php", 		UsuarioType::$REGISTRADO));
		$item = $item->addSubitem(new MenuItem("logoff", 	"logoff.php", 				UsuarioType::$REGISTRADO));
		$this->items[] = $item;
		
		echo json_encode($this->items[0]);
	}
	
	public function getItems(){ return $this->items; }
	public function getViewId(){ return $this->viewId; }
	public function getSelectedItem(){ return $this->selectedItem; }
	
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
				$selected = $item->getKey() == $this->viewId;
				if( $selected ){
					$item->setSelected( true );
					$this->selectedItem = $item;
				}
				$html .= $item->getHtml();
			}
		}
		$html .= "		</ul>\n";
		$html .= "</div>\n";
		
		return $html;
	}
	
	public function setItems($items){ $this->items = $items; }
	public function setViewId($viewId){ $this->viewId = $viewId; }
	
}
?>