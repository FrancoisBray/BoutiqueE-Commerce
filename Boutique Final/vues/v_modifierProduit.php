<div id="prod" style="
    margin-left: 16%;
    margin-right: 16%;
    background-color: white;
">
<?php
echo "<table>";

	$id = $leProduit->getId();
	$description = $leProduit->getDescription();
	$prix =  $leProduit->getPrix();
	$image =  $leProduit->getImage();
	$url = 'index.php?uc=administrer&idCategorie='.$idCategorie.'&produit='.$id.'&action=confirmerModif';
    echo "<form method='POST' action='$url'>";
	echo "<tr>
			<td width=150><img src='$image' alt=image width=100	height=100 /></td>
			<td width=30%>$description</td>
			<td width=30%>$prix Euros</td>
			<td width=30%>Nouvelle description :<input type='text' name='nvDescr' value ='1' size='2' /><br>
			Nouveau prix :<input type='text' name='nvPrix' value ='1' size='2' /><br>
			<input type='submit' value='Modifier'  /></td>";
	echo "</form>";

?>
</table>
</div>