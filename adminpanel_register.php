<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Da de alta un nuevo usuario como cliente en modo rapido
 * 			 name		: Obligatorio (nombre)
 * 			 password	: Obligatorio (contraseña)
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";

if( $isadmin != 1 )
header( "Location: ./login.php" );

$_validator = new Validator();
$_validator->setMethod( "POST" );
$_validator->setVars( array( "name:required", "password:required" ) );

if( $_validator->validate() ){
	$values = $_validator->getValues();
	$users = $db->get_results( "select * from usuarios where usuario_alias='".$values["name"]."'" );
	if( count($users) != 0 ){
		header( 'Location: ./adminpanel_users.php?id='.base64_encode( "1" ) );
		exit(0);
	}

	$sql  = "insert into usuarios(pago_nombre,usuario_nombre,usuario_password,usuario_alias) ";
	$sql .= " values('".$values[ "name" ]."','".$values[ "name" ]."'";
	$sql .= ",'".md5($values[ "password" ])."','".$values[ "name" ]."')";
	$db->query($sql);
	header( 'Location: ./adminpanel_users.php?id='.base64_encode( "0" ) );
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: ./adminpanel_users.php?id='.base64_encode( "2" ).'&tk='.base64_encode($err) );

}

?>