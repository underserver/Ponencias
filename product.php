<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Mustra la informacion completa de un producto
 * 			 id		: Obligatorio (id del producto)
 *
 ***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/validator.php";

$_validator = new Validator();
$_validator->setMethod( "GET" );
$_validator->setVars( array("id:required") );

if( $_validator->validate() ){
	$values = $_validator->getValues();
	$producto = $db->get_row("select * from articulos where articulo_id=".base64_decode($values["id"]));
	?>
<table>
	<tr>
		<td rowspan="8" class="image"><img
			src="images/<?=$producto->articulo_imagen?>"><br>
		<img src="images/comprarh.gif" class="link"
			onclick="buyArticle('<?=$producto->articulo_nombre?>','addproduct.php?id=<?=base64_encode($producto->articulo_id)?>');">
		</td>
		<td><b><?=$_i18n[ "name" ]?>:</b> <?=$producto->articulo_nombre?></td>
	</tr>
	<tr>
		<td><b><?=$_i18n[ "count" ]?>:</b> <?=$producto->articulo_cantidad?></td>
	</tr>
	<tr>
		<td></td>
	</tr>
	<tr>
		<td><b><?=$_i18n[ "date" ]?>:</b> <?=$producto->articulo_fecha?></td>
	</tr>
	<tr>
		<td><b><?=$_i18n[ "description" ]?>:</b> <?=$producto->articulo_descripcion?></td>
	</tr>
</table>
<br>
<div align="center"><a href="javascript:void(0);"
	onclick="buyArticle('<?=$producto->articulo_nombre?>','addproduct.php?id=<?=base64_encode($producto->articulo_id)?>');messageObj.close();"><b><?=$_i18n[ "closeandbuy" ]?></b></a>
| <a href="javascript:void(0);" onclick="messageObj.close();"><?=$_i18n[ "close" ]?></a></div>
	<?php
}

?>