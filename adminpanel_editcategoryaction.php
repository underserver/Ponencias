<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Modifica los datos de una categoria
 * 			 cid         : Obligatorio (id de la categoria)
 * 			 name        : Obligatorio (nombre)
 * 			 description : Obligatorio (descripcion)
 * 			 rank		 : Obligatorio (Prioridad)
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
include_once "./includes/utils.php";
if( $isadmin !=1  )
header( "Location: ./login.php" );

$_validator = new Validator();
$_validator->setMethod( "POST" );
$_validator->setVars( array("cid:required", "name:required", "description:required", "rank:required" ) );

if( $_validator->validate() ){
	$values = $_validator->getValues();

	//verificamos si ya existe la categoria
	$cat = $db->get_var( "select count(*) from categorias where categoria_nombre='" .$values["name"]. "' and categoria_id <> ".base64_decode($values["cid"]));
	if( $cat > 0 ){
		header( "Location: ./adminpanel_editcategory.php?id=".base64_encode( "2" ).'&cid='.$values["cid"] );
		exit(0);
	}

	$sql = "update categorias set ";
	$sql .= "categoria_nombre='" .$values["name"]. "', ";
	$sql .= "categoria_descripcion='" .$values["description"]. "', ";
	$sql .= "categoria_rank='" .$values["rank"]. "' ";
	$sql .= "where categoria_id=".base64_decode($values["cid"]). " and categoria_id <> 0";

	// Guardamos los datos en la base
	$db->query( $sql );
	header( 'Location: adminpanel_editcategory.php?id='.base64_encode( "1" ).'&cid='.$values["cid"]);
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: adminpanel_editcategory.php?id='.base64_encode( "0" ).'&tk='.base64_encode($err).'&cid='.$_POST["cid"] );
}

?>