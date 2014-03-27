<img src="images/panier.gif"	alt="Panier" title="panier"/>
<img src="images/panier.jpg"	alt="Panier" title="panier"/>
<?php
echo"<fieldset>";
/**
	* On déclare la variable pour compter le nombre de donnees
	*/
$i=0;
foreach( $lesProduits as $unProduit) 
{
	$id = $unProduit->getId();
	$description = $unProduit->getDescription();
	$image = $unProduit->getImage();
	$quantite = $lesQuantites[$i];
	$prix	=	($unProduit->getPrix()*$quantite);
	$i++;
	$url ="<a href=index.php?uc=gererPanier&produit=$id&action=supprimerUnProduit>supprimer </a>";
	
	echo "
			<p><img src=".$image." alt=image width=100	height=100 />
			$description
			($prix €)
			$quantite
			$url
			</p>";
}
?>
<br>
<a href=index.php?uc=gererPanier&action=passerCommande>Passer la commande</a>
