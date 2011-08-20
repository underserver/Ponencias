<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Categorias de venta
 *
***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
include_once "./includes/db.php";

$catid = isset($_GET["id"]) && $_GET["id"] != "" ? base64_decode( $_GET["id"] ) : 1;

$items[ 0 ] = $_i18n["all"];
$links[ 0 ] = "";
$selected = $i;

$sselected = 2; $subtitle = $_i18n["ponencias"];
include("includes/header.php");
?>

<div id="content">
<?php
$ponencias = $db->get_results("select ponencias.*, usuarios.* from ponencias, usuarios where usuarios.usuario_id=ponencias.usuario_id");
?>

<div class="spacer"></div>

<form action="Users" id="list" method="post">
<table>
	<tr>
		<th colspan="3" class="tablebar"></th>
		<th colspan="3" class="tablebar">
		<ul class="inlinelist">
			<li><b>10 - <?=count( $ponencias )?> of <?=count( $ponencias )?></b>
			</li>
		</ul>
		</th>
	</tr>
	<tr>
		<th id="header" style="width: 5%;"><?=$_i18n["id"]?></th>
		<th id="header" style="width: 30%;"><?=$_i18n["name"]?></th>
		<th id="header" style="width: 30%;"><?=$_i18n["author"]?></th>
		<th id="header" style="width: 20%;"><?=$_i18n["date"]?></th>
		<th id="header" style="width: 11.5%;"><?=$_i18n["status"]?></th>
	</tr>
</table>
<div id="contentscroll">
<table>
<?php for( $i=0; $i < count( $ponencias ) ; $i++ ){ ?>
	<tr class="">
		<td style="width: 5%;"><?=$ponencias[$i]->ponencia_id?></td>
		<td style="width: 30%;"><a href="javascript:void(0)"><?=$ponencias[$i]->ponencia_titulo?></a></td>
		<td style="width: 30%;"><?=$ponencias[$i]->usuario_nombre?></td>
		<td style="width: 20%;"><?=$ponencias[$i]->ponencia_fecha?></td>
		<td style="width: 11.5%;"><?=$ponencias[$i]->ponencia_estado?></td>
	</tr>
	<?php } ?>
</table>
</div>
<table>
	<tr>
		<th colspan="3" class="tablebar"></th>
		<th colspan="3" class="tablebar">
		<ul class="inlinelist">
			<li><b>10 - <?=count( $ponencias )?> of <?=count( $ponencias )?></b>
			</li>
		</ul>
		</th>
	</tr>
</table>
</form>
</div>
	<?php include("includes/foot.php");?>
</body>
</html>
