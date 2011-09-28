<?php global $ponencias;?>

<ul class="inlinelist">
	<li class="main1"><a href="Ponencia.php?action=create" onclick="document.location='admin_newponencia.php'">Nueva ponencia</a></li>
	<li><a href="./">Ver otras ponencias</a></li>
</ul>
<p>Debe estar registrado como ponente o autor para crear una nueva ponencia</p>


<form id="list" name="deleteItems" action="EvaluarPonencias.php" method="post">
	<table>
	<tr>
		<th colspan="3" class="tablebar"><input disabled="disabled"
			value="Eliminar ponencias" id="deleteB"
			onclick="removeAll(); return false;"
			type="button">
		</th>
		<th colspan="4" class="tablebar">
			<ul class="inlinelist">
				<li id="count2"><b>1 - <?=count( $ponencias )?> de <?=count( $ponencias )?></b></li>
			</ul>
		</th>
	</tr>
	<tr>
		<th id="header" style="text-align: center">ID</th>
		<th id="header"><input value="" name="select_all" onclick="cbTbl.selectAll(this); updateDeleteButtons(this);" type="checkbox"></th>
		<th id="header">Titulo</th>
		<th id="header">Fecha</th>
		<th id="header">Eje tematico</th>
		<th id="header">Estado</th>
	</tr>
	<?php for( $i = 0, $subtotal = 0; $i < count($ponencias); $i++){?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_<?=$i?>">
		<td style="text-align: center"><?=$ponencias[$i]->getId()?></td>
		<td style="width: 40px"><input value="true" <?=($ponencias[$i]->getStatus()==PonenciaStatus::$EN_EVALUACION)?"disabled":""?>
			name="COLLECTION_SELECTION_<?=$i?>.<?=$ponencias[$i]->getId()?>"
			onclick="cbTbl.selectOne(this); updateDeleteButtons(this);"
			type="checkbox"></td>
		<td><a href="javascript:void(0)"
			onclick="goto( 'Ponencia.php?id=<?=$ponencias[$i]->getId()?>&action=view' );"><?=$ponencias[$i]->getTitulo()?></a></td>
		<td><?=$ponencias[$i]->getFecha()?></td>
		<td><?=$ponencias[$i]->getEjeTematico()?></td>
		<td style="width: 180px;"><span class="icon-status PS-<?=$ponencias[$i]->getStatus()?>"></span><?=i18n("PONENCIA_STATUS_".$ponencias[$i]->getStatus())?></td>
	</tr>
	<?php }
	if( $i == 0 ){ ?>
		<tr class="" id="ARTICLE_COLLECTION_SELECTION_0">
			<td colspan="7" align="center">
				<em>No tiene ninguna ponencia asiganda para evaluación</em>
			</td>
		</tr>
	<?php } ?>

	<tr>
		<th colspan="3" class="tablebar"><input disabled="disabled"
			value="Eliminar ponencias" id="deleteT"
			onclick="removeAll(); return false;"
			type="button"></th>
		<th colspan="4" class="tablebar">
			<ul class="inlinelist">
				<li id="count"><b>1 - <?=count( $ponencias )?> de <?=count( $ponencias )?></b></li>
			</ul>
		</th>
	</tr>
	</table>
</form>
<script type="text/javascript"> 
function removeAll(id){
	if( confirm("¡Desea eliminar las ponencias seleccionadas?") ){
		$("#content").showLoading();
		var ponencias = "";
		for (i=0,n=deleteItems.elements.length;i<n;i++){
			if (deleteItems.elements[i].name.indexOf('COLLECTION_SELECTION_') !=-1 && deleteItems.elements[i].checked == true){
				name = deleteItems.elements[i].name;
				ponencias += name.substring( name.lastIndexOf( "." )+1 ) + ",";
			}
		}
		ponencias = ponencias.substring(0, ponencias.length - 1);
		$.ajax({
			type: "POST",
			url: "Ponencia.php?action=removeAll",
			data: "ids=" + ponencias,
			success: function(response){
				$("#content").fadeIn(2000);
				$("#content").html(response);
			$("#content").hideLoading();
			}
		});
	}
}
</script>