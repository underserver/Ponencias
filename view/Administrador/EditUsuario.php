<?php global $usuario;?>
<form action="AdminUsuario.php?action=persist" method="post" id="settings"><input
	type="hidden" name="id" value="<?=$usuario->getId()?>">
<div class="subtitle">Datos Generales</div>
<table>
	<tr>
		<th>Nombre:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded"
			value="<?=$usuario->getNombre()?>" name="user_name" id="fn" size="30"></span>
		</td>
	</tr>
	<tr>
		<th>Apellidos:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded"
			value="<?=$usuario->getApellidos()?>" name="user_lastname" id="fn" size="30"> </span>
		</td>
	</tr>

	<tr>
		<th>Fecha de Nacimiento:</th>
		<td><span class="errorbox-good"> <input type="text" class="rounded"
			value="<?=$usuario->getFechaNacimiento()?>" name="user_born"
			id="user_born" size="30"> <input type="button" value="Calendario"
			onclick="displayCalendar(document.getElementById('user_born'),'yyyy-mm-dd',this)"></span>
		</td>
	</tr>
	<tr>
		<th>Direccion:</th>
		<td><span class="errorbox-good"> <textarea name="user_address" class="rounded"
			rows="6" cols="40" id="supportcontact"><?=$usuario->getDireccion()?></textarea>
		</td>
	</tr>
	<tr>
		<th>Telefono:</th>
		<td><span class="errorbox-good"> <input type="text" name="user_phone" class="rounded"
			value="<?=$usuario->getTelefono()?>" id="fn" size="30"> </span> 
		</td>
	</tr>
	<tr>
		<th>Correo Electronico:</th>
		<td><span class="errorbox-good"> <input type="text" name="user_mail" class="rounded"
			value="<?=$usuario->getCorreo()?>" id="fn" size="30"> </span>
		</td>
	</tr>
	<tr>
		<td colspan="2"><div class="subtitle">Datos de la cuenta</div></td>
	</tr>
	<tr>
		<th>Alias:</th>
		<td>
			<span class="errorbox-good"> <b><em> <?=$usuario->getAlias()?></em></b></span>
		</td>
	</tr>
	<tr>
		<th>Contrase&ntilde;a actual:</th>
		<td><span class="errorbox-good"> <input type="password"  class="rounded"
			name="user_password" value="" id="fn" size="30"> 
		</td>
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