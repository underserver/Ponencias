<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Lista de productos a la venta, panel de administracion general de productos
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
include_once "./includes/utils.php";
if( $isadmin != 1 )
header( "Location: ./login.php" );

$sselected = 3; $subtitle = $_i18n["admin.forsale"];$selected = 2;
$items = array( $_i18n["menu1"], $_i18n["admin.onhold"], $_i18n["admin.forsale"], $_i18n["categories.submenu"], $_i18n[ "admin.users" ], $_i18n[ "newproduct" ], $_i18n[ "newcategory" ]  );
$links = array( "./adminpanel.php", "./adminpanel_sales.php", "./adminpanel_products.php","./adminpanel_categories.php", "./adminpanel_users.php", "./adminpanel_newproduct.php", "./adminpanel_newcategory.php" );
include("includes/header.php");

if( isset($_GET["cat"]) )
$sql = "select * from articulos where categoria_id=".base64_decode($_GET["cat"]);
else
$sql = "select * from articulos";
$products = $db->get_results( $sql );
?>
<div id="content">
<ul class="inlinelist">
	<li class="main1"><a href="#"
		onclick="go('./adminpanel_newproduct.php')"><?=$_i18n[ "admin.addproducts" ]?></a></li>
	<li><a href="./adminpanel.php"><?=$_i18n["admin.continue"]?></a></li>
	<li><a href="./adminpanel_categories.php"><?=$_i18n[ "viewcategory" ]?></a></li>
</ul>
<p><?=$_i18n["products.info"]?></p>
</div>

<?php if( isset( $_GET[ "id" ] ) ){ ?>
<div align="center" class="msg">
<div class="bl3">
<div class="br">
<div class="tl">
<div class="tr2">
<?=$_i18n[ "productse".base64_decode( $_GET[ "id" ] ) ]?>
</div>
</div>
</div>
</div>
</div>
<?php } ?>

<form action="Users" name="deleteItems" id="list" method="post">
<table>
	<tr>
		<th colspan="3" class="tablebar"><input disabled="disabled"
			value="<?=$_i18n["delete"]?>" id="deleteT"
			onclick="return deleteArticleAdmin(deleteItems, './adminpanel_deleteproduct.php');"
			type="button"></th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li><b>0 - <?=count( $products )?> of <?=count( $products )?></b></li>
		</ul>
		</th>
	</tr>
	<tr>
		<th id="header"></th>
		<th id="header"><input value="" name="select_all"
			onclick="cbTbl.selectAll(this); updateDeleteButtons(this);"
			type="checkbox"></th>
		<th id="header"><?=$_i18n["name"]?></th>
		<th id="header"><?=$_i18n["price"]?></th>
		<th id="header"><?=$_i18n["description"]?></th>
		<th id="header"><?=$_i18n["date"]?></th>
		<th id="header"><?=$_i18n["expire"]?></th>
	</tr>

	<?php if( count($products) != 0 ){ ?>
	<?php $i=0; foreach( $products as $product ){ ?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_<?=$i?>">
		<td></td>
		<td><input value="true"
			name="COLLECTION_SELECTION_<?=$i?>.<?=base64_encode($product->articulo_id)?>"
			onclick="cbTbl.selectOne(this); updateDeleteButtons(this);"
			type="checkbox"></td>
		<td><a href="javascript:void(0)"
			onclick="go( './adminpanel_editproduct.php?pid=<?=base64_encode($product->articulo_id)?>' );return false"><?=$product->articulo_nombre?></a></td>
		<td><?=$product->articulo_precio?></td>
		<td><?=$product->articulo_descripcion?></td>
		<td><?=$product->articulo_fecha?></td>
		<td><?php if( diffdates($product->articulo_expira, date("Y/m/d")) < 0 )
		echo $_i18n["expired1"];
		else if( $product->articulo_cantidad <= 0 )
		echo $_i18n["agotado1"];
		else
		echo $product->articulo_expira;
		?></td>
	</tr>
	<?php $i++;} ?>
	<?php }else{ ?>
	<tr class="">
		<td colspan="7" align="center"><em><?=$_i18n["notfound"]?></em></td>

	</tr>
	<?php } ?>

	<tr>
		<th colspan="3" class="tablebar"><input disabled="disabled"
			value="<?=$_i18n["delete"]?>" id="deleteB"
			onclick="return deleteArticleAdmin(deleteItems, './adminpanel_deleteproduct.php');"
			type="button"></th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li><b>0 - <?=count( $products )?> of <?=count( $products )?></b></li>
		</ul>
		</th>
	</tr>
</table>
</form>
	<?php include("./includes/foot.php");?>
</body>
</html>
