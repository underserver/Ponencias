<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Actualiza los datos personales de cada usuario
 *           user_name     : obligatorio (nombre)
 * 			 user_lastname : obligatorio (apellidos)
 * 			 user_born     : obligatorio (fecha de nacimiento)
 *           user_address  : obligatorio (direccion)
 *           user_phone    : obligatorio (telefono)
 *           user_mail     : obligatorio (correo electronico)
 *           shared        : opcional    (modo compartido)
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";

$_validator = new Validator();
$_validator->setMethod( "POST" );
$_validator->setVars( array("user_name:required", "user_lastname:required", "user_born:required", "user_address:required", "user_phone:required", "user_mail:required") );

if( $_validator->validate() && $login ==1 ){
	$values = $_validator->getValues();

	$sql = "update usuarios set usuario_nombre='".$values['user_name']."', usuario_apellidos='".$values['user_lastname'];
	$sql .= "', usuario_nacimiento='".$values['user_born']."', usuario_direccion='".$values['user_address'];
	$sql .=	"', usuario_telefono='".$values['user_phone']."', usuario_correo='".$values['user_mail']."', usuario_compartido=".(isset($_POST['shared'])?"1":"0")." where usuario_id=".$_SESSION["user_id"];
	if(isset($_POST['shared']) ){
		$db->query( "update usuarios set pago_nombre='".$values['user_name']." ".$values['user_lastname']."', pago_direccion='".$values['user_address']."', pago_telefono='".$values['user_phone']."' where usuario_id=".$_SESSION["user_id"] );
	}
	$db->query( $sql );
	header( 'Location: admin_personal.php?id='.base64_encode( "1" ) );
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: admin_personal.php?id='.base64_encode( "0" ).'&tk='.base64_encode($err) );
}

?>