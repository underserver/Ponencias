<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Panel de administracion para las categorias
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
if( $isadmin != 1 )
header( "Location: ./login.php" );

$sselected = 3; $subtitle = $_i18n["categories.submenu"];$selected = 3;
$items = array( $_i18n["menu1"], $_i18n["admin.onhold"], $_i18n["admin.forsale"], $_i18n["categories.submenu"], $_i18n[ "admin.users" ], $_i18n[ "newproduct" ], $_i18n[ "newcategory" ]  );
$links = array( "./adminpanel.php", "./adminpanel_sales.php", "./adminpanel_products.php","./adminpanel_categories.php", "./adminpanel_users.php", "./adminpanel_newproduct.php", "./adminpanel_newcategory.php" );
include("includes/header.php");

$sql = "select * from categorias where categoria_id <> 0";

$categories = $db->get_results( $sql );
?>
<div id="content">
<ul class="inlinelist">
	<li class="main1"><a href="#"
		onclick="go('./adminpanel_newcategory.php')"><?=$_i18n[ "newcategory" ]?></a></li>
	<li><a href="./adminpanel.php"><?=$_i18n["admin.continue"]?></a></li>
	<li><a href="./adminpanel_products.php"><?=$_i18n[ "viewallarticles" ]?></a></li>
</ul>
<p><?=$_i18n["categories.info"]?></p>
</div>

<?php if( isset( $_GET[ "id" ] ) ){ ?>
<div align="center" class="msg">
<div class="bl3">
<div class="br">
<div class="tl">
<div class="tr2"><?=$_i18n[ "categoriese".base64_decode( $_GET[ "id" ] ) ]?>
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
			value="<?=$_i18n["deletecat"]?>" id="deleteT"
			onclick="return deleteCategory(deleteItems, './adminpanel_deletecategory.php');"
			type="button"></th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li><b>0 - <?=count( $categories )?> of <?=count( $categories )?></b>
			</li>
		</ul>
		</th>
	</tr>
	<tr>
		<th id="header"></th>
		<th id="header" style="width: 3%"><input value="" name="select_all"
			onclick="cbTbl.selectAll(this); updateDeleteButtons(this);"
			type="checkbox"></th>
		<th id="header" style="width: 30%"><?=$_i18n["name"]?></th>
		<th id="header"><?=$_i18n["count"]?></th>
		<th id="header"><?=$_i18n["description"]?></th>
		<th id="header"><?=$_i18n["date"]?></th>
		<th id="header"><?=$_i18n["edit"]?></th>
	</tr>

	<?php if( count($categories) != 0 ){ ?>
	<?php $i=0; foreach( $categories as $cat ){
		$count = $db->get_var( "select count(*) from articulos where categoria_id=".$cat->categoria_id );
		?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_<?=$i?>">
		<td></td>
		<td><input value="true"
			name="COLLECTION_SELECTION_<?=$i?>.<?=base64_encode($cat->categoria_id)?>"
			onclick="cbTbl.selectOne(this); updateDeleteButtons(this);"
			type="checkbox"></td>
		<td><a href="javascript:void(0)"
			onclick="go( './adminpanel_products.php?cat=<?=base64_encode($cat->categoria_id)?>' );return false"><?=$cat->categoria_nombre?></a></td>
		<td><?=$count?></td>
		<td><?=$cat->categoria_descripcion?></td>
		<td><?=$cat->categoria_fecha?></td>
		<td><img src="./images/edit.gif" style="cursor: pointer"
			onclick="go('./adminpanel_editcategory.php?cid=<?=base64_encode($cat->categoria_id)?>');"></td>
	</tr>
	<?php $i++;} ?>
	<?php }else{ ?>
	<tr class="">
		<td colspan="7" align="center"><em><?=$_i18n["notfound"]?></em></td>

	</tr>
	<?php } ?>

	<tr>
		<th colspan="3" class="tablebar"><input disabled="disabled"
			value="<?=$_i18n["deletecat"]?>" id="deleteB"
			onclick="return deleteCategory(deleteItems, './adminpanel_deletecategory.php');"
			type="button"></th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li><b>0 - <?=count( $categories )?> of <?=count( $categories )?></b>
			</li>
		</ul>
		</th>
	</tr>
</table>
</form>
	<?php include("./includes/foot.php");?>
</body>
</html>
