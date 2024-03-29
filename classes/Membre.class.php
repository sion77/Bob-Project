<?php
    class Membre {
    
        protected $Bob;
        
        protected $id;
        protected $pseudo;
        protected $passCrypte;
        
        private $commentaires;
        private $nbCommentaires;
        
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
			$this->nbCommentaires = 0;
            
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
            $req = $this->Bob->prepare("INSERT INTO admin VALUES (?)");
            
            if(!$req->execute(array($this->id)))
                return false;
                
            return new Admin($this->Bob, $this->id, $this->pseudo, $this->passCrypte);
        }
    
        public function supprimer()
        {
            // S'il s'agit d'un admin
            if($this->estAdmin())
            {
                // On supprime son entree dans la table admin
                $req = $this->Bob->prepare("DELETE FROM admin WHERE idAdmin = ?");
                if(!$req->execute(array($this->id)))
                {
                    return false;
                }
            }
            
            // Suppression !
            $req = $this->Bob->prepare("DELETE FROM utilisateur WHERE idUtilisateur = ?");
            return $req->execute(array($this->id));
        }    
		
		public function ajouterCommentaire($c)
		{
			if($c == null)
				return false;
			
			$this->commentaires[$this->nbCommentaires] = $c;
			$this->nbCommentaires++;
			
			return true;
		}
		
		public function aCommente($p)
		{
			$trouve = false;
			$i = 0;
			while(!$trouve && $i < $this->nbCommentaires)
			{
				$trouve = ( $this->commentaires[$i]->estReponse() == false &&
				            $this->commentaires[$i]->getProduit()->getId() == $p->getId());
				$i++;
			}
			return $trouve;
		}
    }
    
    class Admin extends Membre {
    
        private $reponses;
        private $nbReponses;
    
        public function estAdmin() { return true; }
        public function upgrade() { return false; }
    }
?>
