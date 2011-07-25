<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Formulario para modificar los datos de un usuario
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
$_validator->setVars( array("user:required") );

if( $_validator->validate() ){
	$values = $_validator->getValues();
}else{
	header( "Location: ./adminpanel_users.php?id=".base64_encode( "3" ) );
}

$sselected = 3; $subtitle = $_i18n["edituser"];$selected = -1;
$items = array( $_i18n["menu1"], $_i18n["admin.onhold"], $_i18n["admin.forsale"], $_i18n["categories.submenu"], $_i18n[ "admin.users" ], $_i18n[ "newproduct" ], $_i18n[ "newcategory" ]  );
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
<?=$_i18n[ "editusere".base64_decode( $_GET[ "id" ] ) ]?>
</div>
</div>
</div>
</div>
</div>
<?php }
$user = $db->get_row("select * from usuarios where usuario_id=".base64_decode($values["user"]));
$ps  = strpos( $user->usuario_apellidos, ' ');
$l=substr(  ereg_replace("[^aeiou]", "", substr( $user->usuario_apellidos,1) ) ,0,1);

$rfc = substr( $user->usuario_apellidos, 0, 1 ).$l.substr( $user->usuario_apellidos, $ps+1, 1 ).substr( $user->usuario_nombre, 0, 1 ).str_replace( "-", "", substr( $user->usuario_nacimiento, 2 ));
$rfc = strtoupper ( $rfc );
$fields = " ".base64_decode( $_GET[ "tk" ] );

?>
<form action="adminpanel_edituseraction.php" method="post" id="settings">
<input type="hidden" name="at" value="7cf0ac816f615996-1128ad98933"> <input
	type="hidden" name="userid" value="<?=$values["user"]?>">
<table>
	<tr>
		<th><?=$_i18n["name"]?>:</th>
		<td><span class="errorbox-good"> <input type="text"
			value="<?=$user->usuario_nombre?>" name="user_name" id="fn" size="30">
		</span> <?php if( strpos( $fields, 'user_name' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th><?=$_i18n["lastname"]?>:</th>
		<td><span class="errorbox-good"> <input type="text"
			value="<?=$user->usuario_apellidos?>" name="user_lastname" id="fn"
			size="30"> </span> <?php if( strpos( $fields, 'user_lastname' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["shared"]?>:</th>
		<td><span class="errorbox-good"> <input type="checkbox"
		<?=($user->usuario_compartido=="1"? "checked=\"checked\"": "")?>
			name="shared" id="fn" size="30"><?=$_i18n["info2"]?> </span></td>
	</tr>
	<tr>
		<th><?=$_i18n["born"]?>:</th>
		<td><span class="errorbox-good"> <input type="text"
			value="<?=$user->usuario_nacimiento?>" name="user_born"
			id="user_born" size="30"> <input type="button" value="Calendario"
			onclick="displayCalendar(document.getElementById('user_born'),'yyyy-mm-dd',this)"></span>
			<?php if( strpos( $fields, 'user_born' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["rfc"]?>:</th>
		<td><span class="errorbox-good"> <input type="text" value="<?=$rfc?>"
			disabled name="user_rfc" id="fn" size="30"> </span></td>
	</tr>
	<tr>
		<th><?=$_i18n["address"]?>:</th>
		<td><span class="errorbox-good"> <textarea name="user_address"
			rows="6" cols="40" id="supportcontact"><?=$user->usuario_direccion?></textarea>
			<?php if( strpos( $fields, 'user_address' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></span>
		</td>
	</tr>
	<tr>
		<th><?=$_i18n["phone"]?>:</th>
		<td><span class="errorbox-good"> <input type="text" name="user_phone"
			value="<?=$user->usuario_telefono?>" id="fn" size="30"> </span> <?php if( strpos( $fields, 'user_phone' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["mail"]?>:</th>
		<td><span class="errorbox-good"> <input type="text" name="user_mail"
			value="<?=$user->usuario_correo?>" id="fn" size="30"> </span> <?php if( strpos( $fields, 'user_mail' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["password"]?>:</th>
		<td><span class="errorbox-good"> <input type="password"
			name="password" value="" id="fn" size="30"> <br>
		</span> <?php if( strpos( $fields, 'password' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
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
