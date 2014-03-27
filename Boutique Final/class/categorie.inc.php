<?PHP
class Categorie {
	private $id;
	private $libelle;
/**
	* On creer un constructeur 
	*/	
	function __construct($unId, $unLibelle){ // constructeur
		$this->id = $unId;
		$this->libelle = $unLibelle;
	}
	/**
	* methode qui recupere l'id d'une categorie
	*/
	public function getId(){
		return $this->id ;
	}
	/**
	* methode qui recupere le libelle d'un produit
	*/
	public function getLibelle(){
		return $this->libelle;
	}	
} 
?>