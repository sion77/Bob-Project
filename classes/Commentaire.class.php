<?php
	class Commentaire {
		private $Bob;
		private $membre;
		private $produit;
		
		private $reponses;
		private $nbReponses;
		
		private $id;
		private $nom;
		private $note;
		private $desc;
		private $date;
		
		public function getMembre() { return $this->membre; }
		public function getProduit() { return $this->produits; }
		public function getReponses() { return $this->reponses; }
		
		public function getId() { return $this->id; }
		public function getNom() { return $this->membre; }
		public function getNote() { return $this->note; }
		public function getDesc() { return $this->texte; }
		public function getDate() { return $this->date; }
		
		public function __construct($Bob, $membre, $produit, 
									$nom, $note, $texte, $date,
									$id = 0)
		{
			$this->Bob = $Bob;
			$this->membre = $membre;
			$this->produit = $produit;
			
			$this->reponses = NULL;
			$this->nbReponses = 0;
			
			$this->id = $id;
			$this->nom = $nom;
			$this->note = $note;
			$this->texte = $texte;
			$this->date = $date;
		}
	}
	
	class Reponse extends Commentaire {
		private $admin;
		private $commentaire;
	}	
?>