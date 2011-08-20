<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Implementa la seguridad
 *
 ***********************************************************************/

$login = 0; $isadmin = 0;
if( $_SESSION["user_id"] != "" && isset($_SESSION["user_id"]) )
	$login = 1;
if( $_SESSION["user_role"] ==1 && isset($_SESSION["user_role"]) )
	$isadmin = 1;
?>