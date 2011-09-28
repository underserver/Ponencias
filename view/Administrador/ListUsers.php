<?php global $usuarios;?>
<p><?=i18n("users.info")?></p>

<form id="list" name="deleteItems"
	action="adminpanel_process.php?sale=<?=base64_decode($values["cid"])?>"
	method="post">
<table>
	<tr>
		<th colspan="3" class="tablebar"><input disabled="disabled"
			value="Eliminar Usuario(s)" id="deleteB"
			onclick="return deleteUser(deleteItems, './adminpanel_deleteuser.php');"
			type="button"></th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li id="count2"><b>1 - <?=count( $usuarios )?> de <?=count( $usuarios )?></b>
			</li>
		</ul>
		</th>
	</tr>
	<tr>
		<th id="header">ID</th>
		<th id="header"><input value="" name="select_all"
			onclick="cbTbl.selectAll(this); updateDeleteButtons(this);"
			type="checkbox"></th>
		<th id="header">Nombre</th>
		<th id="header">Tipo</th>
		<th id="header">Ponencias</th>
		<th id="header">Alias</th>
	</tr>
	<?php for( $i = 0;$i < count($usuarios); $i++){
	?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_<?=$i?>">
		<td><?=$usuarios[$i]->getId()?></td>
		<td><input value="true"
			name="COLLECTION_SELECTION_<?=$i?>.<?=$usuarios[$i]->getId()?>"
			onclick="cbTbl.selectOne(this); updateDeleteButtons(this);"
			type="checkbox"></td>
		<td><a href="javascript:void(0)"
			onclick="go( 'User.php?action=personal&id=$usuarios[$i]->getId()?>' );return false"><?=$usuarios[$i]->getNombre()?></a></td>
		<td><?=$usuarios[$i]->getTipo()?></td>
		<td><?=count($userPonencias)?></td>
		<td><?=$usuarios[$i]->getAlias()?></td>
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
		<th colspan="3" class="tablebar"><input disabled="disabled"
			value="Eliminar Usuario(s)" id="deleteT"
			onclick="return deleteUser(deleteItems, './adminpanel_deleteuser.php');"
			type="button"></th>
		<th colspan="4" class="tablebar">
		<ul class="inlinelist">
			<li id="count"><b>1 - <?=count( $usuarios )?> de <?=count( $usuarios )?></b>
			</li>
		</ul>

		</th>
	</tr>
</table>
</form>
