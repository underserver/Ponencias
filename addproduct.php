<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Agrega un producto al carrito de compras
 *           id     : obligatorio (id del producto)
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";

$_validator = new Validator();
$_validator->setMethod( "GET" );
$_validator->setVars( array("id:required") );

if( $_validator->validate() && $login ==1 ){
	$values = $_validator->getValues();
	$id = base64_decode($values["id"] );

	// verficamos si el producto existe o tiene disponibilidad
	$disp = $db->get_var( "select articulo_cantidad from articulos where articulo_id=$id" );
	if( $disp <= 0 ){
		echo $_i18n["notmore"];
		exit(0);
	}
	// si el articulo ya expiro
	$expire = $db->get_results( "select articulo_expira from articulos where articulo_id=$id and articulo_expira>='".date("y/m/d")."'" );
	if( count($expire) <= 0 ){
		echo $_i18n["expired"];
		exit(0);
	}

	// Obtenemos el numero de compra
	$number = $db->get_var( "select compra_numero from compras where usuario_id=".$_SESSION[ "user_id"] ." and compra_estado=0 order by compra_fecha" );
	if( trim($number) == ""  )
	$number = rand();

	// Agregamos el producto a la compra
	$db->query("insert into compras(usuario_id, articulo_id,compra_fecha,compra_activa, compra_numero) values('".$_SESSION["user_id"]."','$id', '".date("y/m/d")."', '1', '".$number."')");
	// Descontamos el producto comprado a la cantidad de articulos
	$db->query("update articulos set articulo_cantidad=articulo_cantidad-1 where articulo_id=$id");
	// Obtenemos las estadisticas actuales
	$productos = $db->get_results("select * from compras where usuario_id=".$_SESSION[ "user_id"] ." and  compra_estado=0");
	$subtotal = 0.0;
	for( $i = 0; $i <count($productos); $i++ ){
		$price = $db->get_var("select articulo_precio from articulos where articulo_id=".$productos[$i]->articulo_id);
		$subtotal += $price;
	}
	echo "<b>".$_i18n[ "products" ].":</b> $i, <b>".$_i18n[ "subtotal" ]."</b> $subtotal";
}else{
	if($login !=1)
	echo $_i18n["login"];
	else
	echo $_i18n["error"];
}

?>