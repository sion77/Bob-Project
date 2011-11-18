<?php

	class Commentaire {
		private $membre;
		private $produit;
		private $id;
		private $titre;
		private $note;
		private $desc;
		private $date;
	}
	
	class Reponse extends Commentaire {
		private $admin;
	}
	
?>