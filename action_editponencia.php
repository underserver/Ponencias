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
//if( $isadmin !=1  )
//header( "Location: ./login.php" );

$_validator = new Validator();
$_validator->setMethod( "POST" );
$_validator->setVars( array( "title:required", "date:required", "eje", "pid") );

$valid = $_validator->validate();
$values = $_validator->getValues();

if($valid){
	
	$file1_name = $_FILES['file1']['name'];
	$file1_type = $_FILES['file1']['type'];
	$file1_size = $_FILES['file1']['size'];
	
	$file2_name = $_FILES['file2']['name'];
	$file2_type = $_FILES['file2']['type'];
	$file2_size = $_FILES['file2']['size'];

	// evaluamos si el usuario envio una imagen
	/*if( trim( $file1_name ) == "" ){
		header( 'Location: adminpanel_editproduct.php?id='.base64_encode( "0" ).'&tk='.base64_encode(";image;"));
		exit(0);
	}*/
	
	$formats = array("application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");

	$sql = "update ponencias ";
	$sql .= "set ponencia_titulo='" .$values["title"]. "'";
	$sql .= ", ponencia_fecha='".$values["date"]. "'";
	$sql .= ", ponencia_resumen='".$_POST["summary"]. "'";
	if( $file1_name != "" ){
    $sql .= ", ponencia_archivo1='".$file1_name. "'";
	}
	if( $file2_name != "" ){
    $sql .= ", ponencia_archivo2='".$file2_name. "'";
	}
	$sql .= ", ponencia_ejetematico='".$values["eje"]."'";
	$sql .= " where ponencia_id=".base64_decode($values["pid"])." and usuario_id=".$_SESSION["user_id"];

	//upload file
	if( $file1_name != "" ){
    if(in_array($file1_type, $formats) && $file1_size < 3500000){
      move_uploaded_file($_FILES["file1"]["tmp_name"], "ponencias/" . $_SESSION["user_alias"] . '/' . $file1_name);
    }else{
      header( 'Location: admin_editponencia.php?id='.base64_encode( "2" ) . "&" . $file1_type . $_validator->getQueryString() . '&summary='. $_POST['summary']);
      exit(0);
    }
  }
	
	//upload file
	if( $file2_name != "" ){
    if(in_array($file2_type, $formats) && $file2_size < 3500000){
      move_uploaded_file($_FILES["file2"]["tmp_name"], "ponencias/" . $_SESSION["user_alias"] . '/' . $file2_name);
    }else{
      header( 'Location: admin_editponencia.php?id='.base64_encode( "2" ) . "&" . $file1_type2 . $_validator->getQueryString() . '&summary='. $_POST['summary']);
      exit(0);
    }
  }

	// Guardamos los datos en la base
	$db->query( $sql );
	header( 'Location: admin_viewponencia.php?id='.base64_encode( "1" ) ."&pid=".$values["pid"]);
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: admin_editponencia.php?id='.base64_encode( "0" ).'&tk='.base64_encode($err) . $_validator->getQueryString(). '&summary='. $_POST['summary']);
}

?>