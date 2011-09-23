<?php global $usuario;?>
<form action="Usuario.php?action=persist"
	onsubmit="return validatePass('pass1','pass2')" method="post"
	id="settings">
<input type="hidden" name="id" value="<?=$usuario->getId()?>">
<table>
	<tr>
		<th>Alias:</th>
		<td><span class="errorbox-good"> <b><em> <?=$usuario->getAlias()?></em>
		</b></span></td>
	</tr>
	<tr>
		<th>Contrase&ntilde;a actual:</th>
		<td><span class="errorbox-good"> <input type="password"  class="rounded"
			name="pass_now" value="" id="fn" size="30"> <br>
			<?=$_i18n["accessinfo1"]?> </span> <?php if( strpos( $fields, 'pass_now' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th>Contrase&ntilde;a nueva:</th>
		<td><span class="errorbox-good"> <input type="password" name="pass" class="rounded"
			value="" id="pass1" size="30"> </span> <?php if( strpos( $fields, 'pass' ) ){?><br>
		<span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?>
		</td>
	</tr>
	<tr>
		<th>Confirmar contrase&ntilde;a:</th>
		<td><span class="errorbox-good"> <input type="password" name="pass_re" class="rounded"
			value="" id="pass2" size="30"> <input type="button"
			value="Validar"
			onclick="validatePass1('pass1','pass2')"></span></td>
	</tr>

	<tr class="finalrow">
		<th></th>
		<td><input value="Guardar" class="mainbutton"
			onclick="clear_isset_monitoring();" type="submit"> <input
			value="Cancelar" class="cancel"
			onclick="clear_isset_monitoring(); go('./');" name="Button"
			type="button"></td>
	</tr>
</table>
</form>