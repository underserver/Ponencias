<?php global $ponencia, $evaluaciones, $evaluadores;?>
<form action="#" method="post" id="settings" enctype="multipart/form-data">
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
</table>
</form>
<div class="subtitle">Seleccionar Evaluadores</div>
<form action="#" method="post" id="list" enctype="multipart/form-data">
<table>
	<tr>
		<th colspan="4" class="tablebar"></th>
	</tr>
	<tr>
		<th id="header" ><input value="" name="select_all"
			onclick="cbTbl.selectAll(this); updateDeleteButtons(this);"
			type="checkbox"></th>
		<th id="header">Nombre</th>
		<th id="header">Correo</th>
		<th id="header">Alias</th>
	</tr>
	<?php for( $i = 0; $i < count($evaluadores); $i++){
		$seleccionado = false;
		for( $j = 0; $j < count($evaluaciones); $j++ ){
			if( $evaluaciones[$j]->getEvaluador()->getId() == $evaluadores[$i]->getId() ){
				$seleccionado = true;
			}
		}
	?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_<?=$i?>">
		<td style="width: 40px"><input value="true"
			name="COLLECTION_SELECTION_<?=$i?>.<?=$evaluadores[$i]->getId()?>"
			onclick="cbTbl.selectOne(this); updateDeleteButtons(this);"
			<?=($seleccionado ? 'checked' : '')?>
			type="checkbox"></td>
		<td><?=$evaluadores[$i]->getNombre()?> <?=$evaluadores[$i]->getApellidos()?></td>
		<td><?=$evaluadores[$i]->getCorreo()?></td>
		<td><?=$evaluadores[$i]->getAlias()?></td>
	</tr>
	<?php
}
if( $i == 0 ){
	?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_0">
		<td colspan="7" align="center"><em>No existe ningun usuario</em></td>
	</tr>
	<?php } ?>

	<tr>
		<th colspan="4" class="tablebar"></th>
	</tr>
</table>
</form>