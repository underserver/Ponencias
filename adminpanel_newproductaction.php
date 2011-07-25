<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Agrega a la base de datos un nuevo producto
 * 			 name		 : Obligatorio (nombre)
 * 			 count		 : Obligatorio (cantidad)
 * 			 price		 : Obligatorio (precio)
 * 			 expire		 : Obligatorio (fecha de expiracion)
 * 			 description : Obligatorio (descripcion)
 * 			 rank		 : Obligatorio (prioridad)
 * 			 cat		 : Obligatorio (categoria)
 * 			 image		 : Obligatorio (imagen del producto)
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
$_validator->setVars( array( "name:required", "count:required", "price:required", "expire:required", "description:required", "rank:required", "cat:required") );

if( $_validator->validate() ){
	$values = $_validator->getValues();
	$imagenname = $_FILES['image']['name'];
	$imagentype = $_FILES['image']['type'];

	// evaluamos si el usuario envio una imagen
	if( trim( $imagenname ) == "" ){
		header( 'Location: adminpanel_editproduct.php?id='.base64_encode( "0" ).'&tk='.base64_encode(";image;"));
		exit(0);
	}

	$sql = "insert into articulos(articulo_nombre, articulo_cantidad, articulo_precio, articulo_expira, articulo_descripcion, articulo_rank, articulo_imagen, categoria_id, articulo_fecha) ";
	$sql .= "values('" .$values["name"]. "', '";
	$sql .= $values["count"]. "', '";
	$sql .= $values["price"]. "', '";
	$sql .= $values["expire"]. "', '";
	$sql .= $values["description"]. "', '";
	$sql .= $values["rank"]. "', '";
	$sql .= "th_" .$imagenname. "', '";
	$sql .= $values["cat"]. "','";
	$sql .= date("y/m/d"). "')";

	//upload file
	if(($imagentype == "image/gif" || $imagentype == "image/jpeg" || $imagentype == "image/jpg" || $imagentype == "image/pjpeg") && $_FILES["image"]["size"] < 350000){
		move_uploaded_file($_FILES["image"]["tmp_name"],"images/" . $imagenname);
		thumbjpeg( "images/".$imagenname, 90 );
	}else{
		header( 'Location: adminpanel_newproduct.php?id='.base64_encode( "2" ) );
		exit(0);
	}

	// Guardamos los datos en la base
	$db->query( $sql );
	header( 'Location: adminpanel_products.php?id='.base64_encode( "1" ));
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: adminpanel_newproduct.php?id='.base64_encode( "0" ).'&tk='.base64_encode($err));
}

?>