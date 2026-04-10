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
$db = new ezSQL_mysql($_config[ "db_user" ],$_config[ "db_pass" ], $_config[ "db_name" ], $_config[ "db_host" ]);
function createUserTable() {
    global $db;

    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        usuario_id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_nombre VARCHAR(50) NOT NULL,
        usuario_apellidos VARCHAR(50) NOT NULL,
        usuario_correo VARCHAR(100) NOT NULL,
        usuario_telefono VARCHAR(15),
        usuario_direccion VARCHAR(255),
        usuario_nacimiento DATE,
        usuario_alias VARCHAR(50) NOT NULL UNIQUE,
        usuario_password VARCHAR(255) NOT NULL,
        usuario_tipo INT NOT NULL,
        usuario_ultimoacceso DATETIME
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $db->query($sql);
}

createUserTable();
?>