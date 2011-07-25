<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Lista de ventas pendientes o procesadas
 *
***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
if( $isadmin != 1 ) header( "Location: ./login.php" );

$p = isset($_GET[ "p" ]) ? $_GET[ "p" ] : 1 ;
$sselected = 3; $subtitle = $p==1 ? $_i18n["admin.onhold"] : $_i18n["admin.salesp"] ;$selected = 1;
$items = array( $_i18n["menu1"], $p==1 ? $_i18n["admin.onhold"] : $_i18n["admin.salesp"], $_i18n["admin.forsale"], $_i18n["categories.submenu"], $_i18n[ "admin.users" ], $_i18n[ "newproduct" ], $_i18n[ "newcategory" ]  );
$links = array( "./adminpanel.php", "./adminpanel_sales.php", "./adminpanel_products.php","./adminpanel_categories.php", "./adminpanel_users.php", "./adminpanel_newproduct.php", "./adminpanel_newcategory.php" );
include("includes/header.php");
?>

<div id="content">
<ul class="inlinelist">
	<li class="main1"><?php if( $p==1 ){?> <a href="#"
		onclick="document.getElementById('list').submit();"><?=$_i18n["admin.processall"]?></a></li>
		<?php }else{?>
	<b><?=$_i18n["admin.processall"]?></b>
	</li>
	<?php }?>
	<li><a href="./adminpanel.php"><?=$_i18n["admin.continue"]?></a></li>
	<li><?php if( $p==1 ){?> <a href="./adminpanel_sales.php?p=2"><?=$_i18n["admin.salesp"]?></a>
	<?php }else{?> <a href="./adminpanel_sales.php?p=1"><?=$_i18n["admin.onhold"]?></a>
	<?php }?></li>
</ul>
<p><?=$_i18n["processall.info"]?></p>
</div>

	<?php if( isset( $_GET[ "id" ] ) ){ ?>
<div align="center" class="msg">
<div class="bl3">
<div class="br">
<div class="tl">
<div class="tr2">
<?=$_i18n[ "salese".base64_decode( $_GET[ "id" ] ) ]?>
</div>
</div>
</div>
</div>
</div>
	<?php } ?>

	<?php
	$productos = $db->get_results("select count(*) as number, usuario_id, compra_estado, compra_fecha, compra_numero from compras where compra_estado=$p group by compra_numero");
	?>
<form id="list" name="deleteItems" action="adminpanel_process.php?all"
	method="post">
<table>
	<tr>
		<th colspan="3" class="tablebar"><input disabled="disabled"
			value="<?=$_i18n["admin.deletesales"]?>" id="deleteB"
			onclick="return deleteSale(deleteItems, './adminpanel_deletesale.php?type=<?=base64_encode(0)?>');"
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
		<th id="header" style="width: 3%"><input value="" name="select_all"
			onclick="cbTbl.selectAll(this); updateDeleteButtons(this);"
			type="checkbox"></th>
		<th id="header" style="width: 30%"><?=$_i18n["user"]?></th>
		<th id="header"><?=$_i18n["sales.articles"]?></th>
		<th id="header"><?=$_i18n["date"]?></th>
		<th id="header"><?=$_i18n["sales.state"]?></th>
		<th id="header"><?=$_i18n["sales.totalprice"]?></th>
	</tr>
	<?php for( $i = 0; $i < count($productos); $i++){
		$totalprice = $db->get_var("select sum(articulo_precio) from articulos, compras where articulos.articulo_id=compras.articulo_id and  compras.usuario_id=".$productos[$i]->usuario_id." and compras.compra_estado=$p and compra_numero=".$productos[$i]->compra_numero);
		$username = $db->get_var("select usuario_nombre from usuarios where usuario_id=".$productos[$i]->usuario_id);
		?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_<?=$i?>">
		<td></td>
		<td><input value="true"
			name="COLLECTION_SELECTION_<?=$i?>.<?=base64_encode($productos[$i]->compra_numero)?>"
			onclick="cbTbl.selectOne(this); updateDeleteButtons(this);"
			type="checkbox"></td>
		<td><a href="javascript:void(0)"
			onclick="go( 'adminpanel_sale.php?cid=<?=base64_encode($productos[$i]->compra_numero)?>&pid=<?=base64_encode($p)?>' );return false"><?=$username?></a></td>
		<td><?=$productos[$i]->number?></td>
		<td><?=$productos[$i]->compra_fecha?></td>
		<td><?=$productos[$i]->compra_estado?></td>
		<td><?=$totalprice?></td>
	</tr>
	<?php
}
if( $i == 0 ){
	?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_0">
		<td colspan="7" align="center"><em><?=$_i18n["admin.noexistsales"]?></em></td>
	</tr>
	<?php } ?>

	<tr>
		<th colspan="3" class="tablebar"><input disabled="disabled"
			value="<?=$_i18n["admin.deletesales"]?>" id="deleteT"
			onclick="return deleteSale(deleteItems, './adminpanel_deletesale.php?type=<?=base64_encode(0)?>');"
			type="button"></th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li id="count"><b>1 - <?=count( $productos )?> de <?=count( $productos )?></b>
			</li>
		</ul>

		</th>
	</tr>

</table>
</form>
</div>

	<?php include("./includes/foot.php");?>
</body>
</html>
