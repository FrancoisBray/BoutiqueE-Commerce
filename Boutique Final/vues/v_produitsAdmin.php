
<SCRIPT LANGUAGE="JavaScript"> 
function confirmation(id) { 
var msg = "Êtes-vous sur de vouloir supprimer cet article ?"; 
//var id=document.getElementById('id').value;
var idCategorie=document.getElementById('cate').value;

if (confirm(msg)) 
window.location=("index.php?uc=administrer&idCategorie="+idCategorie+"&produit="+id+"&action=supprimerProduit"); 
} 
</SCRIPT> 
<div id="prod" style="
    margin-left: 16%;
    margin-right: 16%;
    background-color: white;
">
<?php
echo "<table>";
/**
	* Recherche en boucle des produits dans chaques catégories
	*/
	$i = 1;
foreach( $lesProduits as $unProduit) 
{
	$id = $unProduit->getId();
	$description = $unProduit->getDescription();
	$image = $unProduit->getImage();
	$prix = $unProduit->getPrix();
	echo "<input type='hidden' id='id'.$i.'value='$id'/>
		<input type='hidden' id='cate' value='$idCategorie'/>
		";
	$url2 = 'index.php?uc=administrer&idCategorie='.$idCategorie.'&produit='.$id.'&action=supprimerProduit';
	$url3 = 'index.php?uc=administrer&idCategorie='.$idCategorie.'&produit='.$id.'&action=modifierProduit';

	echo "<tr>
			<td width=150><img src='$image' alt=image width=100	height=100 /></td>
			<td width=30%>$description</td>
			<td width=35%>$prix €</td>
			<td><form method='POST' action='".$url2."''><input type='button' value='Supprimer un produit' onClick='confirmation($id)' style='width : 150px;' /></form>
			<form method='POST' action='".$url3."'><input type='submit' value='Modifier un produit' style='width : 150px;'/></form></td></tr>
			";
	
}
$url = 'index.php?uc=administrer&action=ajoutProduit';
echo "<form method='POST' action='".$url."'><input type='submit' value='Ajouter un produit' size='10'/></form><br>";

?>
</table>
</div>
