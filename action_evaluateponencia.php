<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
include_once "./includes/utils.php";
include_once "./includes/states.php";
//if( $isadmin !=1  )
//header( "Location: ./login.php" );

$_validator = new Validator();
$_validator->setMethod( "POST" );
$_validator->setVars( array( "dictamen:required", "calif:required", "pid:required") );

$valid = $_validator->validate();
$values = $_validator->getValues();

if($valid){
	
	$dictamen_name = $_FILES['dictamen']['name'];
	$dictamen_type = $_FILES['dictamen']['type'];
	$dictamen_size = $_FILES['dictamen']['size'];
	$dictamen_temp = $_FILES['dictamen']['tmp_name'];
	
	$formats = array("application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");

	$sql = "select ponencias.ponencia_estado, ponencia.usuario_id from ponencias, ponencias_evaluadores where ponencias.ponencia_id=ponencias_evaluadores.ponencia_id and ponencias_evaluadores.evaluador_id=".$_SESSION["user_id"];
	
	$ponencia = $db->get_row($sql);
	
	if( $ponencia->ponencia_estado == 2 ){
		if( in_array($dictamen_type, $formats) ){
			if( move_uploaded_file($dictamen_temp, "ponencias/" . $ponencia->usuario_id . '/' . $dictamen_name) ){
				$sql = "update ponencias_evaluadores ";
				$sql .= "set ponencia_dictamen='" .$dictamen_name. "'";
				$sql .= ", evaluacion_fecha='".date("Y/m/d g:i a"). "'";
				$sql .= ", ponencia_calif='".$values["calif"]. "'";
				$sql .= " where ponencia_id=".base64_decode($values["pid"])." and evaluador_id=".$_SESSION["user_id"]. " ";

				$db->query( $sql );
				header( 'Location: evaluate_ponencia.php?id='. $OK ."&pid=".$values["pid"]);
			} else {
				header( 'Location: evaluate_ponencia.php?id='. $ERR_FILE_MOVE ."&pid=".$values["pid"]);
			}
		}else{
			header( 'Location: evaluate_ponencia.php?id='. $ERR_FILE_EXT ."&pid=".$values["pid"]);
		}
	}else{
		header( 'Location: evaluate_ponencia.php?id='. $ERR_PONENCIA_WRONG_STATE ."&pid=".$values["pid"]);
	}
	
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: evaluate_ponencia.php?id='.$ERR_FIELDS_REQUIRED.'&tk='.base64_encode($err) . $_validator->getQueryString(). '&summary='. $_POST['summary']);
}

?>