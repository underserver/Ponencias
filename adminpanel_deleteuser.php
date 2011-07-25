<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Elimina un usuario de la base de datos
 * 			 user: Obligatorio (id del usuario)
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";

$_validator = new Validator();
$_validator->setMethod( "GET" );
$_validator->setVars( array("user:required") );

if( $_validator->validate() && $isadmin == 1 ){
	$values = $_validator->getValues();
	$db->query("delete from usuarios where usuario_id=".base64_decode($values["user"]) ." and usuario_role=0");
	echo "1";

}else{
	echo "0";
}

?>