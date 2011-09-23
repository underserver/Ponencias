<?php global $ponencia, $evaluacion;?>
<form action="EvaluarPonencia.php" method="post" id="settings" enctype="multipart/form-data">
<table>
<tr>
<td valign="top">
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
		<td><span class="details"><span class="icon-status PS-<?=$ponencia->getStatus()?>"></span><?=i18n('PONENCIA_STATUS_'.$ponencia->getStatus())?></span></td>
	</tr>
	<tr>
		<th>Resumen:</th>
		<td><span class="details"><?=$ponencia->getResumen()?></span></td>
	</tr>
	<tr>
		<th>Archivo:</th>
		<td><span class="details"><a href="#" class="button file"><?=$ponencia->getArchivoSinNombre()?></a></span></td>
	</tr>
	<tr>
		<th>Sala:</th>
		<td><span class="details"><?=$ponencia->getSala()?></span></td>
	</tr>
	<tr>
		<th>Hora:</th>
		<td><span class="details"><?=$ponencia->getHora()?></span></td>
	</tr>
</table>
</td>
<td style="border-left: 1px solid #ccc; padding-left: 30px;padding-right: 100px;" valign="top">
<table>
	<tr>
		<td class="eval">Evaluaci&oacute;n:</td>
	</tr>
	<tr>
		<td class="left">Calificaci&oacute;n:</td>
	</tr>
	<tr class="<?=( strpos( $fields, 'calif' ) ? "err" : "" )?>">
    <td>
      <span class="radio"><input type="radio" name="calif" value="0" id="rate1"  <?=($evaluacion->getCalificacion()==0?"selected":"")?>/> <br>&nbsp;&nbsp;0</span>
      <span class="radio"><input type="radio" name="calif" value="1" id="rate2"  <?=($evaluacion->getCalificacion()==1?"selected":"")?> /> <br>&nbsp;&nbsp;1</span>
      <span class="radio"><input type="radio" name="calif" value="2" id="rate3"  <?=($evaluacion->getCalificacion()==2?"selected":"")?> /> <br>&nbsp;&nbsp;2</span>
      <span class="radio"><input type="radio" name="calif" value="3" id="rate4"  <?=($evaluacion->getCalificacion()==3?"selected":"")?> /> <br>&nbsp;&nbsp;3</span>
      <span class="radio"><input type="radio" name="calif" value="4" id="rate5"  <?=($evaluacion->getCalificacion()==4?"selected":"")?> /> <br>&nbsp;&nbsp;4</span>
      <span class="radio"><input type="radio" name="calif" value="5" id="rate1"  <?=($evaluacion->getCalificacion()==5?"selected":"")?> /> <br>&nbsp;&nbsp;5</span>
      <span class="radio"><input type="radio" name="calif" value="6" id="rate2"  <?=($evaluacion->getCalificacion()==6?"selected":"")?> /> <br>&nbsp;&nbsp;6</span>
      <span class="radio"><input type="radio" name="calif" value="7" id="rate3"  <?=($evaluacion->getCalificacion()==7?"selected":"")?> /> <br>&nbsp;&nbsp;7</span>
      <span class="radio"><input type="radio" name="calif" value="8" id="rate4"  <?=($evaluacion->getCalificacion()==8?"selected":"")?> /> <br>&nbsp;&nbsp;8</span>
      <span class="radio"><input type="radio" name="calif" value="9" id="rate5"  <?=($evaluacion->getCalificacion()==9?"selected":"")?> /> <br>&nbsp;&nbsp;9</span>
      <span class="radio"><input type="radio" name="calif" value="10" id="rate5" <?=($evaluacion->getCalificacion()==10?"selected":"")?> /> <br>&nbsp;&nbsp;10</span>
    </td>
	</tr>
	<tr>
		<td class="left">Observaciones:</td>
	</tr>
	<tr>
		<td><textarea name="observaciones" class="rounded" rows="8" cols="60"><?=$evaluacion->getObservaciones()?></textarea></td>
	</tr>
	<tr>
		<td class="left">Dictamen:</td>
	</tr>
	<tr class="<?=( strpos( $fields, 'dictamen' ) ? "err" : "" )?>">
		<td>
			<input type="file" name="dictamen">
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="hidden" name="id" value="<?=$ponencia->getId()?>">
			<a href="javascript:document.forms[0].submit();" class="button senddictamen">Enviar dictamen</a>
		</td>
	</tr>
</table>
</td>
</tr>
</table>
</form>