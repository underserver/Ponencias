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
  
$sselected = 3; $subtitle = "Evaluar ponencias"; $selected = 2;

$items[ 0 ] = "Pendientes";
$links[ 0 ] = "evaluate_ponencias.php";

$items[ 1 ] = "Todas";
$links[ 1 ] = "evaluate_ponencias.php?all";

$items[ 2 ] = "Evaluar ponencia";
$links[ 2 ] = "#";
include("includes/header.php");

$sql  = "select ponencias.* ";
$sql .= "from ponencias, ponencias_evaluadores ";
$sql .= "where ponencias_evaluadores.evaluador_id=".$_SESSION["user_id"];
$sql .= "  and ponencias.ponencia_id=ponencias_evaluadores.ponencia_id";
$sql .= "  and ponencias_evaluadores.ponencia_id=".base64_decode( $pid ). " and ponencias.ponencia_estado=2 ";
$sql .= "order by ponencias.ponencia_fecha";
                                
$ponencias = $db->get_results($sql);    
?>

<div id="content">
<?php if( isset( $_GET[ "id" ] ) ){ ?>
<div align="center" class="msg">
<div class="bl3">
<div class="br">
<div class="tl">
<div class="tr2">
<?=$_i18n[ "st_" . $_GET[ "id" ] ]?>
</div>
</div>
</div>
</div>
</div>
<?php 
}
$fields = " ".base64_decode( $_GET[ "tk" ] );
?>
<form action="action_evaluateponencia.php" method="post"
	id="settings" enctype="multipart/form-data">
	<input type="hidden" name="at" value="7cf0ac816f615996-1128ad98933">
<table>
<tr>
<td valign="top">
<table>
	<tr>
		<th>Titulo:</th>
		<td><span class="details"> <?=$ponencias[0]->ponencia_titulo?></span></span></td>
	</tr>
	<tr>
		<th>Fecha de presentación:</th>
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
		<th>Archivo:</th>
		<td><span class="details"><a href="#" class="button file"><?=$ponencias[0]->ponencia_archivo2?></a></span></td>
	</tr>
	<tr>
		<th>Sala:</th>
		<td><span class="details"><?=$ponencias[0]->ponencia_sala?></span></td>
	</tr>
	<tr>
		<th>Hora:</th>
		<td><span class="details"><?=$ponencias[0]->ponencia_hora?></span></td>
	</tr>
</table>
</td>
<td style="border-left: 1px solid #ccc; padding-left: 30px;padding-right: 100px;" valign="top">
<table>
	<tr>
		<td class="eval">Evaluación:</td>
	</tr>
	<tr>
		<td class="left">Calificación:</td>
	</tr>
	<tr class="<?=( strpos( $fields, 'calif' ) ? "err" : "" )?>">
    <td>
      <span class="radio"><input type="radio" name="calif" value="0" id="rate1"  <?=($ponencias[0]->ponencia_calif==0?"selected":"")?>/> <br>&nbsp;&nbsp;0</span>
      <span class="radio"><input type="radio" name="calif" value="1" id="rate2"  <?=($ponencias[0]->ponencia_calif==1?"selected":"")?> /> <br>&nbsp;&nbsp;1</span>
      <span class="radio"><input type="radio" name="calif" value="2" id="rate3"  <?=($ponencias[0]->ponencia_calif==2?"selected":"")?> /> <br>&nbsp;&nbsp;2</span>
      <span class="radio"><input type="radio" name="calif" value="3" id="rate4"  <?=($ponencias[0]->ponencia_calif==3?"selected":"")?> /> <br>&nbsp;&nbsp;3</span>
      <span class="radio"><input type="radio" name="calif" value="4" id="rate5"  <?=($ponencias[0]->ponencia_calif==4?"selected":"")?> /> <br>&nbsp;&nbsp;4</span>
      <span class="radio"><input type="radio" name="calif" value="5" id="rate1"  <?=($ponencias[0]->ponencia_calif==5?"selected":"")?> /> <br>&nbsp;&nbsp;5</span>
      <span class="radio"><input type="radio" name="calif" value="6" id="rate2"  <?=($ponencias[0]->ponencia_calif==6?"selected":"")?> /> <br>&nbsp;&nbsp;6</span>
      <span class="radio"><input type="radio" name="calif" value="7" id="rate3"  <?=($ponencias[0]->ponencia_calif==7?"selected":"")?> /> <br>&nbsp;&nbsp;7</span>
      <span class="radio"><input type="radio" name="calif" value="8" id="rate4"  <?=($ponencias[0]->ponencia_calif==8?"selected":"")?> /> <br>&nbsp;&nbsp;8</span>
      <span class="radio"><input type="radio" name="calif" value="9" id="rate5"  <?=($ponencias[0]->ponencia_calif==9?"selected":"")?> /> <br>&nbsp;&nbsp;9</span>
      <span class="radio"><input type="radio" name="calif" value="10" id="rate5" <?=($ponencias[0]->ponencia_calif==10?"selected":"")?> /> <br>&nbsp;&nbsp;10</span>
    </td>
	</tr>
	<tr>
		<td class="left">Observaciones:</td>
	</tr>
	<tr>
		<td><textarea name="observaciones" class="rounded" rows="8" cols="60"><?=$ponencias[0]->ponencia_observaciones?></textarea></td>
	</tr>
	<tr>
		<td class="left">Dictamen:</td>
	</tr>
	<tr class="<?=( strpos( $fields, 'dictamen' ) ? "err" : "" )?>">
		<td>
			<input type="file" name="dictamen">
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="hidden" name="pid" value="<?=$_GET["pid"]?>">
			<a href="javascript:document.forms[0].submit();" class="button senddictamen">Enviar dictamen</a>
		</td>
	</tr>
</table>
</td>
</tr>
</table>
</form>
</div>
<?php include("./includes/foot.php");?>

</body>
</html>
