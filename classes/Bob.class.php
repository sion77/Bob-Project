<?php

    require("classes\\Membre.class.php");
    require("classes\\Categorie.class.php");

    class Bob extends PDO
    {
        private $membres;   // Tableau de membres et admins
        private $nbMembres; // taille du tableau
        
        private $categories;    // Tableau de categories
        private $nbCategories;  // Nombre de categories
        
        private $erreur;
                
        // ============= INITS ============= //
                
        public function __construct($host, $port, $db, $login, $pass, $smarty = "")
        {
            // On commence par le constructeur de PDO
            PDO::__construct('mysql:host='.$host.';port='.$port.';dbname='.$db, $login, $pass);
            
            // Les attributs
            $this->erreur = false;
            
            // Les dépendances
            $this->nbMembres = 0;
            $this->membres = NULL;
            
            $this->nbCategories = 0;
            $this->categories = NULL;
                        
            // Le mieux serait de les appeller que si besoin
            // $this->initMembres();
            // $this->initCategories();
        }
        
        public function initMembres()
        {
            if($this->membres != NULL)
                return false;

            $this->nbMembres = 0;
            
            $req = $this->query("    SELECT idUtilisateur AS \"id\",
                                            pseudoUtilisateur AS \"pseudo\",
                                            passUtilisateur AS \"pass\",
                                            '0' AS \"admin\"
                                    FROM utilisateur
                                    WHERE idUtilisateur NOT IN( SELECT idAdmin FROM admin )
                                    
                                UNION
                                    
                                    SELECT idUtilisateur AS \"id\",
                                           pseudoUtilisateur AS \"pseudo\",
                                           passUtilisateur AS \"pass\",
                                           '1' AS \"admin\"
                                    FROM utilisateur
                                    WHERE idUtilisateur IN( SELECT idAdmin FROM admin )
                                    
                                ORDER BY id
                                ");            
            while($rep = $req->fetch())
            {
                if($rep["admin"])
                    $m = new Admin($this, $rep["id"], $rep["pseudo"], $rep["pass"]);
                else
                    $m = new Membre($this, $rep["id"], $rep["pseudo"], $rep["pass"]);
                    
                $this->membres[$this->nbMembres] = $m;            
                $this->nbMembres++;
            }
            $req->closeCursor();
            
            return true;
        }
        
        public function initCategories()
        {
            if($this->categories != NULL)
                return false;

            $this->nbCategories = 0;
            
            $req = $this->query("SELECT idCat AS \"id\",
                                        descriptionCat AS \"desc\",
                                        nomCat AS \"nom\"
                                 FROM categorie
                                 WHERE idParent IS NULL
                                 ORDER BY id");        
                                
            while($rep = $req->fetch())
            {
                $c = new Categorie($this, $rep["id"], $rep["nom"], $rep["desc"], NULL);
                    
                $this->categories[$this->nbCategories] = $c;            
                $this->nbCategories++;
            }
            $req->closeCursor();
            
            return true;
        }
                
        // ============= PUBLIC ============= //
                
        public function inscription($pseudo , $pass, $pass2) // return Membre ou false
        {
            // On vérifie que les infos sont là
            if(empty($pseudo) || empty($pass))
            {
                $this->erreur = "Certains champs sont vides !";
                return false;
            }
            
            // On vérifie que les mots de passe sont identiques
            if($pass != $pass2)
            {
                $this->erreur = "Les mots de passes sont différents";
                return false;
            }
            
            // On crypte le mot de passe pour qu'il ne soit pas lisible du premier coup d'oeil dans la BDD
            $pass = sha1($pass);
            
            // On echappe les quotes pour éviter les injections SQL.
            // $pseudo = mysql_real_escape_string($pseudo);
            
            // On regarde s'il n'y a pas déjà de membres avec ce pseudo
            $i = 0;
            $dejaUtilise = false;
            initMembres();            
            while($i < $this->nbMembres && !$dejaUtilise)
            {
                $dejaUtilise = ($this->membres[$i]->getPseudo() == $pseudo);
                $i++;
            }
                            
            // Si personne n'a déjà ce pseudo
            if($dejaUtilise)
            {
                $this->erreur = "Quelqu'un utilise déjà ce pseudo";
                return false;
            }
            
            // On ajoute l'utilisateur
            $sql = "INSERT INTO utilisateur(pseudoUtilisateur, passUtilisateur)
                    VALUES(:pseudo, :pass)";
                                                
            $req = $this->prepare($sql);
            $req->execute(array(
                "pseudo" => $pseudo,
                "pass" => $pass
            ));
            
            $m = new Membre($this, 0, $pseudo, $pass);
            ajouterMembre($m);
                        
            return $m;
        }    
    
        public function ajouterMembre($membre)
        {
            $this->initMembres();
            $this->membres[$this->nbMembres] = $membre;
            $this->nbMembres++;

            return true;
        }    
    
        public function connection($pseudo, $pass)
        {
            if($pseudo == "" || $pass == "")
            {
                $this->message = "Certains champs sont vides";
                $this->erreur = true;
                return false;
            }
            
            $trouve = false;
            $i = 0;
            $this->initMembres();
            while($i < $this->nbMembres && !$trouve)
            {
                $trouve = ($this->membres[$i]->getPseudo() == $pseudo);
                $i++;
            }
            
            if(!$trouve)
            {
                $this->message = "Identifiants incorrects"; // Utilisateur non trouvé
                $this->erreur = true;
                return false;
            }
            
            $membre = $this->membres[$i-1];
            
            if($membre->getPassCrypte() != sha1($pass))
            {
                $this->message = "Identifiants incorrects"; // Mot de passe incorrect
                $this->erreur = true;
                return false;
            }
            
            $_SESSION["connecte"] = true;
            $_SESSION["id"] = $membre->getId();
            $_SESSION["pseudo"] = $membre->getPseudo();
            $_SESSION["admin"] = $membre->estAdmin();
                        
            return $membre;
        }
    
        public function getIndiceMembre($id)
        {
            // On recherche le membre à supprimer
            $i = 0;
            $trouve = false;
            $this->initMembres();
            while($i < $this->nbMembres && !$trouve)
            {
                $trouve = ($this->membres[$i]->getId() == $id);
                $i++;
            }
            
            // On a pas l'id
            if(!$trouve)
            {
                $this->message = "Cet id n'est pas attribué";
                $this->erreur = true;
                return false;
            }
            
            // On a trouvé, mais on a incrémenté une fois de trop.
            $i--;
            
            return $i;
        }
        
        public function supprimerMembre($id)
        {
            // Quoi qu'il arrive, même template :
            $this->template = "admin_membres";
            
            // On recherche le membre
            $this->initMembres();
            $i = $this->getIndiceMembre($id);
            if(!$i) return false;
            
            // Le membre est administrateur
            if($this->membres[$i]->estAdmin())
            {
                $this->message = "Cet id appartient à un admin";
                $this->erreur = true;
                return false;
            }
                    
            // Erreur lors de la suppression
            if(!$this->membres[$i]->supprimer())
            {
                $this->message = "Erreur sql";
                $this->erreur = true;
                return false;
            }
            
            // On va supprimer le Membre du tableau
            if($i < $this->nbMembres-1)
            {
                $this->membres[$i] = $this->membres[$this->nbMembres-1];
            }            
            unset($this->membres[$this->nbMembres-1]);
            $this->nbMembres--;    

            // Tout est ok !
            $this->message = "Suppression du membre terminée";
            return true;
        }
        
        public function promoMembre($id)
        {
            // Quoi qu'il arrive, même template :
            $this->template = "admin_membres";
            
            // On recherche le membre
            $this->initMembres();
            $i = $this->getIndiceMembre($id);
            if(!$i) return false;
            
            // Le membre est déjà administrateur
            if($this->membres[$i]->estAdmin())
            {
                $this->message = "Cet id appartient à un admin";
                $this->erreur = true;
                return false;
            }
                    
            // Erreur lors de la promotion
            $admin = $this->membres[$i]->upgrade();
            if(!$admin)
            {
                $this->message = "Erreur sql";
                $this->erreur = true;
                return false;
            }
            
            // Transformation >.< !!!! 
            $this->membres[$i] = $admin;

            // Tout est ok !
            $this->message = "Promotion du membre terminée";
            return true;
        }
    
        public function getMembre($id)
        {
            $this->initMembres();
            return $this->membres[$this->getIndiceMembre($id)];
        }
        
        ///
        
        public function creerCategorie()
        {
            $this->initCategories();
            
            if(!isset($_POST["titre"]) || !isset($_POST["desc"]) || !isset($_POST["mere"]))
            {
                $this->erreur = "Il manque des données";
                return null;
            }
            
            if($_POST["titre"] == "")
            {
                $this->erreur = "Le titre n'est pas rempli";
                return null;
            }
            
            if($_POST["mere"] == "NULL") 
                $mere = null;
            else 
                $mere = $this->getCategorie(intval($_POST["mere"]));
                                        
            $sql = "INSERT INTO categorie(idCat, nomCat, descriptionCat, idParent)
                    VALUES ('', ?, ?, ?)";
                                   
            $req = $this->prepare($sql);
            
            if($mere)
            {
                $req->execute(array($_POST["titre"], $_POST["desc"], $mere->getId()));                
                $cat = new Categorie($this, 0, $_POST["titre"], $_POST["desc"], $mere);    
                return $mere->ajouterFils($cat);
            }
            
            $req->execute(array($_POST["titre"], $_POST["desc"], "NULL"));                
            $cat = new Categorie($this, 0, $_POST["titre"], $_POST["desc"], null);    
            return $this->ajouterCategorie($cat);
        }
        
        public function ajouterCategorie($cat)
        {// Une categorie mère, bien sûr
        
            $this->initCategories();
            $this->categories[$this->nbCategories] = $cat;
            $this->nbCategories++;
            
            return true;
        }
    
        public function getCategorie($id)
        {
            $i = 0;
            $trouve = false;
            $this->initCategories();
            while($i < $this->nbCategories && !$trouve)
            {
                $trouve = ($this->categories[$i]->getCategorie($id));
                $i++;
            }
            
            return $trouve;
        }
    
        
        // ============= GETTERS ============= //
        
        public function membresInited()
        {
            return ($this->membres != NULL);
        }
        
        public function categoriesInited()
        {
            return ($this->categories != NULL);
        }
        
        public function getMembres()
        {
            $this->initMembres();
            return $this->membres;
        }
        
        public function getCategories()
        {
            $this->initCategories();
            return $this->categories;
        }
        
        public function getNbCategories()
        {
            $this->initCategories();
            return $this->nbCategories;
        }
        
        public function getErreur()
        {
            return $this->erreur;
        }
    
    }
?>
