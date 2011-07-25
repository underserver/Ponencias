<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Clase que valida los datos de un formulario
 *
 ***********************************************************************/
class validator{
	var $method;
	var $vars;
	var $errors;
	var $values;
	var $error = 0;
	var $types = array( "required"=>0, "email"=>1,"url"=>2,"phone"=>3);
	var $params = array();

	function validator(){} // constructor

	function setMethod( $method = "GET" ){
		$this->method = $method;
	}

	function setVars( $vars ){
		$this->vars = $vars;
	}

	function validate(){

		for( $i=0, $e = 0; $i < count($this->vars); $i++ ){
			list( $var, $type ) = split( ":", $this->vars[$i]);
			$field = (!strcmp($this->method, "GET") ? $_GET[ $var ] : $_POST[ $var ] );
			$field = str_replace( "<", "&lt;", $field );
			$field = str_replace( ">", "&gt;", $field );
			$this->values[$var] = $field;
			$this->params[$i] = $var;
			switch( $this->types[ $type ] ){
				case 0:
					if( !isset( $field ) || strlen(trim($field)) == 0 ){
						$this->error++;
						$this->errors[$e]["field"] = $var;
						$this->errors[$e]["error"] = $type;
						$e++;
					}
					break;
				case 1:
					if( !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $field) ){
						$this->error++;
						$this->errors[$e]["field"] = $var;
						$this->errors[$e]["error"] = $type;
						$e++;
					}
					break;
				case 2:
					if( !preg_match('/^(http|https):\/\/([a-z0-9-]\.+)*/i', $field)){
						$this->error++;
						$this->errors[$e]["field"] = $var;
						$this->errors[$e]["error"] = $type;
						$e++;
					}
					break;
				case 3:
					if(!ereg("^[0-9\-\(\)\ \+]+$", $field)){
						$this->error++;
						$this->errors[$e]["field"] = $var;
						$this->errors[$e]["error"] = $type;
						$e++;
					}
					break;
				default:
					break;
			}
		}
		return ($this->error > 0 ? 0 : 1);
	}

	function getErrors(){
		return $this->errors;
	}
	
	function getParams(){
		return $this->params;
	}

	function getValues(){
		return $this->values;
	}
	
	function getQueryString(){
    for( $vals="", $j = 0; $j < count($e = $this->values); $j++ ){
      $key = $this->params[$j];
      $vals = $vals."&".$key."=".$e[$key];
    }
    return $vals;
	}

}
?>