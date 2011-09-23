<br>
<div class="section">&nbsp;Entrar al sistema</div>
<table border="0" cellpadding="0" style="text-align: center; margin: 20px auto" align="center"
	cellspacing="0" style="width:200px">
	<tbody>
		<tr>
			<td valign="top">
			<div class="">
			<form action="UsuarioLogin.php?action=login" method="post" name="settings">
			<div>
			<table border="0" cellpadding="0"
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
						<td style="padding-left:60px"><a href="#" class="button enter" onclick="settings.submit()">Entrar</a></td>
						<td></td>
					</tr>
				</tbody>
			</table>
			</div>
		</tr>
	</tbody>
</table>

<div class="section">&nbsp;Registrarse como</div>

<div class="grid-1x5">
					  <a href="register.php?type=1&sub=0" class="registro conferencista">Ponente</a>
					  <a href="register.php?type=2&sub=1" class="registro coautor">Coautor</a>
					  <a href="register.php?type=5&sub=2" class="registro asistente">Asistente</a>
					  <a href="register.php?type=4&sub=3" class="registro evaluador">Evaluador</a>
</div>