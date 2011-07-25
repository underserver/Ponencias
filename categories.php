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

$categories = $db->get_results("select * from categorias");
$catid = isset($_GET["id"]) && $_GET["id"] != "" ? base64_decode( $_GET["id"] ) : 1;
for( $i = 0; $i < count($categories); $i++ ){
	$items[ $i ] = $categories[ $i ]->categoria_nombre;
	$links[ $i ] = "?id=".base64_encode( $categories[ $i ]->categoria_id );
	if( $categories[ $i ]->categoria_id == $catid ) $selected = $i;
}
$sselected = 2; $subtitle = $_i18n["categories.submenu"];
include("includes/header.php");
?>

<div id="dash_1"><?php
$productos = $db->get_results("select * from articulos where categoria_id=".$catid." and articulo_cantidad > 0 and articulo_expira>='".date("y/m/d")."'");
?>
<div id="dash1">
<table>
	<tbody>
		<tr>
		<?php for( $i=0; $i < (count( $productos ) < 5 ? count( $productos ) : 5 ); $i++ ){ ?>
			<td class="articleimage" align="center"><img
				src="images/<?=$productos[$i]->articulo_imagen ?>"></td>
			<td class="shopimage"><img src="images/comprar.gif" class="link"
				onclick="buyArticle('<?=$productos[$i]->articulo_nombre ?>','addproduct.php?id=<?=base64_encode($productos[$i]->articulo_id)?>');">
			</td>
			<td class="articlespace"></td>
			<?php } ?>
		</tr>
		<tr>
		<?php for( $i=0; $i < (count( $productos ) < 5 ? count( $productos ) : 5 ); $i++ ){ ?>
			<td colspan="2" class="tablefooter" valign="top" id="description"><a
				href="#"
				onclick="displayArticle( 'product.php?id=<?=base64_encode($productos[$i]->articulo_id)?>' );return false"><b><?=$productos[$i]->articulo_nombre ?></b></a><br>
				<?=$productos[$i]->articulo_descripcion ?><br>
			<span class="price"><?=$_i18n["price"]?> <?=$productos[$i]->articulo_precio ?></span>

			</td>
			<td class="articlespace"></td>
			<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<div class="spacer"></div>
</div>
<div id="dash_2">
<div id="dash1">
<table>
	<tbody>
		<tr>
		<?php for( $i=5; $i < (count( $productos ) < 10 ? count( $productos ) : 10 ); $i++ ){ ?>
			<td class="articleimage" align="center"><img
				src="images/<?=$productos[$i]->articulo_imagen ?>"></td>
			<td class="shopimage"><img src="images/comprar.gif" class="link"
				onclick="buyArticle('<?=$productos[$i]->articulo_nombre ?>','addproduct.php?id=<?=base64_encode($productos[$i]->articulo_id)?>');">
			</td>
			<td class="articlespace"></td>
			<?php } ?>
		</tr>
		<tr>
		<?php for( $i=5; $i < (count( $productos ) < 10 ? count( $productos ) : 10 ); $i++ ){ ?>
			<td colspan="2" class="tablefooter" valign="top" id="description"><a
				href="#"
				onclick="displayArticle( 'product.php?id=<?=base64_encode($productos[$i]->articulo_id)?>' );return false"><b><?=$productos[$i]->articulo_nombre ?></b></a><br>
				<?=$productos[$i]->articulo_descripcion ?><br>
			<span class="price"><?=$_i18n["price"]?> <?=$productos[$i]->articulo_precio ?></span>
			</td>
			<td class="articlespace"></td>
			<?php } ?>
		</tr>
	</tbody>
</table>
</div>
</div>

<form action="Users" id="list" method="post">
<table>
	<tr>
		<th colspan="3" class="tablebar"><?=$_i18n["products"]?></th>
		<th colspan="3" class="tablebar">
		<ul class="inlinelist">
			<li><b>10 - <?=count( $productos )?> of <?=count( $productos )?></b>
			</li>
		</ul>
		</th>
	</tr>
	<tr>

		<th id="header" style="width: 5%;"><?=$_i18n["action"]?></th>
		<th id="header" style="width: 34.5%;"><?=$_i18n["name"]?></th>
		<th id="header" style="width: 38%;"><?=$_i18n["description"]?></th>
		<th id="header" style="width: 10%;"><?=$_i18n["date"]?></th>
		<th id="header" style="width: 11.5%;"><?=$_i18n["price"]?></th>
	</tr>
</table>
<div id="contentscroll">
<table>
<?php for( $i=10; $i < count( $productos ) ; $i++ ){ ?>
	<tr class="">
		<td></td>
		<td style="width: 4%;"><img src="images/icon.buy.gif" class="icon"
			onclick="buyArticle('<?=$productos[$i]->articulo_nombre?>','addproduct.php?id=<?=base64_encode($productos[$i]->articulo_id)?>');"
			title="<?=$_i18n["cotize"]?>" alt="<?=$_i18n["cotize"]?>"></td>
		<td style="width: 34.5%;"><a href="javascript:void(0)"
			onclick="displayArticle( 'product.php?id=<?=base64_encode($productos[$i]->articulo_id)?>' );return false"><?=$productos[$i]->articulo_nombre?></a></td>
		<td style="width: 38%;"><?=$productos[$i]->articulo_descripcion?></td>
		<td style="width: 10%;"><?=$productos[$i]->articulo_fecha?></td>
		<td style="width: 11.5%;"><?=$productos[$i]->articulo_precio?></td>
	</tr>
	<?php } ?>
</table>
</div>
<table>
	<tr>
		<th colspan="3" class="tablebar"><?=$_i18n["products"]?></th>
		<th colspan="3" class="tablebar">
		<ul class="inlinelist">
			<li><b>10 - <?=count( $productos )?> of <?=count( $productos )?></b>
			</li>
		</ul>
		</th>
	</tr>
</table>
</form>
	<?php include("includes/foot.php");?>
</body>
</html>
