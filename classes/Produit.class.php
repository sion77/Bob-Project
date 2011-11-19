<?php
    class Produit 
    {
        private $Bob;
        private $cat;
        private $img;
        
        private $commentaires;
        private $nbCommentaires;
        
        private $id;
        private $nom;
        private $desc;
        
        private $stock;
        private $nbVentes;
        private $nbLoc;
        private $prixVente;
        private $prixLoc;
        
        public function getId() { return $this->id; }
        public function getNom() { return $this->nom; }
        public function getDesc() { return $this->desc; }
        
        public function getImg() { return $this->img; }        
        public function getCat() { return $this->cat; }
        public function getCommentaires() { return $this->commentaires; }
        
        public function getStock() { return $this->stock; }
        public function getPrixVente() { return $this->prixVente; }
        
        public function __construct($Bob, $cat, $img, $nom, $desc, $stock, 
                                    $nbVentes, $nbLoc, $prixVente, $prixLoc, $id = 0)
        {
            $this->Bob = $Bob;
            $this->id = $id;
            $this->nom = $nom;
            $this->desc = $desc;
            $this->img = $img;
            $this->cat = $cat;
            
            $this->stock = $stock;            
            $this->prixVente = $prixVente;
            $this->prixLoc = $prixLoc;
            
            $this->nbLoc = $nbLoc;
            $this->nbVentes = $nbVentes;
            
            if($this->cat)
                $this->cat->ajouterProduit($this);
                
            if($this->img)
                $this->img->ajouteCible($this);
        }        
    }
?>
