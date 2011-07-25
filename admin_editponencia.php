<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Formulario para dar de alta un nuevo producto
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
//if( $isadmin != 1 ) header( "Location: ./login.php" );

$pid = $_GET["pid"];
if( !isset($pid) )
  header( "Location: ./admin_ponencias.php" );
  
$sselected = 3; $subtitle = "Mis ponencias"; $selected = 2;

$items[ 0 ] = "Mis ponencias";
$links[ 0 ] = "admin_ponencias.php";

$items[ 1 ] = "Nueva ponencia";
$links[ 1 ] = "admin_newponencia.php";

$items[ 2 ] = "Editar ponencia";
$links[ 2 ] = "#";
include("includes/header.php");

$ponencias = $db->get_results("select ponencias.*, usuarios.* from ponencias, usuarios where usuarios.usuario_id=ponencias.usuario_id and usuarios.usuario_id=".$_SESSION["user_id"] . " and ponencias.ponencia_id=".base64_decode($pid)." order by ponencias.ponencia_fecha");
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
<?=$_i18n[ "newproducte".base64_decode( $_GET[ "id" ] ) ]?>
</div>
</div>
</div>
</div>
</div>
<?php }
$fields = " ".base64_decode( $_GET[ "tk" ] );
?>
<form action="action_editponencia.php" method="post"
	id="settings" enctype="multipart/form-data"><input type="hidden"
	name="at" value="7cf0ac816f615996-1128ad98933">
<table>
	<tr>
		<th>Titulo:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded" value="<?=$ponencias[0]->ponencia_titulo?>"
			name="title" id="fn" size="30"> </span> <?php if( strpos( $fields, 'title' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th>Fecha de presentación:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded" value="<?=$ponencias[0]->ponencia_fecha?>"
			name="date" id="expire" size="30"> <input type="button"
			value="Calendario"
			onclick="displayCalendar(document.getElementById('expire'),'yyyy-mm-dd',this)"></span>
			<?php if( strpos( $fields, 'date' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th>Resumen:</th>
		<td><span class="errorbox-good"> <textarea name="summary" rows="7" class="rounded"
			cols="60" id="supportcontact"><?=$ponencias[0]->ponencia_resumen?></textarea> <?php if( strpos( $fields, 'summary' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></span>
		</td>
	</tr>
	<tr>
		<th>Eje Tematico:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded" value="<?=$ponencias[0]->ponencia_ejetematico?>"
			name="eje" id="fn" size="30"> </span> <?php if( strpos( $fields, 'eje' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th>Archivo <b>con</b> nombres:</th>
		<td><span class="errorbox-good"> <input type="file" name="file1" class="file"
			id="fn" size="30"> <b><?=$ponencias[0]->ponencia_archivo1?></b><?php if( strpos( $fields, 'file1' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></span>
	</tr>
	<tr>
		<th>Archivo <b>sin</b> nombres:</th>
		<td><span class="errorbox-good"> <input type="file" name="file2" class="file"
			id="fn" size="30"> <b><?=$ponencias[0]->ponencia_archivo2?></b><?php if( strpos( $fields, 'file2' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></span>
	</tr>
	<tr class="finalrow">
		<th><input type="hidden" name="pid" value="<?=$pid?>"></th>
		<td><input value="<?=$_i18n["savechange"]?>" name="save"
			class="mainbutton" onclick="clear_isset_monitoring();" type="submit">
		<input value="<?=$_i18n["cancel"]?>" class="cancel"
			onclick="clear_isset_monitoring(); go('./admin_viewponencia.php?pid=<?=$pid?>');"
			name="Button" type="button"></td>
	</tr>
</table>
</form>
</div>
<?php include("./includes/foot.php");?>

</body>
</html>
