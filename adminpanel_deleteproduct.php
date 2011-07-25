<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Elimina un producto de la base de datos
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
		$db->query("delete from articulos where articulo_id=".base64_decode($values["id"]));
		echo "1";
	}else{
		echo "0";
	}
}

?>