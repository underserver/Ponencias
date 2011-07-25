<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Actualiza los datos de acceso de cada usuario
 *           pass_now: obligatorio (password actual)
 *           pass    : obligatorio (password nuevo)
 *
 *
************************************************************************/
ERROR_REPORTING(E_ALL);
// Include file headers
include_once "../includes/validator.php";
include_once "../includes/settings.php";
include_once "../includes/security.php";

// Include ezSQL core
include_once "../includes/ezsql/shared/ez_sql_core.php";

// Include ezSQL database specific component
include_once "../includes/ezsql/mysql/ez_sql_mysql.php";

// Initialise database object and establish a connection
// at the same time - db_user / db_password / db_name / db_host

$_validator = new Validator();
$_validator->setMethod( "POST" );
$_validator->setVars( array("dbname:required", "uname:required", "dbhost:required") );

if( $_validator->validate() ){
	
	  $values = $_validator->getValues();
    $db = new ezSQL_mysql($values[ "uname" ],$_POST[ "pwd" ], $values[ "dbname" ], $values[ "dbhost" ]);
	
		$sql1 = "DROP TABLE IF EXISTS articulos;";
    $sql1a ="CREATE TABLE `articulos` (";
    $sql1a .="   `articulo_id` int(11) NOT NULL AUTO_INCREMENT,";
    $sql1a .="   `articulo_nombre` varchar(250) DEFAULT NULL,";
    $sql1a .="   `articulo_precio` float(10,3) DEFAULT NULL,";
    $sql1a .="   `articulo_cantidad` int(11) DEFAULT NULL,";
    $sql1a .="   `articulo_descripcion` text,";
    $sql1a .="   `categoria_id` int(5) DEFAULT NULL,";
    $sql1a .="   `articulo_fecha` date DEFAULT NULL,";
    $sql1a .="   `articulo_expira` date DEFAULT NULL,";
    $sql1a .="   `articulo_imagen` varchar(250) DEFAULT NULL,";
    $sql1a .="   `articulo_rank` int(11) DEFAULT 0,";
    $sql1a .="   PRIMARY KEY (`articulo_id`)";
    $sql1a .= "  ";
    $sql1a .=" );";
           
    $sql2 = "DROP TABLE IF EXISTS `categorias`;";
    $sql2a = "CREATE TABLE `categorias` (";
    $sql2a .= "  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,";
    $sql2a .= "  `categoria_nombre` varchar(250) DEFAULT NULL,";
    $sql2a .= "  `categoria_descripcion` text,";
    $sql2a .= "  `categoria_parent` varchar(250) DEFAULT NULL,";
    $sql2a .= "  `categoria_fecha` date DEFAULT NULL,";
    $sql2a .= "  `categoria_rank` int(11) DEFAULT 0,";
    $sql2a .= "  PRIMARY KEY (`categoria_id`)";
    $sql2a .= ");";
            
    $sql3 = "DROP TABLE IF EXISTS `compras`;";
    $sql3a = "CREATE TABLE `compras` (";
    $sql3a .= "  `compra_id` int(11) NOT NULL AUTO_INCREMENT,";
    $sql3a .= "  `articulo_id` int(11) DEFAULT NULL,";
    $sql3a .= "  `usuario_id` int(11) DEFAULT NULL,";
    $sql3a .= "  `compra_fecha` date DEFAULT NULL,";
    $sql3a .= "  `compra_activa` int(1) DEFAULT '0',";
    $sql3a .= "  `compra_estado` int(1) DEFAULT '0',";
    $sql3a .= "  `compra_numero` int(5) DEFAULT NULL,";
    $sql3a .= "  PRIMARY KEY (`compra_id`)";
    $sql3a .= ");";
            
    $sql4 = "DROP TABLE IF EXISTS `usuarios`;";
    $sql4a = "CREATE TABLE `usuarios` (";
    $sql4a .= "  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,";
    $sql4a .= "  `usuario_nombre` varchar(250) DEFAULT NULL,";
    $sql4a .= "  `usuario_apellidos` varchar(250) DEFAULT NULL,";
    $sql4a .= "  `usuario_nacimiento` date DEFAULT NULL,";
    $sql4a .= "  `usuario_ultimoacceso` date DEFAULT NULL,";
    $sql4a .= "  `usuario_direccion` text,";
    $sql4a .= "  `usuario_tcredito` varchar(250) DEFAULT NULL,";
    $sql4a .= "  `usuario_metodopago` int(1) DEFAULT NULL,";
    $sql4a .= "  `usuario_password` varchar(250) DEFAULT NULL,";
    $sql4a .= "  `usuario_correo` varchar(250) DEFAULT NULL,";
    $sql4a .= "  `usuario_lenguaje` varchar(250) DEFAULT NULL,";
    $sql4a .= "  `pago_direccion` text,";
    $sql4a .= "  `pago_nombre` varchar(250) DEFAULT NULL,";
    $sql4a .= "  `pago_telefono` varchar(11) DEFAULT NULL,";
    $sql4a .= "  `usuario_alias` varchar(250) DEFAULT NULL,";
    $sql4a .= "  `usuario_telefono` varchar(11) DEFAULT NULL,";
    $sql4a .= "  `usuario_compartido` int(1) DEFAULT 0,";
    $sql4a .= "  `tarjeta_tipo` varchar(250) DEFAULT NULL,";
    $sql4a .= "  `usuario_role` int(1) DEFAULT 0,";
    $sql4a .= "  PRIMARY KEY (`usuario_id`)";
    $sql4a .= ");";
            
      $sql5 = "INSERT INTO usuarios (usuario_nombre,usuario_password,usuario_alias,usuario_role) VALUES ('noname', '123456', 'admin', 1)";
      
      $sql6 = "INSERT INTO categorias (categoria_id,categoria_nombre,categoria_descripcion,categoria_parent,categoria_fecha,categoria_rank) VALUES ";
       $sql6 .= "(0,'Uncategorized','Todos los articulos sin categoria\r\n',NULL,'2004-02-27',0)";
     
		if( $db->query( $sql1 ) == 0 &&
		$db->query( $sql1a ) == 0 &&
    $db->query( $sql2 ) == 0 &&
    $db->query( $sql2a ) == 0 &&
    $db->query( $sql3 ) == 0 &&
    $db->query( $sql3a ) == 0 &&
    $db->query( $sql4 ) == 0 &&
    $db->query( $sql4a ) == 0 &&
    $db->query( $sql5 ) == 1 &&
    $db->query( $sql6 ) == 1)

		{
		
        $archivo = '../includes/config.php';
        $fp = fopen($archivo, "w+");
        $string  = "<?php \$_config[ \"db_host\" ] = \"" . $values[ "dbhost" ] . "\";\n";
        $string .= "\$_config[ \"db_user\" ] = \"" . $values[ "uname" ] . "\";\n";
        $string .= "\$_config[ \"db_pass\" ] = \"" . $_POST[ "pwd" ] ."\";\n";
        $string .= "\$_config[ \"db_name\" ] = \"" . $values[ "dbname" ] . "\";\n";
        $string .= "\$_config[ \"page_lang\" ] = \"es\";\n";
        $string .= "\$_config[ \"session_id\" ] = \"jshop\";\n";
        $string .= "\$_config[ \"iva\" ] = 0.15;\n?>";
        
        $write = fputs($fp, $string);
        fclose($fp);  
        
        header( 'Location: ./finish.php' );
    }else{
        header( 'Location: ./fail.php' );
    }

	
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: ./step1.php' );
}
?>