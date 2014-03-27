<?php
/**
	* On se connecte a la base de donnees
	*/
function connexion()
{
   $hote="localhost";
   $login="root";
   $mdp="";
   $connexion= mysql_connect($hote, $login, $mdp);
   $bd="Boutique";
   $query="SET CHARACTER SET utf8";
   // Modification du jeu de caractères de la connexion
   mysql_query($query, $connexion);
   mysql_select_db($bd, $connexion) or die("erreur select db");
   return $connexion;
}

/**
	* On recupere toutes les categories
	*/
function getLesCategories()
{
	$connexion = connexion();
	$req="select * from categorie";
   	$rsCategorie = mysql_query($req, $connexion);
   	$lgCategorie = mysql_fetch_array($rsCategorie);
   	$lesCategories=array();
	// Boucle sur les catégories
  	while ($lgCategorie != FALSE)
   	{ $idCategorie = $lgCategorie["idCategorie"];
	  $categorie = new Categorie($idCategorie,$lgCategorie["libelle"]);
      $lesCategories[$idCategorie]=$categorie;
	  $lgCategorie = mysql_fetch_array($rsCategorie);
   	}
	mysql_close();
	return $lesCategories;
}

/**
	* On recupere tous les produits dans une categorie
	*/
 function getLesProduits($uneCategorie)
{
	$connexion = connexion();
	$req="select * from produit where idCategorie = '$uneCategorie'";
	//echo $req;
   	$rsProduit = mysql_query($req, $connexion);
    $lgProduit = mysql_fetch_array($rsProduit);
   	$lesProduits = array();
   	while ($lgProduit != FALSE)
   	{
    	$produit = new Produit($lgProduit["idProduit"],$lgProduit["description"],$lgProduit["image"],$lgProduit["prix"],"");	
		$lesProduits[$lgProduit["idProduit"]]=$produit;		
		$lgProduit = mysql_fetch_array($rsProduit);
 	}
	mysql_close();
	return $lesProduits;
}

/**
	* On recupere un produit qui a ete selectionne
	*/
function getProduit($unId)
{	
	$connexion = connexion();
	$req="select * from produit where idProduit = '$unId'";
   	$rsProduit = mysql_query($req, $connexion);
    $lgProduit = mysql_fetch_array($rsProduit);
   	if ($lgProduit != FALSE)
   	{
    	$produit = new Produit($lgProduit["idProduit"],$lgProduit["description"],$lgProduit["image"],$lgProduit["prix"],"");	
	}
	mysql_close();
	return $produit;
}

/**
	* On remet a zero tout les articles contenus dans le panier
	*/
function initPanier()
{
	if(!isset($_SESSION['panier']))
		$_SESSION['panier']= new Panier();
}
/**
	* On ajoute au panier les articles selectionne
	*/
function ajouterAuPanier($idProduit,$quantite)
{	
	$_SESSION['panier']->ajoutItem($idProduit,$quantite);	
}

/**
	* On retire a chaque fois un article 
	*/
function retirerDuPanier($idProduit)
{
	$_SESSION['panier']->suppressionItem($idProduit,1);
}
/**
	* On recupere les produits contenu dans le panier
	*/
function getLesProduitsDuPanier()
{	
	$lesProduits = array();
	if (isset($_SESSION["panier"])){		
		$panier = $_SESSION["panier"]->recupPanier();		
		foreach($panier as $id => $qte)
		{
				$produit = getProduit($id);
				$lesProduits[]=$produit;
		}		
	}
	return $lesProduits;
}
/**
	* On recupere la quantite des articles contenus dans le panier
	*/
function getLesQuantitesDuPanier()
{	
	$lesQuantites = array();
	if (isset($_SESSION["panier"])){	
		$panier = $_SESSION["panier"]->recupPanier();	
		foreach($panier as $id => $qte)
		{
				$lesQuantites[]=$qte;
		}				
	}
	return $lesQuantites;		
}
/**
	* On creer la commande du panier
	*/
function creerCommande($nom,$rue,$cp,$ville,$mail )
{
	$connexion = connexion();
	$req="select max(idCommande) as maxi from commande";
   	$rsCategorie = mysql_query($req, $connexion);
   	$lgCategorie = mysql_fetch_array($rsCategorie);
   	$idCommande = $lgCategorie['maxi'];
   	$idCommande++;
	$date=date("Y-m-j");
   	$req = "insert into commande values ('$idCommande','$date','$nom','$rue','$cp','$ville','$mail')";
   	$rsCommande = mysql_query($req, $connexion);
   	$panier = $_SESSION['panier']->recupPanier();
	foreach($panier as $id=>$qte)
	{
		$req = "insert into contenir values ('$idCommande','$id',$qte)";
		$rsCategorie = mysql_query($req, $connexion);	
	}
	
	mysql_close();
	session_destroy();
}
/**
	* On supprime le produit avec la requete (Delete FROM)
	*/
function supprimerProduit($id)
{
	$connexion=connexion();
	$req="delete from produit where idProduit=$id";
	$reqSup=mysql_query($req,$connexion);
	echo "Le produit a bien ete supprime";
}
/**
	* On Modifie le produit apres verification
	*/
function modifierProduit($id,$descr,$prix)
{
	$connexion=connexion();
	$req="UPDATE produit SET description='$descr', prix='$prix' WHERE idProduit=$id";
	$reqMod=mysql_query($req,$connexion);
	if($reqMod==true){
		echo "L'article a bien ete modifie.";
	}
}
/**
	* On définit la valeur de session 
	*/
function enrAdmin($Login){
$_SESSION['admin']=$Login;
}
/**
	* On verifie la session "admin" 
	*/
function estAdmin(){
	if(isset($_SESSION['admin'])){
		return true;
	}
	else
		return false;
}
/**
	* On remet a zero la session "admin"
	*/
function resetAdmin(){
	unset($_SESSION['admin']);
}
/**
	* On verifie les donnees envoyées par le formulaire
	*/
function getErreursModif($descr,$prix)
{
 $lesErreurs = array();
if(!estNonVide($descr) || $descr == 1 )
 	$lesErreurs[]= "Veuillez entrer une description";
 if(!estNonVideEtEntier($prix))
 	$lesErreurs[]= "Veuillez entrer un prix entier";


 return $lesErreurs;
}
/**
	* On ajoute le produit dans la base de donnée
	*/
function ajoutProduit($description,$prix,$file)
{
	$connexion=connexion();
	$reqMax="select max(idProduit) from produit";
	$reqMaxId=mysql_query($reqMax,$connexion);
	$reqMaxID=mysql_fetch_array($reqMaxId);
	$idCategorie=$_SESSION['cate'];
	if($reqMaxID){
		$idMax=$reqMaxID[0]+1;
		}
	if(isset($file)){
     $dossier = 'images/'.$_SESSION['cate'].'/';
     $fichier = basename($file['name']);
     if(move_uploaded_file($file['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
		$image=$dossier.$fichier;
		$req="insert into produit values ('$idMax','$description','$prix','$image','$idCategorie')";
		$reqAjout=mysql_query($req);
		echo "L'ajout a ete execute avec succes.";
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          $lesErreurs[]="Echec de l\'upload !";
     }
	}
}
/**
	* on verifie les données avant l'ajout dans la base de données
	*/
function getErreursAjout($description,$prix,$file)
{
 $lesErreurs = array();
if(!estNonVide($description))
 	$lesErreurs[]= "Veuillez entrer une description";
 if(!estNonVideEtEntier($prix))
 	$lesErreurs[]= "Veuillez entrer un prix entier"; 
if ($file["error"]) // traitement des erreurs
{	echo "il y a une erreur<br>";
	$err=$file["error"] ;
	if ($err== UPLOAD_ERR_INI_SIZE)
		$lesErreurs[]="Le fichier est plus gros que le max autorisé par PHP";
	elseif ($err== UPLOAD_ERR_FORM_SIZE)
			$lesErreurs[]="le fichier est plus gros qu'indiqué dans le formulaire";
		elseif ($err== UPLOAD_ERR_PARTIAL)
				$lesErreurs[]="le fichier n'a été que partiellement téléchargé";
			elseif ($err==UPLOAD_ERR_NON_FILE)
				$lesErreurs[]="Aucun fichier n'a été téléchargé";
}
 return $lesErreurs;
}
/**
	* On verifie les donnees envoye pour se connecter en tant qu'admin
	*/
function connexionAdmin($Login,$mdp)
{
	$connexion=connexion();
	$retour = false;
	$req="select * from administrateur where nom='$Login' AND mdp='$mdp'";
	
	$connect=mysql_query($req,$connexion);
	$connect2=mysql_fetch_array($connect);
	
	if($connect2){
		$_SESSION['admin']= $connect2['nom'];
		$retour = true;
	}
	mysql_close();
	return $retour;
}
/**
	* On verifie si les champs sont pleins
	*/
function estNonVide($donnee)
{
	return (strlen($donnee)!=0);
}
/**
	* On verifie que le champ soit pleins et entier
	*/
function estNonVideEtEntier($donnee)
{
	return strlen ($donnee)!=0 && estEntier($donnee);
}
/**
	* On renvoit des erreurs concernant la connexion
	*/
function getErreursConnexion($Login,$mdp)
{
 $lesErreurs = array();
 if(!estNonVide($Login))
 	$lesErreurs[]= "erreur de Login";
 if(!estNonVide($mdp))
 	$lesErreurs[]= "erreur Mot de passe";
 $ret = connexionAdmin($Login,$mdp);
 if($ret!=true)
	$lesErreurs[]= "Erreur de mot de passe ou de Login";
 return $lesErreurs;
}

// Si la valeur transmise ne contient pas d'autres caractères que des chiffres,
// la fonction retourne vrai
/**
	* On verifie la validite du code postale
	*/
function estUnCp($codePostal)
{
   // Le code postal doit comporter 5 chiffres
   return strlen($codePostal)== 5 && estEntier($codePostal);
}
/**
	* On verifie si c'est un entier 
	*/
function estEntier($valeur)
{
   return !preg_match ("/^[^0-9]./", $valeur);
}
/**
	* On verifie la validite de l'adresse mail
	*/
function estUnMail($mail)
{
$regexp="/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
return preg_match ($regexp, $mail);
}
/**
	* On renvoit des erreurs concernant la commande
	*/
function getErreursSaisieCommande($cp,$mail)
{
 $lesErreurs = array();
 if(!estUnCp($cp))
 	$lesErreurs[]= "Erreur de code postal";
 if(!estUnMail($mail))
 	$lesErreurs[]= "Erreur de mail";

 return $lesErreurs;
}
?>
