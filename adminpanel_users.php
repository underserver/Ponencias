<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Lista de usuarios clientes
 *
***********************************************************************/
// Include file headers
include_once "./includes/utils.php";
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
if( $isadmin != 1 ) header( "Location: ./login.php" );

$sselected = 3; $subtitle = $_i18n[ "admin.users" ];$selected = 4;
$items = array( $_i18n["menu1"], $_i18n["admin.onhold"], $_i18n["admin.forsale"], $_i18n["categories.submenu"], $_i18n[ "admin.users" ], $_i18n[ "newproduct" ], $_i18n[ "newcategory" ]  );
$links = array( "./adminpanel.php", "./adminpanel_sales.php", "./adminpanel_products.php","./adminpanel_categories.php", "./adminpanel_users.php", "./adminpanel_newproduct.php", "./adminpanel_newcategory.php" );
include("includes/header.php");$_validator = new Validator();
$fields = " ".base64_decode( $_GET[ "tk" ] );
?>

<div id="content">
<div align="center" class="msg">
<div class="bl3">
<div class="br">
<div class="tl">
<div class="tr2"><?=$_i18n[ "userse".base64_decode( $_GET[ "id" ] ) ]?>
</div>
</div>
</div>
</div>
</div>





<form action="adminpanel_register.php" method="post" id="settings"><input
	type="hidden" name="at" value="7cf0ac816f615996-1128ad98933">
<table>
	<tr>
		<th style="text-align: left"><?=$_i18n["name"]?>: <font color="red">*</font></th>
		<td><span class="errorbox-good"> <input type="text" name="name"
			value="" id="fn" size="30"> </span> <?php if( strpos( $fields, 'name' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["password"]?>: <font color="red">*</font></th>
		<td><span class="errorbox-good"> <input type="password"
			name="password" value="" id="" size="30"> </span> <?php if( strpos( $fields, 'password' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th>Tipo: <font color="red">*</font></th>
		<td><span class="errorbox-good">
			<select name="type">
				<option value="0">Ponente/Conferencista</option>
				<option value="1">Coautor</option>
				<option value="2">Asistente</option>
				<option value="3">Evaluador</option>
			</select> 
			 </span> <?php if( strpos( $fields, 'type' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr class="finalrow">
		<th></th>
		<td><input value="Agregar usuario" class="mainbutton"
			onclick="clear_isset_monitoring();" type="submit"></td>
	</tr>
</table>
</form>

<p>
	<hr>
</p>



	<tr class="" id="ARTICLE_COLLECTION_SELECTION_<?=$i?>">
		<td></td>
		<td><input value="true"
			name="COLLECTION_SELECTION_<?=$i?>.<?=base64_encode($usuarios[$i]->usuario_id)?>"
			onclick="cbTbl.selectOne(this); updateDeleteButtons(this);"
			type="checkbox"></td>
		<td><a href="javascript:void(0)"
			onclick="go( 'adminpanel_edituser.php?user=<?=base64_encode($usuarios[$i]->usuario_id)?>' );return false"><?=$usuarios[$i]->usuario_alias?></a></td>
		<td><?=getTipoUsuario($usuarios[$i]->usuario_tipo)?></td>
		<td><?=count($userPonencias)?></td>
		<td><?=(trim($usuarios[$i]->usuario_ultimoacceso) != "" ? $usuarios[$i]->usuario_ultimoacceso : $_i18n["notavailable"])?></td>
	</tr>
	<?php
}
if( $i == 0 ){
	?>
	

	
</div>
</div>
	<?php include("./includes/foot.php");?>
</body>
</html>
