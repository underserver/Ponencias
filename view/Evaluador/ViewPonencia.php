<?php global $ponencia;?>
<form action="#" method="post"
	id="settings" enctype="multipart/form-data">
	<input type="hidden" name="at" value="7cf0ac816f615996-1128ad98933">
<table>
	<tr>
		<th>Titulo:</th>
		<td><span class="details"> <?=$ponencia->getTitulo()?></span></span></td>
	</tr>
	<tr>
		<th>Fecha de presentaci&oacute;n:</th>
		<td><span class="details"> <?=$ponencia->getFecha()?></span></td>
	</tr>
	<tr>
		<th>Eje Tematico:</th>
		<td><span class="details"><?=$ponencia->getEjeTematico()?></span></td>
	</tr>
	<tr>
		<th>Estado:</th>
		<td><span class="details"><?=$ponencia->getStatus()?></span></td>
	</tr>
	<tr>
		<th>Resumen:</th>
		<td><span class="details"><?=$ponencia->getResumen()?></span></td>
	</tr>
	<tr>
		<th>Archivo <b>con</b> nombres:</th>
		<td><span class="details"><?=$ponencia->getArchivoConNombre()?></span></td>
	</tr>
	<tr>
		<th>Archivo <b>sin</b> nombres:</th>
		<td><span class="details"><?=$ponencia->getArchivoSinNombre()?></span></td>
	</tr>
	<tr>
		<th>Sala:</th>
		<td><span class="details"><?=$ponencia->getSala()?></span></td>
	</tr>
	<tr>
		<th>Hora:</th>
		<td><span class="details"><?=$ponencia->getHora()?></span></td>
	</tr>
	<tr>
		<th>Observaciones:</th>
		<td><span class="details"><?=$ponencia->getObservaciones()?></span></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><a href="admin_editponencia.php?pid=<?=$pid?>" class="button editponencia">Editar</a></td>
	</tr>
</table>
</form>