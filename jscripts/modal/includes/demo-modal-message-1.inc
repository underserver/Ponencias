<form name="myForm">
	<table border="0">
		<tr>
			<td colspan="2"><img src="/images/heading3.gif"></td>
		</tr>
		<tr>
			<td><label for="firstname">Firstname:</label></td>
			<td><input type="text" name="firstname" id="firstname"></td>
		</tr>
		<tr>
			<td><label for="lastname">Lastname:</label></td>
			<td><input type="text" name="lastname" id="lastname"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="button" value="Close" onclick="closeMessage()">
			<input type="button" value="Send" onclick="closeMessage()"></td>
		</tr>
	</table>
	<script type="text/javascript">
	document.myForm.firstname.focus();
	</script>
</form>