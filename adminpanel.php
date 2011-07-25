<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Panel de control para el administrador
 *
***********************************************************************/
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
//if( $isadmin != 1 ) header( "Location: ./login.php" );

$sselected = 3; $subtitle = "Panel de administracion";$selected = 0;
$items = array( $_i18n["menu1"], "Ponencias", "Usuarios", "Nueva ponencia", "Nuevo usuario"  );
$links = array( "./adminpanel.php", "./adminpanel_sales.php", "./adminpanel_products.php","./adminpanel_categories.php", "./adminpanel_users.php" );
include("includes/header.php");
?>

<div id="content"><?php if( isset( $_GET[ "id" ] ) ){ ?>
<div align="center" class="msg">
<div class="bl3">
<div class="br">
<div class="tl">
<div class="tr2">
<?=$_i18n[ "admine".base64_decode( $_GET[ "id" ] ) ]?>
</div>
</div>
</div>
</div>
</div>
<?php }
$users = $db->get_var("select count(*) from usuarios");
$articles = $db->get_var("select count(*) from articulos");
$categories = $db->get_var("select count(*) from categorias");
$processed = $db->get_var("select count(*) from compras where compra_estado=2");
?>


<div id="dash1">
<h1>CFIE - Panel de Control de Ponencias</h1>
<div id="dom_user">
<div id="domain">
<p>Estado de las ponencias</p>
<ul class="inlinelist">
	<li><b> <a href="adminpanel_process.php?all">Ver ponencias pendientes</a>&nbsp;</b>
	</li>
	<li><a href="adminpanel_sales.php">Nuevas ponencias</a>&nbsp;
	</li>
</ul>
<div class="clear"></div>
</div>
<div id="users">
<h2><?=$_i18n["admin.usersaccount"]?></h2>
<ul class="inlinelist">
	<li><?=$users?> <?=$_i18n["admin.users"]?> &nbsp;</li>
	<li><a href="adminpanel_users.php#create">Nuevo usuario</a>&nbsp;
	</li>
</ul>
<p><?=$_i18n["admin.index.2"]?></p>
</div>
</div>
<div class="spacer"></div>
</div>
<div id="dash2">
<div class="spacer"></div>
<h2 class="inlinetext"><?=$_i18n["admin.configuration"]?></h2>
<ul class="inlinelist2">
	<li><a href="adminpanel_newproduct.php">Agregar nueva ponencia</a></li>
</ul>
<ul id="services">
	<li class="clrflt"><a href="EmailSettings" class="docs"><span><?=$_i18n["products"]?></span></a>
	<h3><a href="adminpanel_products.php">Ponencias pendientes</a>
	</h3>
	<span class="beta"><?=$articles?> </span> <span> - <?=$_i18n["admin.active"]?></span>
	<p><a href="#" class="greenlink"> Lista de ponencias pendientes de revisión </a>
	</p>
	</li>
	<li class=""><a href="ChatSettings" class="calendar"><span><?=$_i18n["categories.submenu"]?></span></a>
	<h3><a href="adminpanel_categories.php">Asistentes</a></h3>
	<span class="beta"><?=$categories?> </span> <span> - <?=$_i18n["admin.active"]?></span>
	<p><a href="#" class="greenlink"> Personas que asistiran a la ponencia</a></p>
	</li>
	<li class="clrflt"><a href="CalendarSettings" class="calendar"> <span>Usuarios</span></a>
	<h3><a href="adminpanel_users.php">Evaluadores</a></h3>
	<span class="beta"><?=$users?> </span> <span> - <?=$_i18n["admin.active"]?>
	</span>
	<p><a href="#" class="greenlink"> Usuarios que pueden evaluar ponencias </a></p>
	</li>
	<li class=""><a href="WebPages" class="calendar"><span><?=$_i18n["admin.salesp"]?></span></a>
	<h3><a href="adminpanel_sales.php?p=2">Ponentes</a></h3>
	<span class="beta"><?=$processed?> </span> <span> - <?=$_i18n["admin.active"]?>
	</span>
	<p><a href="adminpanel_sales.php?p=3" class="greenlink"> Personas que presentaran alguna ponencia</a>
	</p>
	</li>
</ul>
<div class="clear"></div>
</div>

</div>
<?php include("./includes/foot.php");?>

</body>
</html>
