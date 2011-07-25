<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Formulario para modificar una cateogoria
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
if( $isadmin != 1 ) header( "Location: ./login.php" );

$_validator = new Validator();
$_validator->setMethod( "GET" );
$_validator->setVars( array("cid:required") );

if( $_validator->validate() ){
	$values = $_validator->getValues();
}else{
	header( "Location: ./adminpanel_categories.php?id=".base64_encode( "3" ) );
}

$sselected = 3; $subtitle = $_i18n["editcategory"];$selected = -1;
$items = array( $_i18n["menu1"], $_i18n["admin.onhold"], $_i18n["admin.forsale"], "<b>".$_i18n["categories.submenu"]."</b>", $_i18n[ "admin.users" ], $_i18n[ "newproduct" ], $_i18n[ "newcategory" ]  );
$links = array( "./adminpanel.php", "./adminpanel_sales.php", "./adminpanel_products.php","./adminpanel_categories.php", "./adminpanel_users.php", "./adminpanel_newproduct.php", "./adminpanel_newcategory.php" );
include("includes/header.php");
?>
<link
	rel="stylesheet" media="screen"
	href="styles/calendar.css?random=20051112"></link>
<script
	type="text/javascript" src="jscripts/calendar/calendar.js"></script>

<div id="content"><?php if( isset( $_GET[ "id" ] ) ){ ?>
<div align="center" class="msg">
<div class="bl3">
<div class="br">
<div class="tl">
<div class="tr2">
<?=$_i18n[ "editcategorye".base64_decode( $_GET[ "id" ] ) ]?>
</div>
</div>
</div>
</div>
</div>
<?php }
$cat = $db->get_row("select * from categorias where categoria_id=".base64_decode($values["cid"]));
$fields = " ".base64_decode( $_GET[ "tk" ] );

?>
<form action="adminpanel_editcategoryaction.php" method="post"
	id="settings" enctype="multipart/form-data"><input type="hidden"
	name="at" value="7cf0ac816f615996-1128ad98933"> <input type="hidden"
	name="cid" value="<?=$values["cid"]?>">
<table>
	<tr>
		<th><?=$_i18n["name"]?>:</th>
		<td><span class="errorbox-good"> <input type="text"
			value="<?=$cat->categoria_nombre?>" name="name" id="fn" size="30"> </span>
			<?php if( strpos( $fields, 'name' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>

	<tr>
		<th><?=$_i18n["description"]?>:</th>
		<td><span class="errorbox-good"> <textarea name="description" rows="6"
			cols="40" id="supportcontact"><?=$cat->categoria_descripcion?></textarea>
			<?php if( strpos( $fields, 'description' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></span>
		</td>
	</tr>
	<tr>
		<th><?=$_i18n["rank"]?>:</th>
		<td><span class="errorbox-good"> <input type="text" name="rank"
			value="<?=$cat->categoria_rank?>" id="fn" size="30"> </span> <?php if( strpos( $fields, 'rank' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
	
	
	<tr class="finalrow">
		<th></th>
		<td><input value="<?=$_i18n["savechange"]?>" name="save"
			class="mainbutton" onclick="clear_isset_monitoring();" type="submit">
		<input value="<?=$_i18n["cancel"]?>" class="cancel"
			onclick="clear_isset_monitoring(); go('./adminpanel.php');"
			name="Button" type="button"></td>
	</tr>
</table>
</form>
</div>
			<?php include("./includes/foot.php");?>

</body>
</html>
