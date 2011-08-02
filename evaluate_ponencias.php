<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Lista de productos comprados por un usuario
 *
***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
include_once "./includes/utils.php";
if( $login != 1 ) header( "Location: ./login.php" );

$sselected = 3; $subtitle = "Evaluar ponencias";

$items[ 0 ] = "Pendientes";
$links[ 0 ] = "evaluate_ponencias.php";

$items[ 1 ] = "Todas";
$links[ 1 ] = "evaluate_ponencias.php?all";

include("includes/header.php");

?>

<div id="content">
<ul class="inlinelist">
	<li class="main1"><a href="#"
		onclick="document.location='admin_newponencia.php'">Nueva ponencia</a></li>
	<li><a href="./">Ver otras ponencias</a></li>
</ul>
<p>Debe estar registrado como ponente o autor para crear una nueva ponencia</p>


<?php if( isset( $_GET[ "id" ] ) ){ ?>
<div align="center" class="msg">
<div class="bl3">
<div class="br">
<div class="tl">
<div class="tr2"><?php if ( base64_decode( $_GET[ "id" ] ) == "0" ){ ?>
<?=$_i18n[ "processe".base64_decode( $_GET[ "id" ] ) ]?> <?php }else{?>
<?=$_i18n[ "processe".base64_decode( $_GET[ "id" ] ) ]?> <?php }?></div>
</div>
</div>
</div>
</div>
<?php } ?>

<?php
$sql  = "select ponencias.* ";
$sql .= "from ponencias, ponencias_evaluadores ";
$sql .= "where ponencias_evaluadores.evaluador_id=".$_SESSION["user_id"];
$sql .= "  and ponencias.ponencia_id=ponencias_evaluadores.ponencia_id and ponencias.ponencia_estado=2 ";
$sql .= "order by ponencias.ponencia_fecha";
                                
$ponencias = $db->get_results($sql);                       
?>
<form id="list" name="deleteItems" action="action_process.php"
	method="post">
<table>
	<tr>
		<th colspan="3" class="tablebar"></th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li id="count2"><b>1 - <?=count( $ponencias )?> de <?=count( $ponencias )?></b>
			</li>
		</ul>
		</th>
	</tr>
	<tr>
		<th id="header" style="text-align: center"><?=$_i18n["id"]?></th>
		<th id="header"><input value="" name="select_all"
			onclick="cbTbl.selectAll(this); updateDeleteButtons(this);"
			type="checkbox"></th>
		<th id="header">Titulo</th>
		<th id="header"><?=$_i18n["date"]?></th>
		<th id="header">Eje tematico</th>
		<th id="header">Acción</th>
	</tr>
	<?php for( $i = 0, $subtotal = 0; $i < count($ponencias); $i++){
		?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_<?=$i?>">
		<td style="width: 30px;text-align: center"><?=$ponencias[$i]->ponencia_id?></td>
		<td style="width: 40px"><input value="true"
			name="COLLECTION_SELECTION_<?=$i?>.<?=base64_encode($ponencias[$i]->ponencia_id)?>"
			onclick="cbTbl.selectOne(this); updateDeleteButtons(this);"
			type="checkbox"></td>
		<td><a href="javascript:void(0)"
			onclick="goto( 'admin_viewponencia.php?pid=<?=base64_encode($ponencias[$i]->ponencia_id)?>' );"><?=$ponencias[$i]->ponencia_titulo?></a></td>
		<td><?=$ponencias[$i]->ponencia_fecha?></td>
		<td><?=$ponencias[$i]->ponencia_ejetematico?></td>
		<td style="width: 180px;"><a href="evaluate_ponencia.php?pid=<?=base64_encode($ponencias[$i]->ponencia_id)?>" class="button evaluateponencia">Evaluar</a></td>
	</tr>
	<?php
}
if( $i == 0 ){
	?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_0">
		<td colspan="7" align="center"><em>No tiene ninguna ponencia asiganda para evaluación</em></td>
	</tr>
	<?php } ?>

	<tr>
		<th colspan="3" class="tablebar"></th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li id="count"><b>1 - <?=count( $ponencias )?> de <?=count( $ponencias )?></b>
			</li>
		</ul>

		</th>
	</tr>
</table>
</form>
</div>

</div>
	<?php include("includes/foot.php");?>
</body>
</html>