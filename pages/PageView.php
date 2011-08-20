<?php
class PageView{
	private $theme;
	
	public function __construct($theme){
		$this->theme = $theme;
	}
	
	public function __construct(){}
	
	public function header(){
		include_once "../includes/header.inc";
	}
	
	public function menu(){
		$menu   = '<div id="navigation">';
		$menu  .= '<ul>';
		$menu  .= '<li class="'.($sselected == 1 ? "selected" : "").')">';
		$menu  .= '     <a href=".">'.i18n("menu1").'</a>';
		$menu  .= '</li>';
		$menu  .= '<li class="<?=$sselected == 2 ? "selected" : ""?>">';
		$menu  .= '     <a href="ponencias.php" title=""><?=i18n("menu2")?></a>';
		$menu  .= '</li>';
		$menu  .= '<?php if ( isset($_SESSION[ 'user_id' ]) ){?>';
		$menu  .= '<?if( $_SESSION['user_role'] == 2 ){?>';
		$menu  .= '<li class="<?=$sselected == 3 ? "selected" : ""?>">';
		$menu  .= '   <a href="admin_ponencias.php" title="Mis Ponencias"> Mis Ponencias </a>';
		$menu  .= '</li>';
		$menu  .= '<?} else if( $_SESSION['user_role'] == 1 ){?>';
		$menu  .= '<li class="<?=$sselected == 3 ? "selected" : ""?>">';
		$menu  .= '    <a href="adminpanel.php" title=""><?=i18n("menu3")?></a>';
		$menu  .= '</li>';
		$menu  .= '<?} else if( $_SESSION['user_role'] == 3 ){?>';
		$menu  .= '<li class="<?=$sselected == 3 ? "selected" : ""?>">';
		$menu  .= '   <a href="adminpanel.php" title="Evaluar Ponencias">Evaluar Ponencias</a>';
		$menu  .= '</li>';
		$menu  .= '<?}?>';
		$menu  .= '<li id="services" class="<?=$sselected == 4 ? "selected" : ""?>">';
		$menu  .= '   <a href="javascript:showItem('servicelist');"	title=" <?=$_i18n["menu4"]?>">';
		$menu  .= '   <?=$_i18n["menu4"]?><img src="styles/arrow.gif" alt="">';
		$menu  .= '    </a>';
		$menu  .= '   <ul id="servicelist">';
		$menu  .= '<li class="">';
		$menu  .= '   <a href="admin_personal.php" title="<?=$_i18n["menu41"]?>"><?=$_i18n["menu41"]?> </a>';
		$menu  .= '</li>';
		$menu  .= '<li class="">';
		$menu  .= '  <a href="admin_access.php" title="<?=$_i18n["menu42"]?>"><?=$_i18n["menu42"]?> </a></li>';
		$menu  .= '<li class="">';
		$menu  .= '  <a href="logoff.php" title="Cerrar sesión">Cerrar sesión</a>';
		$menu  .= '</li>';
		$menu  .= '</ul>';
		$menu  .= '/li>';
		$menu  .= '<?}else{?>';
		$menu  .= '</li>';
		$menu  .= '<li class="<?=$sselected == 4 ? "selected" : ""?>">';
		$menu  .= '<a href="register.php" title="Registro">Registro</a></li>';
		$menu  .= '<?}?>';
		$menu  .= '</ul>';
		$menu  .= '<div class="clear"></div>';
		$menu  .= '</div>';
	}
	
	public function submenu(){
	
	}
}
?>