<?PHP
class Produit {
	private $id;
	private $description;
	private $image;
	private $prix;
	private $quantite;

	// constructeur
	/**
	* On creer un constructeur
	*/
	function __construct($unId, $uneDescription, $uneImage, $unPrix, $uneQuantite){ // constructeur
		$this->id = $unId;
		$this->description = $uneDescription;
		$this->image = $uneImage;
		$this->prix = $unPrix;
		$this->quantite = $uneQuantite;
	}

	// accesseur
	/**
	* methode recuperant l'id d'un produit
	*/
	public function getId(){
		return $this->id ;
	}
	/**
	* On recupere la description d'un produit
	*/
	public function getDescription(){
		return $this->description;
	}
	/**
	* On recupere l'image d'un produit
	*/
	public function getImage(){
		return $this->image ;
	}
	/**
	* On on recupere le prix d'un produit
	*/
	public function getPrix(){
		return $this->prix;
	}
} // fin de la classe
?>