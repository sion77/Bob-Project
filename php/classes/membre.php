<?php
	class Membre {
	
		protected static $erreur;
		protected $Bob;
		
		protected static $nextId = 1;
		
		protected $id;
		protected $pseudo;
		
		public function getPseudo() { return $this->pseudo; }
		
		public function __construct($Bob, $pseudo)
		{
			$this->Bob = $Bob;
			$this->id = self::$nextId;
			self::$nextId++;
			
			$this->pseudo = $pseudo;
		}
		
		public static function get_erreur() { return $this->erreur; }
			
		public static function connection()
		{
		
		}
				
		public function update()
		{
		
		}	
		
		public function upgrade()
		{
		
		}
	}
	
	class Admin extends Membre {
		
	}
?>
