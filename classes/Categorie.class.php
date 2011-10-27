<?php
	class Categorie
	{
		private $Bob
		
		private $mere;
		private $fils;
		private $nb_fils;
		
		private $id;
		private $nom;
		private $desc;
		
		public function getId() { return $this->id; }
		public function getNom() { return $this->nom; }
		public function getDesc() { return $this->desc; }
		public function getMere() { return $this->mere; }
		
		public function __construct($Bob, $id, $nom, $desc, $mere)
		{
			$this->Bob = $Bob;
			$this->mere = $mere;
			
			$this->id = $id;
			$this->nom = $nom;
			$this->desc = $desc;
			
			$this->fils = NULL;
			$this->nb_fils = 0;
			
			$this->initFils();
		}
		
		private function initFils()
		{
			if($this->fils != NULL)
				return false;
			
			$req = $this->Bob->prepare("SELECT  idCat AS \"id\",
												descriptionCat AS \"desc\",
												nomCat AS \"nom\"
										FROM categorie
										WHERE idParent IS NOT NULL AND idParent = ?
										ORDER BY id");	
			
			$req->execute(array($this->id));
			
			$this->nbFils = 0;
			while($rep = $req->fetch())
			{
				$f = new Categorie($this->Bob,
								   $rep["id"],
								   $rep["nom"],
								   $rep["desc"],
								   $this->id);
								   
				$this->fils[$this->nbFils] = $f;
				$this->nbFils++;
			}
			$req->closeCursor();
			
			return true;			
		}
			
		public function getCategorie($id)
		{
			if($id == $this->id)
				return $this;
				
			$i = 0;
			while($i < $this->nbFils && !$trouve)
			{
				$trouve = ($this->fils[$i]->getCategorie());
				$i++;
			}
			
			return $trouve;
		}
	}
?>