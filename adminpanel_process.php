<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Envia todas las ventas pendientes a ventas procesadas
 * 			 sales		: Obligatorio en caso de que se procesen algunas (ventas a procesar)
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";

if( $isadmin==1 ){
	if( isset($_GET["all"]) ){
		$proces = processall( $db  );
	}else{
		$sales = $_POST[ "sales" ];
		$proces = process( $db, $sales );
	}
	header( 'Location: ./adminpanel_sales.php?id='.base64_encode( $proces ));
}else{
	header( 'Location: ./login.php');
}

function process( $db, $sales ){
	$compras = $db->get_results( "select * from compras where compra_estado=1" );
	$ret = count($compras);
	if( $ret != 0 )
	for( $i = 0; $i < count($sales); $i++ )
	if( trim($sales[$i]) != "" )
	$db->query("update compras set compra_estado=2 where compra_estado=1 and compra_id=".$sales[$i]);
	return $ret;
}

function processall( $db ){
	$compras = $db->get_results( "select * from compras where compra_estado=1" );
	$ret = count($compras);
	if( $ret != 0 )
	$db->query("update compras set compra_estado=2 where compra_estado=1");
	return $ret;
}
?>