<?php
include_once dirname(__FILE__)."/es.php";
echo $_i18n;
function i18n($key){
	echo $_i18n;
	if(isset($_i18n[$key])){
		return $_i18n[$key];
	}
	return $key;
}

?>