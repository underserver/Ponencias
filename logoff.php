<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Cierra la sesion actual (Destruye la sesion)
 *
 ***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
session_destroy();
header( "Location: ./login.php");
?>