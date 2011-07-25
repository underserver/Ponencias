<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Modifica los datos de un producto
 * 			 pid         : Obligatorio (id del producto)
 * 			 name        : Obligatorio (nombre)
 * 			 count       : Obligatorio (cantidad)
 * 			 price       : Obligatorio (precio)
 * 			 expire      : Obligatorio (fecha de expiracion)
 * 			 description : Obligatorio (descripcion)
 * 			 rank		 : Obligatorio (prioridad)
 * 			 cat         : Obligatorio (categoria)
 * 			 image		 : Opcional    (imagen del producto)
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
$_validator->setVars( array("pid:required", "name:required", "count:required", "price:required", "expire:required", "description:required", "rank:required", "cat:required") );

if( $_validator->validate() ){
	$values = $_validator->getValues();

	$imagenname = $_FILES['image']['name'];
	$imagentype = $_FILES['image']['type'];

	$sql = "update articulos set ";
	$sql .= "articulo_nombre='" .$values["name"]. "', ";
	$sql .= "articulo_cantidad='" .$values["count"]. "', ";
	$sql .= "articulo_precio='" .$values["price"]. "', ";
	$sql .= "articulo_expira='" .$values["expire"]. "', ";
	$sql .= "articulo_descripcion='" .$values["description"]. "', ";
	$sql .= "articulo_rank='" .$values["rank"]. "', ";
	if( trim( $imagenname ) != "" )
	$sql .= "articulo_imagen='th_" .$imagenname. "', ";
	$sql .= "categoria_id='" .$values["cat"]. "' where articulo_id=".base64_decode($values["pid"]);

	//upload file
	if( trim( $imagenname ) != "" )
	if(($imagentype == "image/gif" || $imagentype == "image/jpeg" || $imagentype == "image/jpg" || $imagentype == "image/pjpeg") && $_FILES["image"]["size"] < 350000){
		move_uploaded_file($_FILES["image"]["tmp_name"],"images/" . $imagenname);
		thumbjpeg( "images/".$imagenname, 90 );
	}else{
		header( 'Location: adminpanel_editproduct.php?id='.base64_encode( "2" ).'&pid='.$values["pid"] );
		exit(0);
	}

	// Guardamos los datos en la base
	$db->query( $sql );
	header( 'Location: adminpanel_editproduct.php?id='.base64_encode( "1" ).'&pid='.$values["pid"]);
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: adminpanel_editproduct.php?id='.base64_encode( "0" ).'&tk='.base64_encode($err).'&pid='.$_POST["pid"] );
}

?>