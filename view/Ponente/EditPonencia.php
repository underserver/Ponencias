<?php global $ponencia;?>
<script type="text/javascript">
$().ready(function() {
	$("#settings").validate({
		rules: {
			titulo: "required"
			,resumen: "required"
			,fecha: "required"
			,ejetematico: "required"
			<?php if(!$ponencia->isWired()){?>
			,file1: "required"
			,file2: "required"
			<?php }?>
		},
		messages: {
			titulo: "Especifique un titulo de la ponencia",
			resumen: "Especifique un resumen breve de la ponencia",
			fecha: "Especifique una fecha de presentacion",
			ejetematico: "Especifique un eje tematico de la ponencia",
			file1: "Debe seleccionar el archivo CON nombres",
			file2: "Debe seleccionar el archivo SIN nombres"
		}
	});
});
</script>
<form action="Ponencia.php?action=persist" method="post" id="settings" enctype="multipart/form-data">
<table>
	<tr>
		<th>Titulo:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded" value="<?=$ponencia->getTitulo()?>"
			name="titulo" id="fn" size="30"> </span> 
		</td>
	</tr>
	<tr>
		<th>Fecha de presentaci&oacute;n:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded" value="<?=$ponencia->getFecha()?>"
			name="fecha" id="expire" size="30"> <input type="button"
			value="Calendario"
			onclick="displayCalendar(document.getElementById('expire'),'yyyy-mm-dd',this)"></span>
		</td>
	</tr>
	<tr>
		<th>Resumen:</th>
		<td><span class="errorbox-good"> <textarea name="resumen" rows="7" class="rounded"
			cols="60" id="supportcontact"><?=$ponencia->getResumen()?></textarea>
			</span>
		</td>
	</tr>
	<tr>
		<th>Eje Tematico:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded" value="<?=$ponencia->getEjeTematico()?>"
			name="ejetematico" id="fn" size="30"> </span>
		</td>
	</tr>
	<tr>
		<th>Archivo <b>con</b> nombres:</th>
		<td><span class="errorbox-good"><?=$ponencia->getArchivoConNombre()?> | <input type="file" name="file1" class="file"
			id="fn" size="30"></span>
	</tr>
	<tr>
		<th>Archivo <b>sin</b> nombres:</th>
		<td><span class="errorbox-good"> <?=$ponencia->getArchivoSinNombre()?> | <input type="file" name="file2" class="file"
			id="fn" size="30"></span>
	</tr>
	<tr class="finalrow">
		<th><input type="hidden" name="id" value="<?=$ponencia->getId()?>"></th>
		<td><input value="Guardar" name="save"
			class="mainbutton" onclick="clear_isset_monitoring();" type="submit">
		<input value="Cancelar" class="cancel"
			onclick="clear_isset_monitoring(); go('./Ponencia.php?id=<?=$ponencia->getId()?>');"
			name="Button" type="button"></td>
	</tr>
</table>
</form>