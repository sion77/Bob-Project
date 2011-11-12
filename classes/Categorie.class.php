<?php
    class Categorie
    {
        private $Bob;
        
        private $mere;
        private $fils;
        private $nb_fils;
        
        private $id;
        private $nom;
        private $desc;
        
        private static $maxId = 0;
        
        public function getId() { return $this->id; }
        public function getNom() { return $this->nom; }
        public function getDesc() { return $this->desc; }
        public function getMere() { return $this->mere; }
        public function getFils() { return $this->fils; }
        public function getNbFils() { return $this->nbFils; }
        
        public function getFreres() 
        { // Attention ! on est dans le tableau !
        
            if($this->mere == NULL)
                return $this->Bob->getCategories();
                
            return $this->mere->getFils();             
        }
        
        public function getNbFreres() 
        { 
            if($this->mere == NULL)
                return ($this->Bob->getNbCategories() - 1);
                
            return ($this->mere->getNbFils() - 1); // Moins 1 car on se comptait
        }
        
        public function __construct($Bob, $id, $nom, $desc, $mere)
        {
            $this->Bob = $Bob;
            $this->mere = $mere;
            
            if($id == 0)
            {
                $id = self::$maxId+1;
            }
            
            $this->id = $id;
            $this->nom = $nom;
            $this->desc = $desc;
            
            $this->fils = NULL;
            $this->nb_fils = 0;
            
            if(self::$maxId < $id)
            {
                self::$maxId = $id;
            }
            
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
                                   $this);
                                   
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
            $trouve = false;
            while($i < $this->nbFils && !$trouve)
            {
                $trouve = ($this->fils[$i]->getCategorie($id));
                $i++;
            }
            
            return $trouve;
        }
    
        public function afficheListe()
        {
            echo "<li>";
                echo "<a href=\"index.php?page=SOUSCATEGORIES&amp;id=".$this->id."\">";
                    echo $this->nom;
                echo "</a>";
				echo " : ";
				echo "<a href=\"index.php?admin=CATEGORIES&amp;page=EDITER&amp;id=".$this->id."\">";
					echo "Modifier";
				echo "</a>";
				echo " -- ";
				echo "<a href=\"index.php?admin=CATEGORIES&amp;action=SUPPR&amp;id=".$this->id."\">";
					echo "Supprimer";
				echo "</a>";
            echo "</li>";
            
            if($this->nbFils > 0)
            {
                echo "<ul>";
                    foreach($this->fils as $fils)
                    {
                        $fils->afficheListe();
                    }
                echo "</ul>";
            }
        }
		
		public function getInvertedPath()
		{
			$cat = $this;
            $i = 0;
			while($cat != null)
			{
				$hierarchie[] = $cat;
				$cat = $cat->getMere();
				$i++;
			}
			return $hierarchie;
		}
		
		public function getPath()
		{
			$hierarchie = $this->getInvertedPath();
			$i = sizeof($hierarchie);
			while($i > 0)
			{
				$i--;
				$path[] = $hierarchie[$i];				
			}		
			return $path;
		}       
		
		public function afficheOption()
        {
            echo "<option value=\"".$this->id."\">";    
				$path = $this->getPath();
                foreach($path as $cat)
				{
					echo "/".$cat->getNom();
				}
            echo "</option>";
            
            if($this->nbFils > 0)
            {
                echo "<ul>";
                    foreach($this->fils as $fils)
                    {
                        $fils->afficheOption();
                    }
                echo "</ul>";
            }
        }
    
        public function ajouterFils($cat)
        {
            $this->fils[$this->nbFils] = $cat;
            $this->nbFils++;
            return true;
        }    
    }
?>