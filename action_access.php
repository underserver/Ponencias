<?php
// Just a Test, now from netbeans
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Actualiza los datos de acceso de cada usuario
 *           pass_now: obligatorio (password actual)
 *           pass    : obligatorio (password nuevo)
 *
 *
************************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";

$_validator = new Validator();
$_validator->setMethod( "POST" );
$_validator->setVars( array("pass_now:required", "pass:required") );

if( $_validator->validate() && $login ==1 ){
	$values = $_validator->getValues();

	$user = $db->get_row("select * from usuarios where usuario_id=".$_SESSION["user_id"]);
	if( $user->usuario_password == md5( $values[ "pass_now" ]) ){
		$sql = "update usuarios set usuario_password='". md5($values[ "pass" ])."' where usuario_id=".$_SESSION["user_id"];
		$db->query( $sql );
		header( 'Location: ./admin_access.php?id='.base64_encode( "1" ) );
	}else{
		header( 'Location: ./admin_access.php?id='.base64_encode( "2" ) );
	}
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: ./admin_access.php?id='.base64_encode( "0" ).'&tk='.base64_encode($err) );
    // Comment test
}
?>