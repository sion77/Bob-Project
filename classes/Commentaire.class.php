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
        private $texte;
        private $date;
        
        private static $maxId = 0;
        
        public function getMembre() { return $this->membre; }
        public function getProduit() { return $this->produits; }
        public function getReponses() { return $this->reponses; }
        
        public function getId() { return $this->id; }
        public function getNom() { return $this->nom; }
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
            
            if($id == 0) $id = self::$maxId+1;
            $this->id = $id;
            if($id > self::$maxId) self::$maxId = $id;
            
            $this->nom = $nom;
            $this->note = $note;
            $this->texte = $texte;
            $this->date = $date;
        }
        
        public function ajoutreponse ($r)
        {
            if($r == null)
            {
                return false;
            }
        
            $this->reponses[$this->nbReponses] = $r;
            $this->nbReponses++;
            
            return true;
        }
        
    }
    
    class Reponse extends Commentaire {
        private $admin;
        private $commentaire;
        
        public function __construct($Bob, $admin, $commentaire, 
                                    $nom, $note, $texte, $date,
                                    $id = 0)
        {
            
        }
    }    
?>
