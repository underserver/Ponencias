<form action="action_newponencia.php" method="post" id="settings" enctype="multipart/form-data">
<table>
	<tr>
		<th>Titulo:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded" value="<?=$_GET["title"]?>"
			name="title" id="fn" size="30"> </span> <?php if( strpos( $fields, 'title' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th>Fecha de presentaci&oacute;n:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded" value="<?=$_GET["date"]?>"
			name="date" id="expire" size="30"> <input type="button"
			value="Calendario"
			onclick="displayCalendar(document.getElementById('expire'),'yyyy-mm-dd',this)"></span>
			<?php if( strpos( $fields, 'date' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th>Resumen:</th>
		<td><span class="errorbox-good"> <textarea name="summary" rows="7" class="rounded"
			cols="60" id="supportcontact"><?=$_GET["summary"]?></textarea> <?php if( strpos( $fields, 'summary' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></span>
		</td>
	</tr>
	<tr>
		<th>Eje Tematico:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded" value="<?=$_GET["title"]?>"
			name="eje" id="fn" size="30"> </span> <?php if( strpos( $fields, 'eje' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th>Archivo <b>con</b> nombres:</th>
		<td><span class="errorbox-good"> <input type="file" name="file1" class="file"
			id="fn" size="30"> <?php if( strpos( $fields, 'file1' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></span>
	</tr>
	<tr>
		<th>Archivo <b>sin</b> nombres:</th>
		<td><span class="errorbox-good"> <input type="file" name="file2" class="file"
			id="fn" size="30"> <?php if( strpos( $fields, 'file2' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></span>
	</tr>
	<tr class="finalrow">
		<th></th>
		<td><input value="<?=$_i18n["savechange"]?>" name="save"
			class="mainbutton" onclick="clear_isset_monitoring();" type="submit">
		<input value="<?=$_i18n["cancel"]?>" class="cancel"
			onclick="clear_isset_monitoring(); go('./adminpanel.php');"
			name="Button" type="button"></td>
	</tr>
</table>
</form>