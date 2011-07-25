<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Procesa todos los productos de una compra y la envia a ventas pendientes
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";

if( $login==1 ){
	$proces = process(  $_SESSION["user_id"], $db  );
	header( 'Location: ./admin_products.php?id='.base64_encode( $proces ));
}else{
	header( 'Location: ./login.php');
}

function process( $user_id, $db ){
	$compras = $db->get_results( "select * from compras where usuario_id=$user_id and compra_estado=0" );
	$ret = 0;
	if( count($compras)>0 )
	foreach( $compras as $compra ) {
		$db->query("update compras set compra_estado=1 where compra_id=".$compra->compra_id." and usuario_id=$user_id");
		$ret++;
	}
	if( $ret == 0 ) $ret = 0;
	if( $ret > 0 ) $ret = 1;
	return $ret;
}
?>