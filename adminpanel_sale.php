<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Lista de los productos de una venta pendiente o procesadas
 * 			 cid	: Obligatorio (numero de compra)
 * 			 pid	: Obligatorio (tipo de venta)
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
$_validator->setVars( array( "cid:required", "pid:required" ) );

if( $_validator->validate() ){
	$values = $_validator->getValues();
}else{
	header( "Location: ./adminpanel_sales.php" );
}

$sselected = 3; $subtitle = $_i18n["sale"];$selected = -1;
$items = array( $_i18n["menu1"], $_i18n["admin.onhold"], $_i18n["admin.forsale"], $_i18n["categories.submenu"], $_i18n[ "admin.users" ], $_i18n[ "newproduct" ], $_i18n[ "newcategory" ]  );
$links = array( "./adminpanel.php", "./adminpanel_sales.php", "./adminpanel_products.php","./adminpanel_categories.php", "./adminpanel_users.php", "./adminpanel_newproduct.php", "./adminpanel_newcategory.php" );
include("includes/header.php");$_validator = new Validator();
?>

<div id="content">
<ul class="inlinelist">
	<li class="main1"><?php if( base64_decode($values["pid"]) == 1 ){?> <a
		href="#" onclick="document.getElementById('list').submit();"><?=$_i18n["admin.processsale"]?></a>
		<?php }else{?> <?=$_i18n["admin.processsale"]?> <?php }?></li>
	<li class="main1"><a
		href="adminpanel_deletesale.php?sale=<?=$values["cid"]?>&type=<?=base64_encode("1")?>"><?=$_i18n["admin.deletesale"]?></a></li>
	<li><a href="./adminpanel_sales.php?p=2"><?=$_i18n["admin.salesp"]?></a></li>
	<li><a href="./adminpanel_sales.php?p=1"><?=$_i18n["admin.onhold"]?></a></li>
</ul>
<p><?=$_i18n["info1"]?></p>
</div>

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

<div id="dash_2">
<div id="dash1">
<?php
$user = $db->get_row( "select usuarios.* from usuarios, compras where usuarios.usuario_id=compras.usuario_id and compras.compra_numero=".base64_decode($values["cid"]) );
?>
<table>
	<tbody>
		<tr>
			<th style="background-color:#ddd;font-size:11px" colspan="2">
				&nbsp;<?=$_i18n["menu44"]?>
			</th>
		</tr>
		<tr>
			<td class="tablefooter" valign="top" id="description">
				<b class='titulo'><?=$_i18n["name"]?></b> : <?=$user->pago_nombre?>
			</td>
			<td class="tablefooter" valign="top" id="description">
				<b class='titulo'><?=$_i18n["phone"]?></b> : <?=$user->pago_telefono?>
			</td>
		</tr>
		<tr>
			<td class="tablefooter" valign="top" id="description">
				<b class='titulo'><?=$_i18n["creditcard"]?></b> : <?=base64_decode($user->usuario_tcredito)?>
			</td>
			<td class="tablefooter" valign="top" id="description">
				<b class='titulo'><?=$_i18n["address"]?></b> : <?=$user->pago_direccion?>
			</td>
		</tr>
	</tbody>
</table>
</div>
</div>


<?php
$productos = $db->get_results("select * from compras where compra_numero=".base64_decode($values["cid"])." and compra_estado=".base64_decode($values["pid"]));
?>
<form id="list" name="deleteItems"
	action="adminpanel_process.php?sale=<?=base64_decode($values["cid"])?>"
	method="post">
<table>
	<tr>
		<th colspan="3" class="tablebar"><input disabled="disabled"
			value="<?=$_i18n["delete"]?>" id="deleteB"
			onclick="return deleteArticleAdmin(deleteItems, './adminpanel_delete.php');"
			type="button"></th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li id="count2"><b>1 - <?=count( $productos )?> de <?=count( $productos )?></b>
			</li>
		</ul>
		</th>
	</tr>
	<tr>
		<th id="header"></th>
		<th id="header"><input value="" name="select_all"
			onclick="cbTbl.selectAll(this); updateDeleteButtons(this);"
			type="checkbox"></th>
		<th id="header"><?=$_i18n["name"]?></th>
		<th id="header"><?=$_i18n["description"]?></th>
		<th id="header"><?=$_i18n["date"]?></th>
		<th id="header"><?=$_i18n["expire"]?></th>
		<th id="header" style="width: 5%" align="right"><?=$_i18n["price"]?></th>
	</tr>
	<?php for( $i = 0, $subtotal = 0; $i < count($productos); $i++){
		$producto = $db->get_row("select * from articulos where articulo_id=".$productos[$i]->articulo_id);
		?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_<?=$i?>">
		<td></td>
		<td><input value="true"
			name="COLLECTION_SELECTION_<?=$i?>.<?=base64_encode($productos[$i]->compra_id)?>"
			onclick="cbTbl.selectOne(this); updateDeleteButtons(this);"
			type="checkbox"></td>
		<td><a href="javascript:void(0)"
			onclick="displayArticle( 'product.php?id=<?=base64_encode($producto->articulo_id)?>' );return false"><?=$producto->articulo_nombre?></a></td>
		<td><?=$producto->articulo_descripcion?></td>
		<td><?=$producto->articulo_fecha?></td>
		<td><?=$producto->articulo_expira?></td>
		<td><?=$producto->articulo_precio?></td>
	</tr>
	<?php
	$subtotal += $producto->articulo_precio;
}
if( $i == 0 ){
	?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_0">
		<td colspan="7" align="center"><em>No existe ningun articulo en su
		carrito</em></td>
	</tr>
	<?php } ?>

	<tr>
		<th colspan="3" class="tablebar"><input disabled="disabled"
			value="<?=$_i18n["delete"]?>" id="deleteT"
			onclick="return deleteArticleAdmin(deleteItems, './adminpanel_delete.php');"
			type="button"></th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li id="count"><b>1 - <?=count( $productos )?> de <?=count( $productos )?></b>
			</li>
		</ul>

		</th>
	</tr>
	<tr>
		<th colspan="5" class="tablebar1"></th>
		<th colspan="1" class="tablebar1"><b><?=$_i18n["subtotal"]?> </b></th>
		<th colspan="1" class="total" id="sub">$<?=$subtotal?></th>
	</tr>
	<tr>
		<th colspan="5" class="tablebar1"></th>
		<th colspan="1" class="tablebar1"><b><?=$_i18n["iva"]?>: </b></th>
		<th colspan="1" class="total" id="iva"><?=$subtotal * $_config["iva"]?>
		</th>
	</tr>
	<tr>
		<th colspan="5" class="tablebar1"></th>
		<th colspan="1" class="tablebar1"><b><?=$_i18n["total"]?>: </b></th>
		<th colspan="1" class="total" id="total">$<?=$subtotal + ( $subtotal*$_config["iva"] )?>
		</th>
	</tr>
</table>
</form>
</div>

	<?php include("includes/foot.php");?>
</body>
</html>
