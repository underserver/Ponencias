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
include_once "./includes/utils.php";
//if( $isadmin != 1 ) header( "Location: ./login.php" );

$pid = $_GET["pid"];
if( !isset($pid) )
  header( "Location: ./admin_ponencias.php" );
  
$sselected = 3; $subtitle = "Mis ponencias"; $selected = 2;

$items[ 0 ] = "Mis ponencias";
$links[ 0 ] = "admin_ponencias.php";

$items[ 1 ] = "Nueva ponencia";
$links[ 1 ] = "admin_newponencia.php";

$items[ 2 ] = "Ver ponencia";
$links[ 2 ] = "#";
include("includes/header.php");

$ponencias = $db->get_results("select ponencias.*, usuarios.* from ponencias, usuarios where usuarios.usuario_id=ponencias.usuario_id and usuarios.usuario_id=".$_SESSION["user_id"] . " and ponencias.ponencia_id=".base64_decode($pid)." order by ponencias.ponencia_fecha");
?>

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
<form action="#" method="post"
	id="settings" enctype="multipart/form-data">
	<input type="hidden" name="at" value="7cf0ac816f615996-1128ad98933">
<table>
	<tr>
		<th>Titulo:</th>
		<td><span class="details"> <?=$ponencias[0]->ponencia_titulo?></span></span></td>
	</tr>
	<tr>
		<th>Fecha de presentaci&oacute;n:</th>
		<td><span class="details"> <?=$ponencias[0]->ponencia_fecha?></span></td>
	</tr>
	<tr>
		<th>Eje Tematico:</th>
		<td><span class="details"><?=$ponencias[0]->ponencia_ejetematico?></span></td>
	</tr>
	<tr>
		<th>Estado:</th>
		<td><span class="details"><?=spanStatus($ponencias[0]->ponencia_estado)?></span></td>
	</tr>
	<tr>
		<th>Resumen:</th>
		<td><span class="details"><?=$ponencias[0]->ponencia_resumen?></span></td>
	</tr>
	<tr>
		<th>Archivo <b>con</b> nombres:</th>
		<td><span class="details"><?=$ponencias[0]->ponencia_archivo1?></span></td>
	</tr>
	<tr>
		<th>Archivo <b>sin</b> nombres:</th>
		<td><span class="details"><?=$ponencias[0]->ponencia_archivo2?></span></td>
	</tr>
	<tr>
		<th>Sala:</th>
		<td><span class="details"><?=$ponencias[0]->ponencia_sala?></span></td>
	</tr>
	<tr>
		<th>Hora:</th>
		<td><span class="details"><?=$ponencias[0]->ponencia_hora?></span></td>
	</tr>
	<tr>
		<th>Observaciones:</th>
		<td><span class="details"><?=$ponencias[0]->ponencia_observaciones?></span></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><a href="admin_editponencia.php?pid=<?=$pid?>" class="button editponencia">Editar</a></td>
	</tr>
</table>
</form>
</div>
<?php include("./includes/foot.php");?>

</body>
</html>
