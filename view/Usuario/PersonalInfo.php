<?php global $usuario;?>
<form action="Usuario.php?action=persist" method="post" id="settings"><input
	type="hidden" name="id" value="<?=$usuario->getId()?>">
<table>
	<tr>
		<th>Nombre:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded"
			value="<?=$usuario->getNombre()?>" name="user_name" id="fn" size="30">
		</span> <?php if( strpos( $fields, 'user_name' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th>Apellidos:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded"
			value="<?=$usuario->getApellidos()?>" name="user_lastname" id="fn"
			size="30"> </span> <?php if( strpos( $fields, 'user_lastname' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>

	<tr>
		<th>Fecha de Nacimiento:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded"
			value="<?=$usuario->getFechaNacimiento()?>" name="user_born"
			id="user_born" size="30"> <input type="button" value="Calendario"
			onclick="displayCalendar(document.getElementById('user_born'),'yyyy-mm-dd',this)"></span>
			<?php if( strpos( $fields, 'user_born' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th>Direccion:</th>
		<td><span class="errorbox-good"> <textarea name="user_address" class="rounded"
			rows="6" cols="40" id="supportcontact"><?=$usuario->getDireccion()?></textarea>
			<?php if( strpos( $fields, 'user_address' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></span>
		</td>
	</tr>
	<tr>
		<th>Telefono:</th>
		<td><span class="errorbox-good"> <input type="text" name="user_phone" class="rounded"
			value="<?=$usuario->getTelefono()?>" id="fn" size="30"> </span> <?php if( strpos( $fields, 'user_phone' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr>
		<th>Correo Electronico:</th>
		<td><span class="errorbox-good"> <input type="text" name="user_mail" class="rounded"
			value="<?=$usuario->getCorreo()?>" id="fn" size="30"> </span> <?php if( strpos( $fields, 'user_mail' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
	</tr>
	<tr class="finalrow">
		<th></th>
		<td><input value="Guardar" name="save"
			class="mainbutton" onclick="clear_isset_monitoring();" type="submit">
		<input value="Cancelar" class="cancel"
			onclick="clear_isset_monitoring(); go('./');" name="Button"
			type="button"></td>
	</tr>
</table>
</form>