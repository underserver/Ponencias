<?php
public static i18n($key){
	if(isset($_i18n[$key])){
		return $_i18n[$key];
	}
	return $key;
}

?>