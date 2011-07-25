<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Elimina un producto de una venta pendiente o procesada
 * 			 id : Obligatorio (id del producto)
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

if( $_validator->validate() ){
	$values = $_validator->getValues();
	if( $isadmin == 1){
		// Aumentamos el producto eliminado a la cantidad de articulos
		$pid = $db->get_var("select articulo_id from compras where compra_id=".base64_decode($values["id"])." and (compra_estado=1 or compra_estado=2)");
		$db->query("update articulos set articulo_cantidad=articulo_cantidad+1 where articulo_id=$pid");

		$db->query("delete from compras where compra_id=".base64_decode($values["id"])." and (compra_estado=1 or compra_estado=2)");
		echo "1";
	}else{
		echo "0";
	}
}

?>