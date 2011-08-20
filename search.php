<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Muestra los resultados de una busqueda
 * 			 q		: Obligatorio (consulta)
 *
 ***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";

$_validator = new Validator();
$_validator->setMethod( "GET" );
$_validator->setVars( array( "q:required" ) );

if( $_validator->validate() )
$values = $_validator->getValues();
else
header( "Location: ./" );

$q = $values[ "q" ];

$sselected = 0; $subtitle = $_i18n["search.submenu"]."<i>$q</i>";
include("includes/header.php");
?>

<?php
$sql = "select * from articulos where (articulo_nombre like '%$q%' or articulo_descripcion like '%$q%') and articulo_cantidad > 0 and articulo_expira>='".date("y/m/d")."'";
$products = $db->get_results( $sql );
?>

<form action="Users" id="list" method="post">
<table>
	<tr>
		<th colspan="3" class="tablebar">Productos</th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li><b>0 - <?=count( $products )?> of <?=count( $products )?></b></li>
		</ul>
		</th>
	</tr>
	<tr>
		<th id="header"></th>
		<th id="header"><?=$_i18n["action"]?></th>
		<th id="header"><?=$_i18n["name"]?></th>
		<th id="header"><?=$_i18n["price"]?></th>
		<th id="header"><?=$_i18n["description"]?></th>
		<th id="header"><?=$_i18n["date"]?></th>
		<th id="header"><?=$_i18n["expire"]?></th>
	</tr>

	<?php if( count($products) != 0 ){ ?>
	<?php foreach( $products as $product ){ ?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_0">
		<td></td>
		<td><img src="images/icon.buy.gif" class="icon"
			onclick="buyArticle('<?=$product->articulo_nombre?>','addproduct.php?id=<?=base64_encode($product->articulo_id)?>');"
			title="<?=$_i18n["buy"]?>" alt="<?=$_i18n["buy"]?>"></td>
		<td><a href="javascript:void(0)"
			onclick="displayArticle( './product.php?id=<?=base64_encode($product->articulo_id)?>' );return false"><?=$product->articulo_nombre?></a></td>
		<td><?=$product->articulo_precio?></td>
		<td><?=$product->articulo_descripcion?></td>
		<td><?=$product->articulo_fecha?></td>
		<td><?=$product->articulo_expira?></td>
	</tr>
	<?php } ?>
	<?php }else{ ?>
	<tr class="">
		<td colspan="7" align="center"><em><?=$_i18n["notfound"]?></em></td>

	</tr>
	<?php } ?>

	<tr>
		<th colspan="3" class="tablebar">Productos</th>
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
