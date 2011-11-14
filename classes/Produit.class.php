<?php
	class Produit 
	{
		private $Bob;
		private $cat;
		private $img;
		
		private $id;
		private $nom;
		private $desc;
		
		private $stock;
		private $nbVentes;
		private $nbLoc;
		private $prixVente;
		private $prixLoc;
		
		public function getNom() { return $this->nom; }
		
		public function __construct($Bob, $cat, $nom, $desc, $stock, 
		                            $nbVentes, $nbLoc, $prixVente, $prixLoc, $id = 0)
		{
			$this->Bob = $Bob;
			$this->nom = $nom;
		}
	}
?>