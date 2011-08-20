<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Modifica los datos mas importantes de un usuario cliente (menos tarjeta de credito)
 * 			 user_name		: Obligatorio (nombre)
 * 			 user_lastname	: Obligatorio (apellidos)
 * 			 user_born		: Obligatorio (fecha de nacimiento)
 * 			 user_address	: Obligatorio (direccion)
 * 			 user_phone		: Obligatorio (telefono)
 * 			 user_mail		: Obligatorio (correo)
 * 			 user_id		: Obligatorio (id del usuario)
 * 			 user_password	: Opcional    (contraseña)
 * 			 shared			: Opcional    (modo compartido)
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
if( $isadmin !=1  )
header( "Location: ./login.php" );

$_validator = new Validator();
$_validator->setMethod( "POST" );
$_validator->setVars( array("user_name:required", "user_lastname:required", "user_born:required", "user_address:required", "user_phone:required", "user_mail:required", "userid:required") );

if( $_validator->validate() ){
	$values = $_validator->getValues();

	// Obtenemos el password para ver si es diferente
	$pass = $db->get_var( "select usuario_password from usuarios where usuario_id=".base64_decode($values["userid"] ));
	if( $pass != md5($_POST["password"]) && isset( $_POST["password"] ) && trim($_POST["password"]) != "" )
	$password = md5( $_POST["password"] );
	else
	$password = $pass;

	$sql = "update usuarios set usuario_nombre='".$values['user_name']."', usuario_apellidos='".$values['user_lastname'];
	$sql .= "', usuario_nacimiento='".$values['user_born']."', usuario_direccion='".$values['user_address'];
	$sql .=	"', usuario_telefono='".$values['user_phone']."', usuario_correo='".$values['user_mail']."', usuario_compartido=".(isset($_POST['shared'])?"1":"0").", usuario_password='".$password."' where usuario_id=".base64_decode($values["userid"]);
	if(isset($_POST['shared']) ){
		$db->query( "update usuarios set pago_nombre='".$values['user_name']." ".$values['user_lastname']."', pago_direccion='".$values['user_address']."', pago_telefono='".$values['user_phone'].", usuario_password='".$password."' where usuario_id=".base64_decode($values["userid"]) );
	}else{
		$db->query( $sql );
	}
	header( 'Location: adminpanel_edituser.php?id='.base64_encode( "1" ).'&user='.$values["userid"]);
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: adminpanel_edituser.php?id='.base64_encode( "0" ).'&tk='.base64_encode($err).'&user='.$_POST["userid"] );
}

?>