<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<title>jShoop &rsaquo; Configuración</title> 
<link rel="stylesheet" href="install.css" type="text/css" /> 
 
</head> 
<body> 
<h1 id="logo"><img alt="jshoop" src="../images/logo.jpg" /></h1> 
<form method="post" action="update.php"> 
	<p>A continuación se le pedirá información sobre su base de datos. Si no conoce algún parametro consulte a su administrador. </p> 
	<table class="form-table"> 
		<tr> 
			<th scope="row"><label for="dbname">Base de datos</label></th> 
			<td><input name="dbname" id="dbname" type="text" size="25" value="jshop" /></td> 
			<td>El nombre de la base de datos. </td> 
		</tr> 
		<tr> 
			<th scope="row"><label for="uname">Usuario</label></th> 
			<td><input name="uname" id="uname" type="text" size="25" value="root" /></td> 
			<td>Su usuario de MySQL</td> 
		</tr> 
		<tr> 
			<th scope="row"><label for="pwd">Contraseña</label></th> 
			<td><input name="pwd" id="pwd" type="password" size="21" value="samurai1" /></td> 
			<td>...y la contraseña del usuario.</td> 
		</tr> 
		<tr> 
			<th scope="row"><label for="dbhost">Servidor</label></th> 
			<td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" /></td> 
			<td>Si la base de datos esta en el mismo equipo no es necesario modificar nada</td> 
		</tr> 
	</table> 
	<p class="step"><input name="submit" type="submit" value="Submit" class="button" /></p> 
</form> 
</body> 
</html>