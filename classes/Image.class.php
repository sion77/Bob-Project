<?php
	class Image {
				
		private $id;
		private $desc;
		private $titre;
		private $type;
		private $binary;
		private $taille;
		
		private $illustre;
		private $nbIllustre;
		
		private $Bob;
		private static $maxId = 0;
		
		public function getId() { return $this->id; }
		public function getDesc() { return $this->desc; }
		public function getTitre() { return $this->titre; }
		public function getType() { return $this->type; }
		public function getBin() { return $this->binary; }
		public function getTaille() { return $this->taille; }
		
		public function __construct($Bob, $titre, $type, $desc, $bin, $taille, $id = 0)
		{
			$this->Bob = $Bob;
			$this->titre = $titre;
			$this->type = $type;
			$this->desc = $desc;
			$this->binary = $bin;
			$this->taille = $taille;
			
			if($id == 0) $id = $maxId + 1;
			$this->id = $id;
			if($id > self::maxId) self::maxId = $id;
		}
	
		public function generer() 
		{
			header ("Content-type: ".$this->type);
			header('Content-transfer-encoding: binary');
			echo $this->getBin();
		}
	}
?>
