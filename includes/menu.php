<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Menu de navegacion
 *
 ***********************************************************************/
?>
<div id="navigation">
<ul>
	<li class="<?=$sselected == 1 ? "selected" : ""?>">
    <a href="."	title=""> <?=i18n("menu1")?> </a>
	</li>
	<li class="<?=$sselected == 2 ? "selected" : ""?>">
    <a href="ponencias.php" title=""><?=i18n("menu2")?></a>
	</li>
	<?php if ( isset($_SESSION[ 'user_id' ]) ){?>
	<?if( $_SESSION['user_role'] == 2 ){?>
  <li class="<?=$sselected == 3 ? "selected" : ""?>">
    <a href="admin_ponencias.php" title="Mis Ponencias"> Mis Ponencias </a>
	</li>
	<?} else if( $_SESSION['user_role'] == 1 ){?>
	<li class="<?=$sselected == 3 ? "selected" : ""?>">
    <a href="adminpanel.php" title=""><?=i18n("menu3")?></a>
	</li>
	<?} else if( $_SESSION['user_role'] == 3 ){?>
	<li class="<?=$sselected == 3 ? "selected" : ""?>">
    <a href="adminpanel.php" title="Evaluar Ponencias">Evaluar Ponencias</a>
	</li>
	<?}?>
	<li id="services" class="<?=$sselected == 4 ? "selected" : ""?>">
    <a href="javascript:showItem('servicelist');"	title=" <?=$_i18n["menu4"]?>">
      <?=$_i18n["menu4"]?><img src="styles/arrow.gif" alt="">
    </a>
    <ul id="servicelist">
      <li class="">
        <a href="admin_personal.php" title="<?=$_i18n["menu41"]?>"><?=$_i18n["menu41"]?> </a>
      </li>
      <li class="">
        <a href="admin_access.php" title="<?=$_i18n["menu42"]?>"><?=$_i18n["menu42"]?> </a></li>
      <li class="">
        <a href="logoff.php" title="Cerrar sesión">Cerrar sesión</a>
      </li>
    </ul>
	</li>
	<?}else{?>
	</li>
	<li class="<?=$sselected == 4 ? "selected" : ""?>">
    <a href="register.php" title="Registro">Registro</a></li>
	<?}?>
</ul>

<div class="clear"></div>
</div>
