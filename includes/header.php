<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Cabecera
 *
 ***********************************************************************/
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr">
    <head>                     
        <meta content="text/html; charset=windows-1252" http-equiv="content-type">
        <title><?=$_i18n["title"]?></title>   
        <link href="styles/global.css" type="text/css" rel="stylesheet">   
        <link href="styles/modal-message.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="jscripts/ajax.js"></script> 
        <script type="text/javascript" src="jscripts/modal/js/ajax.js"></script>
        <script type="text/javascript" src="jscripts/modal/js/modal-message.js"></script>
        <script type="text/javascript" src="jscripts/modal/js/ajax-dynamic-content.js"></script>
        <script type="text/javascript" src="jscripts/cpanel.js"></script>
        
        <link href='http://fonts.googleapis.com/css?family=Marvel' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Actor' rel='stylesheet' type='text/css'>

    </head>
    <body>   
    <div id="header"> <div id="logo"> 
        <a href="./">     
        <img alt="CFIE" src="images/head.png">  </a> 
    </div> 
<?php include("topmenu.php");?> 
    </div>                  
   <?php include("includes/menu.php");?>
   <div class="clear"></div>
	<div id="nav2"> 
	<h2><?=$subtitle?></h2>
	<?php if( count( $items ) > 0 ){?>
		<ul id="submain"> 
			<?php for( $i = 0; $i < count( $items ); $i++ ){
			if( $selected == $i ){?>
			<li class="selected"> <?=$items[$i]?>  </li>
			<?php }else{?>
			<li class=""> <a href="<?=$links[$i]?>"><?=$items[$i]?></a>  </li>
			<?php }?>
			<?php }?>
		</ul> 
	<?php } ?>
	</div>