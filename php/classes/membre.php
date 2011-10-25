<?php
	class Membre {
	
		protected $Bob;
		
		protected $id;
		protected $pseudo;
		protected $passCrypte;
		
		private static $maxId = 0;
		
		public function getId() { return $this->id; }
		public function getPseudo() { return $this->pseudo; }
		public function getPassCrypte() { return $this->passCrypte; }
		
		public function __construct($Bob, $id, $pseudo, $passCrypte)
		{
			if($id == 0)
			{
				$id = self::$maxId+1;
			}
			
			$this->Bob = $Bob;
			
			$this->id = $id;			
			$this->pseudo = $pseudo;
			$this->passCrypte = $passCrypte;
			
			if(self::$maxId < $id)
			{
				self::$maxId = $id;
			}
		}
		
		public function estAdmin() { return false; }
				
		public function update()
		{
		
		}	
		
		public function upgrade()
		{
		
		}
	}
	
	class Admin extends Membre {
		public function estAdmin() { return true; }
	}
?>
