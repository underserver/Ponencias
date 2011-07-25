<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Agrega a la base de datos una nueva categoria
 * 			 name		 : Obligatorio (nombre)
 * 			 description : Obligatorio (descripcion)
 * 			 rank		 : Obligatorio (prioridad)
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
$_validator->setVars( array( "name:required", "description:required", "rank:required" ) );

if( $_validator->validate() ){
	$values = $_validator->getValues();

	//verificamos si ya existe la categoria
	$cat = $db->get_var( "select count(*) from categorias where categoria_nombre='" .$values["name"]. "'");
	if( $cat > 0 ){
		header( "Location: ./adminpanel_newcategory.php?id=".base64_encode( "2" ) );
		exit(0);
	}

	$sql = "insert into categorias(categoria_nombre, categoria_descripcion, categoria_rank, categoria_fecha) values('";
	$sql .= $values["name"]. "', '";
	$sql .= $values["description"]. "', '";
	$sql .= $values["rank"]. "', '";
	$sql .= date("y/m/d"). "')";

	// Guardamos los datos en la base
	$db->query( $sql );
	header( 'Location: adminpanel_categories.php?id='.base64_encode( "1" ) );
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: adminpanel_newcategory.php?id='.base64_encode( "0" ).'&tk='.base64_encode($err) );
}

?>