<div id="dash1">
	<h1>CFIE - Panel de Control de Ponencias</h1>
	<div id="dom_user">
	<div id="domain">
	<p>Estado de las ponencias</p>
	<ul class="inlinelist">
		<li><b><a href="AsignarEvaluadores.php">Asignar Evaluadores</a>&nbsp;</b></li>
		<li><a href="adminpanel_sales.php">Nuevas ponencias</a>&nbsp;</li>
	</ul>
<div class="clear"></div>

</div>
<div id="users">
<h2><?=i18n("admin.usersaccount")?></h2>
<ul class="inlinelist">
	<li><?=$users?> <?=i18n("admin.users")?> &nbsp;</li>
	<li><a href="adminpanel_users.php#create">Nuevo usuario</a>&nbsp;
	</li>
</ul>
<p><?=i18n("admin.index.2")?></p>
</div>
</div>
<div class="spacer"></div>
</div>
<div id="dash2">
<div class="spacer"></div>
<h2 class="inlinetext"><?=i18n("admin.configuration")?></h2>
<ul class="inlinelist2">
	<li><a href="adminpanel_newproduct.php">Agregar nueva ponencia</a></li>
</ul>
<ul id="services">
	<li class="clrflt"><a href="EmailSettings" class="docs"><span><?=i18n("products")?></span></a>
	<h3><a href="adminpanel_products.php">Ponencias pendientes</a>
	</h3>
	<span class="beta"><?=$articles?> </span> <span> - <?=i18n("admin.active")?></span>
	<p><a href="#" class="greenlink"> Lista de ponencias pendientes de revisi�n </a>
	</p>
	</li>
	<li class=""><a href="ChatSettings" class="calendar"><span><?=i18n("categories.submenu")?></span></a>
	<h3><a href="adminpanel_categories.php">Asistentes</a></h3>
	<span class="beta"><?=$categories?> </span> <span> - <?=i18n("admin.active")?></span>
	<p><a href="#" class="greenlink"> Personas que asistiran a la ponencia</a></p>
	</li>
	<li class="clrflt"><a href="CalendarSettings" class="calendar"> <span>Usuarios</span></a>
	<h3><a href="adminpanel_users.php">Evaluadores</a></h3>
	<span class="beta"><?=$users?> </span> <span> - <?=i18n("admin.active")?>
	</span>
	<p><a href="#" class="greenlink"> Usuarios que pueden evaluar ponencias </a></p>
	</li>
	<li class=""><a href="WebPages" class="calendar"><span><?=i18n("admin.salesp")?></span></a>
	<h3><a href="adminpanel_sales.php?p=2">Ponentes</a></h3>
	<span class="beta"><?=$processed?> </span> <span> - <?=i18n("admin.active")?>]
	</span>
	<p><a href="adminpanel_sales.php?p=3" class="greenlink"> Personas que presentaran alguna ponencia</a>
	</p>
	</li>
</ul>
<div class="clear"></div>
</div>

</div>
