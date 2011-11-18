<?php
	class Commentaire {
		private $Bob;
		private $membre;
		private $produit;
		private $id;
		private $titre;
		private $note;
		private $desc;
		private $date;
		
		public function __construct($Bob, $membre, $produit, 
									$titre, $note, $desc, $date,
									$id = 0)
		{
			$this->Bob = $Bob;
			$this->membre = $membre;
			$this->produit = $produit;
			
			$this->id = $id;
			$this->titre = $titre;
			$this->note = $note;
			$this->desc = $desc;
			$this->date = $date;
		}
	}
	
	class Reponse extends Commentaire {
		private $admin;
	}	
?>