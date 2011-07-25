<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Formulario para modificar los datos de un usuario
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
if( $isadmin != 1 ) header( "Location: ./login.php" );

$_validator = new Validator();
$_validator->setMethod( "GET" );
$_validator->setVars( array("id:required") );
if( $_validator->validate() ){
	$values = $_validator->getValues();
	$sql = sprintf("select * from %s", $values["id"] );
	if( isset( $_GET["filter"] ) )
		$sql .= " where ".$_GET["filter"]; 
	$request = $db->get_results();
	foreach( $request as $item ){
		
	}
}
?>