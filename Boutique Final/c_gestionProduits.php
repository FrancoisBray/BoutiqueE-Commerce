<?php
/**
	* On donne à la variable $action la valeur recupere dans les differentes vues
	*/

$action = $_REQUEST['action'];
switch($action)
{

	case 'connexion' :
		if(!estAdmin()){
		$Login='';$mdp='';
		include ("vues/v_administrer.php");
		}
		else{
			$lesCategories=getLesCategories();
			include("vues/v_categorieAdmin.php");
		}
		
		break;
	case 'confirmerConnexion'	:	
		$Login =$_REQUEST['Login'];
		$mdp=$_REQUEST['mdp'];
		$msgErreurs=getErreursConnexion($Login,$mdp);
		if(count($msgErreurs)!=0){
			
			include("vues/v_erreurs.php");
		}
		else {	
			enrAdmin($Login);
			$lesCategories=getLesCategories();
			
			include("vues/v_categorieAdmin.php");
		}
		break;
		
	 case 'voirProduits' :
		$lesCategories = getLesCategories();
		include("vues/v_categorieAdmin.php");
  		$idCategorie = $_REQUEST['idCategorie'];
		$_SESSION['cate']=$idCategorie;
		$lesProduits = getLesProduits($idCategorie);
		include("vues/v_produitsAdmin.php");
		break;
		
	case 'ajoutProduit' :
		$description='';
		$prix='';
		$fichier='';
		$lesCategories = getLesCategories();
		include("vues/v_categorieAdmin.php");
		include("vues/v_ajoutProduit.php");
		break;
		
	case 'confirmerAjout' :
		$idCategorie= $_SESSION['cate'];
		$description=$_REQUEST['desc'];
		$prix=$_REQUEST['prix'];
		$file=$_FILES['image'];
		$lesCategories = getLesCategories();
		include("vues/v_categorieAdmin.php");
		include("vues/v_ajoutProduit.php");
		$msgErreurs=getErreursAjout($description,$prix,$file);
		if(count($msgErreurs)!=0){
			
			include("vues/v_erreurs.php");
		}
		else {	
			ajoutProduit($description,$prix,$file);
		}
		break;
		
	case 'supprimerProduit' :
		$id=$_REQUEST['produit'];
		supprimerProduit($id);
		$lesCategories = getLesCategories();
		include("vues/v_categorieAdmin.php");
		break;
		
	case 'modifierProduit' :
		$lesCategories = getLesCategories();
		include("vues/v_categorieAdmin.php");
		$unId=$_REQUEST['produit'];
		$idCategorie = $_REQUEST['idCategorie'];
		$leProduit= getProduit($unId);
		include("vues/v_modifierProduit.php");
		break;
	
	case 'confirmerModif' :
		$descr=$_REQUEST['nvDescr'];
		$prix=$_REQUEST['nvPrix'];
		$id=$_REQUEST['produit'];
		$lesCategories = getLesCategories();
		include("vues/v_categorieAdmin.php");
		
		$msgErreurs=getErreursModif($descr,$prix);
		if(count($msgErreurs)!=0){
			$unId=$_REQUEST['produit'];
			$idCategorie = $_REQUEST['idCategorie'];
			$leProduit= getProduit($unId);
			include("vues/v_modifierProduit.php");
			include("vues/v_erreurs.php");
		}
		else {	
			modifierProduit($id,$descr,$prix);
			$lesCategories = getLesCategories();
		}
		
		break;
		case 'deconnexion' :
		 resetAdmin();
			include("vues/v_accueil.php");
		break;
		
		
		}
		
?>