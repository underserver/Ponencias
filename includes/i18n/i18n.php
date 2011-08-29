<?php
function i18n($key){
	include dirname(__FILE__)."/es.php";
	if(isset($_i18n[$key])){
		return $_i18n[$key];
	}
	return $key;
}
?>