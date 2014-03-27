<?php

 $hote="localhost";
 $login="root";
 $mdp="";
 $connexion= mysql_connect($hote, $login, $mdp);
 $bd="Boutique";
 $query="SET CHARACTER SET utf8";
 // Modification du jeu de caractères de la connexion
 mysql_query($query, $connexion);
 mysql_select_db($bd, $connexion) or die("erreur select db");

$req = "select idProduit,description, prix, idCategorie  from produit";
$sth = mysql_query($req);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}
//print json_encode($rows);

$fichierjson = fopen("test.json", "w");
$ligne = json_encode($rows);
fwrite($fichierjson,$ligne);
fclose($fichierjson);
?>