<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Elimina una venta procesada o pendiente de la base de datos
 * 			 sale : Obligatorio (numero de venta)
 * 			 type : Obligatorio (tipo de accion)
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";

$_validator = new Validator();
$_validator->setMethod( "GET" );
$_validator->setVars( array("sale:required","type:required") );

if( $_validator->validate() ){
	$values = $_validator->getValues();
	if( $isadmin == 1){
		// Aumentamos el producto eliminado a la cantidad de articulos
		$pids = $db->get_results("select articulo_id from compras where compra_numero=".base64_decode($values["sale"]) );
		foreach( $pids as $pid  )
		$db->query("update articulos set articulo_cantidad=articulo_cantidad+1 where articulo_id=".$pid->articulo_id);

		$db->query("delete from compras where compra_numero=".base64_decode($values["sale"]));
		if( base64_decode($values["type"])==1 )
		header( "Location: ./adminpanel.php?id=".base64_encode("5") );
		else
		echo "1";
	}else{
		if( base64_decode($values["type"])==1 )
		header( "Location: ./adminpanel.php?id=".base64_encode("6") );
		else
		echo "0";
	}
}

?>