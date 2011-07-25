<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Formulario de registro para clientes
 *
 ***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
include_once "./includes/db.php";

$type = isset($_GET["type"])?$_GET["type"]:0;
$sselected = 4; $subtitle = $_i18n["register"]; $selected = $type;
$items = array( $_i18n["register.submenu2"], $_i18n["register.submenu3"], $_i18n["register.submenu4"], $_i18n["register.submenu5"] ); 
$links = array( "./register.php?type=0", "./register.php?type=1", "./register.php?type=2", "./register.php?type=3" );
include("includes/header.php");

?>

<div id="content"><?php if( isset( $_GET[ "id" ] ) ){ ?>
<div align="center" class="msg">
<div class="bl3">
<div class="br">
<div class="tl">
<div class="tr2"><?=$_i18n[ "registere".base64_decode( $_GET[ "id" ] ) ]?>
</div>
</div>
</div>
</div>
</div>
<?php }

$fields = " ".base64_decode( $_GET[ "tk" ] );
?>
<form action="action_register.php" method="post" id="settings"><input
	type="hidden" name="at" value="7cf0ac816f615996-1128ad98933">
<table>
	
	<tr>
		<th><?=$_i18n["name"]?>: <font color="red">*</font></th>
		<td><span class="errorbox-good"> <input type="text" name="name" class="rounded"
			value="<?=$_GET["name"]?>" id="fn" size="35"> </span> <?php if( strpos( $fields, 'name' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["lastname"]?>: <font color="red">*</font></th>
		<td><span class="errorbox-good"> <input type="text" name="last" class="rounded"
			value="<?=$_GET["last"]?>" id="fn" size="35"> </span> <?php if( strpos( $fields, 'last' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["email"]?>: <font color="red">*</font></th>
		<td><span class="errorbox-good"> <input type="text" name="email" class="rounded"
			value="<?=$_GET["email"]?>" id="fn" size="35"> </span> <?php if( strpos( $fields, 'email' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emailfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["phone"]?>:</th>
		<td><span class="errorbox-good"> <input type="text" name="phone" class="rounded"
			value="<?=$_GET["phone"]?>" id="" size="35"> </span> <?php if( strpos( $fields, 'phone' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["institution"]?>:</th>
		<td><span class="errorbox-good"><select name="institution">
			<option value="American" selected>Insituto Politecnico Nacional</option>
		</select> </span> <?php if( strpos( $fields, 'institution' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	
  <tr>
		<th><?=$_i18n["user"]?>: <font color="red">*</font></th>
		<td><span class="errorbox-good"> <input type="text" name="user" class="rounded"
			value="<?=$_GET["user"]?>" id="fn" size="35"> </span> <?php if( strpos( $fields, 'user' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th><?=$_i18n["password"]?>: <font color="red">*</font></th>
		<td><span class="errorbox-good"> <input type="password" class="rounded"
			name="password" value="" id="" size="35"> </span> <?php if( strpos( $fields, 'password' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	
	<tr class="finalrow">
		<th></th>
		<td>
      <input type="hidden" class="rounded"
			name="type" value="<?=$type?>" >
			
			<input value="<?=$_i18n["savechange"]?>" class="mainbutton"
			onclick="clear_isset_monitoring();" type="submit"> <input
			value="<?=$_i18n["cancel"]?>" class="cancel"
			onclick="clear_isset_monitoring(); go('./');" name="Button"
			type="button"></td>
	</tr>
</table>
</form>
</div>
<?php include("./includes/foot.php");?>

</body>
</html>
