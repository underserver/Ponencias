<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Valida un usuario para iniciar sesion
 *           userName    : obligatorio (nombre de usuario)
 *           userPassword: obligatorio (password del usuario)
 *
 *
**********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";

$_validator = new Validator();
$_validator->setMethod( "POST" );
$_validator->setVars( array("userName:required", "userPassword:required") );

if( $_validator->validate() ){
	$values = $_validator->getValues();

	$user = $db->get_row( "select * from usuarios where usuario_alias='".$values["userName"]."'" );
	if( $user->usuario_password == md5($values["userPassword"]) ){
		$_SESSION[ 'user_id' ] = $user->usuario_id;
		$_SESSION[ 'user_alias' ] = $user->usuario_alias;
		$_SESSION[ 'user_role' ] = $user->usuario_tipo;
		$db->query( "update usuarios set usuario_ultimoacceso='".date("y/m/d")."' where usuario_id=".$user->usuario_id );
		if( $user->usuario_tipo == 2 ){
      header( 'Location: ./admin_ponencias.php');
		}else if( $user->usuario_tipo == 3 ){
      header( 'Location: ./evaluate_ponencias.php');
		}else{
      header( 'Location: ./adminpanel.php');
		}
	}else{
		header( 'Location: ./login.php?id='.base64_encode( "2" ) );
	}

}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: ./login.php?id='.base64_encode( "0" ).'&tk='.base64_encode($err) );
}

?>