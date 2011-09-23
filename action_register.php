<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Registra un usuario nuevo como cliente
 *           name     : obligatorio (nombre)
 *           address  : obligatorio (direccion)
 *           password : obligatorio (contraseña)
 *           email    : obligatorio (correo)
 *           phone    : opcional    (telefono)
 *           type     : obligatorio (tipo de usuario)
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";

$_validator = new Validator();
$_validator->setMethod( "POST" );
$_validator->setVars( array( "name:required", "last:required", "email:email", "password:required", "user:required", "institution:required", "type:required", "sub:required" ) );

$valid  = $_validator->validate();
$values = $_validator->getValues();

if( $valid ){
	$users = $db->get_results( "select * from usuarios where usuario_alias='".$values["user"]."'" );
	if( count($users) != 0 ){
		header( 'Location: ./register.php?id='.base64_encode( "1" ).'&type='.$values["type"] );
		exit(0);
	}

  $sql  = "insert into usuarios(usuario_nombre, usuario_apellidos, usuario_correo, usuario_telefono, usuario_alias, usuario_password, usuario_tipo) ";
  $sql .= " values('".$values[ "name" ]."','".$values[ "last" ]."'";
  $sql .= ",'".$values[ "email" ]."','".$values[ "phone" ]."'";
  $sql .= ",'".$_POST[ "user" ]."','".md5($_POST[ "password" ])."'";
  $sql .= ",'".$values[ "type" ]."')";
  $db->query($sql);

  header( 'Location: ./UsuarioLogin.php' );

}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	for( $vals="", $j = 0; $j < count($e = $values); $j++ ){
    $params = $_validator->getParams();
    $key = $params[$j];
		$vals = $vals."&".$key."=".$e[$key];
	}
	header( 'Location: ./register.php?id='.base64_encode( "2" ).'&tk='.base64_encode($err).'&type='.$values["type"] . $vals );

}

?>