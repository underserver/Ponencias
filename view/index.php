<br>
<div class="section">&nbsp;Entrar al sistema</div>
<table border="0" cellpadding="0" style="text-align: center;"
	cellspacing="0" style="width:200px">
	<tbody>
		<tr>
			<td valign="top">
			<div class="">
			<form action="UsuarioLogin.php?action=login" method="post" name="settings">
			<table style="margin: 15px 0pt 0pt;" border="0" cellpadding="0"
				cellspacing="0">
				<tbody>
					<tr>
						<th align="right" nowrap="nowrap"><?=i18n("user")?> :&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<td>
							<input name="userName" size="35" type="text" class="rounded">
							<?php if( strpos( $fields, 'userName' ) ){?><br><span class="errormsg" id="errormsg_0"> <?=$_i18n[ "error.required" ]?></span><?php } ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td
							style="overflow: hidden; color: rgb(68, 68, 68); font-size: 75%;"
							dir="ltr" align="right"></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3" height="8"></td>
					</tr>
					<tr>
						<td colspan="2" height="8"></td>
					</tr>
					<tr>
						<th align="right" nowrap="nowrap"><?=i18n("pass")?> :&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<td><input name="userPassword" size="35" type="password" class="rounded"> <?php if( strpos( $fields, 'userPassword' ) ){?><br>
						<span class="errormsg" id="errormsg_0"> <?=$_i18n[ "error.required" ]?>
						</span><?php } ?></td>
					</tr>
					<tr>
						<td colspan="2" height="8"></td>
					</tr>
					<tr>
						<td colspan="2" height="8"></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td><input value="<?=i18n("access")?>" type="submit"></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		
		</tr>
	</tbody>
</table>

<div class="section">&nbsp;Registrarse como</div>

<div class="grid-1x5">
					  <a href="register.php?type=0" class="registro conferencista">Conferencista</a>
					  <a href="register.php?type=1" class="registro coautor">Coautor</a>
					  <a href="register.php?type=2" class="registro asistente">Asistente</a>
					  <a href="register.php?type=3" class="registro evaluador">Evaluador</a>
</div>