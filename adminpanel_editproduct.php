<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Formulario para modificar los datos de un producto
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
$_validator->setVars( array("pid:required") );

if( $_validator->validate() ){
	$values = $_validator->getValues();
}else{
	header( "Location: ./adminpanel_products.php?id=".base64_encode( "3" ) );
}

$sselected = 3; $subtitle = $_i18n["editproduct"];$selected = -1;
$items = array( $_i18n["menu1"], $_i18n["admin.onhold"], "<b>".$_i18n["admin.forsale"]."</b>", $_i18n["categories.submenu"], $_i18n[ "admin.users" ], $_i18n[ "newproduct" ], $_i18n[ "newcategory" ]  );
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
<?=$_i18n[ "editproducte".base64_decode( $_GET[ "id" ] ) ]?>
</div>
</div>
</div>
</div>
</div>
<?php }
$product = $db->get_row("select * from articulos where articulo_id=".base64_decode($values["pid"]));
$fields = " ".base64_decode( $_GET[ "tk" ] );

?>
<form action="adminpanel_editproductaction.php" method="post"
	id="settings" enctype="multipart/form-data"><input type="hidden"
	name="at" value="7cf0ac816f615996-1128ad98933"> <input type="hidden"
	name="pid" value="<?=$values["pid"]?>">
<table>
	<tr>
		<th><?=$_i18n["name"]?>:</th>
		<td><span class="errorbox-good"> <input type="text"
			value="<?=$product->articulo_nombre?>" name="name" id="fn" size="30">
		</span> <?php if( strpos( $fields, 'name' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th><?=$_i18n["count"]?>:</th>
		<td><span class="errorbox-good"> <input type="text"
			value="<?=$product->articulo_cantidad?>" name="count" id="fn"
			size="30"> </span> <?php if( strpos( $fields, 'count' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th><?=$_i18n["price"]?></th>
		<td><span class="errorbox-good"> <input type="text"
			value="<?=$product->articulo_precio?>" name="price" id="fn" size="30">
		</span> <?php if( strpos( $fields, 'price' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["expire"]?>:</th>
		<td><span class="errorbox-good"> <input type="text"
			value="<?=$product->articulo_expira?>" name="expire" id="expire"
			size="30"> <input type="button" value="Calendario"
			onclick="displayCalendar(document.getElementById('expire'),'yyyy-mm-dd',this)"></span>
			<?php if( strpos( $fields, 'expire' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th><?=$_i18n["description"]?>:</th>
		<td><span class="errorbox-good"> <textarea name="description" rows="6"
			cols="40" id="supportcontact"><?=$product->articulo_descripcion?></textarea>
			<?php if( strpos( $fields, 'description' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></span>
		</td>
	</tr>
	<tr>
		<th><?=$_i18n["product.image"]?>:</th>
		<td><span class="errorbox-good"> <input type="file" name="image"
			id="fn" size="30"> </span>
	
	</tr>
	<tr>
		<th><?=$_i18n["rank"]?>:</th>
		<td><span class="errorbox-good"> <input type="text" name="rank"
			value="<?=$product->articulo_rank?>" id="fn" size="30"> </span> <?php if( strpos( $fields, 'rank' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["category"]?>:</th>
		<td><span class="errorbox-good"> <select name="cat">

		<?php
		$categories = $db->get_results( "select categoria_nombre, categoria_id from categorias" );
		foreach( $categories as $cat ){
			?>
			<option value="<?=$cat->categoria_id?>"
			<?php if( $cat->categoria_id == $product->categoria_id ){?> selected
			<?php }?>><?=$cat->categoria_nombre?></option>
			<?php
}
?>
		</select> </span> <?php if( strpos( $fields, 'cat' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
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
