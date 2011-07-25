<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Formulario para modificar los datos de acceso
 *
***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
if( $login != 1 ) header( "Location: ./login.php" );

$sselected = 4; $subtitle = $_i18n["access.submenu"];
include("includes/header.php");
?>

<div id="content"><?php if( isset( $_GET[ "id" ] ) ){ ?>
<div align="center" class="msg">
<div class="bl3">
<div class="br">
<div class="tl">
<div class="tr2">
<?=$_i18n[ "accesse".base64_decode( $_GET[ "id" ] ) ]?>
</div>
</div>
</div>
</div>
</div>
<?php }
$user = $db->get_row("select * from usuarios where usuario_id=".$_SESSION[ "user_id" ]);
$fields = " ".base64_decode( $_GET[ "tk" ] );
?>
<form action="action_access.php"
	onsubmit="return validatePass('pass1','pass2')" method="post"
	id="settings"><input type="hidden" name="at"
	value="7cf0ac816f615996-1128ad98933">
<table>
	<tr>
		<th>Alias:</th>
		<td><span class="errorbox-good"> <b><em> <?=$user->usuario_alias?></em>
		</b></span></td>
	</tr>
	<tr>
		<th><?=$_i18n["currentpassword"]?>:</th>
		<td><span class="errorbox-good"> <input type="password" 
			name="pass_now" value="" id="fn" size="30"> <br>
			<?=$_i18n["accessinfo1"]?> </span> <?php if( strpos( $fields, 'pass_now' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th><?=$_i18n["newpassword"]?>:</th>
		<td><span class="errorbox-good"> <input type="password" name="pass"
			value="" id="pass1" size="30"> </span> <?php if( strpos( $fields, 'pass' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th><?=$_i18n["confirmpassword"]?>:</th>
		<td><span class="errorbox-good"> <input type="password" name="pass_re"
			value="" id="pass2" size="30"> <input type="button"
			value="<?=$_i18n["verifyasswords"]?>"
			onclick="validatePass1('pass1','pass2')"></span></td>
	</tr>

	<tr class="finalrow">
		<th></th>
		<td><input value="<?=$_i18n["savechange"]?>" class="mainbutton"
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
