<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Inicializa el motor de ezSQL para la conexion a mysql
 *
 ***********************************************************************/
// Include ezSQL core
include_once "./includes/ezsql/shared/ez_sql_core.php";

// Include ezSQL database specific component
include_once "./includes/ezsql/mysql/ez_sql_mysql.php";

// Initialise database object and establish a connection
// at the same time - db_user / db_password / db_name / db_host
$db = new ezSQL_mysql("root", "root", "jshop", "localhost");
?>