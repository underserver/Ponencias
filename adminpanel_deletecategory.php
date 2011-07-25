<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Elimina una categoria de ventas
 * 			 id : Obligatorio (id de la categoria)
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
		// Enviamos los articulos de la categoria por eliminar a la categoria 0
		$db->query("update articulos set categoria_id=0 where categoria_id=". base64_decode($values["id"]) );
		// Eliminamos la categoria
		$db->query("delete from categorias where categoria_id=".base64_decode($values["id"]). " and categoria_id <> 0" );
		echo "1";
	}else{
		echo "0";
	}
}

?>