<ul id="categories">
<?php
 echo "<legend><strong>Categories</strong></legend>";
 
foreach( $lesCategories as $uneCategorie) 
{
	$idCategorie = $uneCategorie->getId();
	$libCategorie = $uneCategorie->getLibelle();
	$url ="<a href=index.php?uc=administrer&idCategorie=$idCategorie&action=voirProduits> $libCategorie </a>";
	echo "<li>".$url."</li>\n";

	}
?></ul>