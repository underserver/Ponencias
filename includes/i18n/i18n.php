<?php
function i18n($key){
	include_once dirname(__FILE__)."/es.php";
	if(isset($_i18n[$key])){
		return $_i18n[$key];
	}
	return $key;
}
?>