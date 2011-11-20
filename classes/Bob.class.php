<?php
    class Bob extends PDO
    {
        private $membres;   // Tableau de membres/admins
        private $nbMembres; // taille du tableau
        
        private $produits;   // Tableau de produits
        private $nbProduits; // taille du tableau
        
        private $categories;   // Tableau de categories
        private $nbCategories; // taille du tableau
        
        private $images;   // Tableau d'images
        private $nbImages; // taille du tableau
        
        private $commentaires;   // Tableau de commentaires/reponses
        private $nbCommentaires; // taille du tableau
               
        private $erreur;
                
        // ============= INITS ============= //
                
        public function __construct($host, $port, $db, $login, $pass, $smarty = "")
        {
            // On commence par le constructeur de PDO
            PDO::__construct('mysql:host='.$host.';port='.$port.';dbname='.$db, $login, $pass);
            
            // Les attributs
            $this->erreur = false;
            
            // Les dépendances
            $this->initImages();
            $this->initMembres();
            $this->initCategories();
			$this->initProduits();
			$this->initCommentaires();                        
        }
        
        private function initMembres()
        {
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
        
        private function initCategories()
        {
            $this->nbCategories = 0;
            
            $req = $this->query("SELECT idCat AS \"id\",
                                        descriptionCat AS \"desc\",
                                        nomCat AS \"nom\",
                                        idImgCat AS \"img\"
                                 FROM categorie
                                 WHERE idParent IS NULL
                                 ORDER BY id");        
                                
            while($rep = $req->fetch())
            {
                $img = ($rep["img"] == "NULL") ? null : $this->getImage($rep["img"]);
                $c = new Categorie($this, $img, $rep["id"], $rep["nom"], $rep["desc"], NULL);
                
                if($img)
                    $img->ajouteCible($c);
                    
                $this->categories[$this->nbCategories] = $c;            
                $this->nbCategories++;
            }
            $req->closeCursor();
            
            return true;
        }
                
        private function initImages()
        {
            $this->nbImages = 0;
                         
            $req = $this->query("SELECT * FROM image");        
                                
            while($rep = $req->fetch())
            {
                $i = new Image($this, 
                               $rep["titre"], 
                               $rep["type"], 
                               $rep["legende"], 
                               $rep["image"], 
                               $rep["idImage"]);
                    
                $this->images[$this->nbImages] = $i;            
                $this->nbImages++;
            }
            $req->closeCursor();
            
            return true;
        }
        
        private function initProduits()
        {        
            $this->nbProduits = 0;
            
            $req = $this->query("SELECT *
                                 FROM produit
                                 ORDER BY idProd") or die(print_r($this->errorInfo()));        
                                
            while($rep = $req->fetch())
            {
                $p = new Produit(
                    $this, 
                    $this->getCategorie($rep["idCatProd"]), 
                    $this->getImage($rep["idImageProd"]),
                    $rep["nomProd"],
                    $rep["libelle"],
                    $rep["stockProd"], 
                    $rep["nbVentesProd"],
                    $rep["nbLocProd"], 
                    $rep["prixProdVente"], 
                    $rep["prixProdLoc"],
                    $rep["idProd"]
                );
                    
                $this->produits[$this->nbProduits] = $p;            
                $this->nbProduits++;
            }
            $req->closeCursor();
            
            return true;
        }
        
        private function initCommentaires()
        {        
            $this->nbCommentaires = 0;
			$this->commentaires = array();
                        
            $req = $this->query("   SELECT E.idEval AS \"id\",
                                           dateEval AS \"date\",
                                           noteEval AS \"note\",
										   titreEval AS \"nom\",
                                           commentaireEval AS \"texte\",										   
                                           '0' AS \"rep\",										   
                                           idUser AS \"user\",										   
                                           idProduit AS \"prod\"
                                    FROM evaluation E, evalProduit P
                                    WHERE E.idEval NOT IN( SELECT idRep FROM reponse )
                                    AND E.idEval = P.idEval
                                    
                                UNION
                                
                                    SELECT idEval AS \"id\",
                                           dateEval AS \"date\",
                                           noteEval AS \"note\",
										   titreEval AS \"nom\",
                                           commentaireEval AS \"texte\",										   
                                           '1' AS \"rep\",										   
                                           idUserRep AS \"user\",										   
                                           idEvalRep AS \"com\"
                                    FROM evaluation E, reponse R
                                    WHERE idEval = idRep
                                    
                                ORDER BY id
                                ") or die(print_r($this->errorInfo()));      
                    
            $c = null;
            while($rep = $req->fetch())
            {
				$user = $this->getMembre(intval($rep["user"]));
								
                if($rep["rep"] == 0)
                {
					$prod = $this->getProduit(intval($rep["prod"]));
                    $c = new Commentaire($this, $user, $prod, 
										 $rep["nom"],
                                         $rep["note"],
                                         $rep["texte"],
                                         $rep["date"], 
                                         $rep["id"]);
										 
					$prod->ajouterCommentaire($c);
                }
                else
                {
					$com = $this->getProduit(intval($rep["com"]));
                    $c = new Reponse($this, $user, $com,
									 $rep["nom"],
                                     $rep["note"],
                                     $rep["texte"],
									 $rep["date"],
                                     $rep["id"]);
                }
				
				$user->ajouterCommentaire($c);
                
                if($c == null)
                {
					$this->erreur = "Erreur lors du chargement d'un commentaire";
					return false;
				}
                
                $this->commentaires[$this->nbCommentaires] = $c;  
				$this->nbCommentaires++;
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
            $this->ajouterMembre($m);
                        
            return $m;
        }    
    
        public function ajouterMembre($membre)
        {
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
            return $this->membres[$this->getIndiceMembre($id)];
        }
        
        public function membreExiste($pseudo)
        {
            $trouve = false;
            $i = 0;
            
            while(!$trouve && $i < $this->nbMembres)
            {
                $trouve = ($this->membres[$i]->getPseudo() == $pseudo);
                $i++;
            }
            
            return $trouve;
        }
        
        ///
        
        public function creerCategorie()
        {
            if(!isset($_POST["titre"]) || !isset($_POST["desc"]) || !isset($_POST["mere"]) || !isset($_POST["image"]))
            {
                $this->erreur = "Il manque des données";
                return null;
            }
            
            if($_POST["titre"] == "")
            {
                $this->erreur = "Le titre n'est pas rempli";
                return null;
            }
                                  
            $mere = ($_POST["mere"] == "NULL") ? NULL : $this->getCategorie(intval($_POST["mere"]));
            $img = ($_POST["image"] == "NULL") ? NULL : $this->getImage(intval($_POST["image"]));
                        
            $sql = "INSERT INTO categorie(nomCat, descriptionCat, idParent, idImgCat)
                    VALUES (?, ?, ?, ?)";
                                   
            $req = $this->prepare($sql);
            
            if($mere)
            {
                $req->execute(array($_POST["titre"], $_POST["desc"], $mere->getId(), ($img == NULL) ? NULL : $img->getId()));                
                $cat = new Categorie($this, $img, 0, $_POST["titre"], $_POST["desc"], $mere);    
                return $mere->ajouterFils($cat);
            }
            
            $req->execute(array($_POST["titre"], $_POST["desc"], null, ($img == NULL) ? NULL : $img->getId()));                
            $cat = new Categorie($this, $img, 0, $_POST["titre"], $_POST["desc"], null);    
            return $this->ajouterCategorie($cat);
        }
        
        public function modifCategorie($id)
        {
            if(!isset($_POST["titre"]) || !isset($_POST["desc"]) || !isset($_POST["mere"]) || !isset($_POST["image"]))
            {
                $this->erreur = "Il manque des données";
                return null;
            }
            
            if($_POST["titre"] == "")
            {
                $this->erreur = "Le titre n'est pas rempli";
                return null;
            }
            
            $cat = $this->getCategorie($id);
            $mere = ($_POST["mere"] == "NULL") ? NULL : $this->getCategorie(intval($_POST["mere"]));
            $img = ($_POST["image"] == "NULL") ? NULL : $this->getImage(intval($_POST["image"]));
            
            if(!$cat->modifier($_POST["titre"], $_POST["desc"], $img, $mere))
            {
                $this->erreur = "Erreur SQL";
                return false;
            }
            return true;
        }
        
        public function supprCategorie($id)
        {
            // Quoi qu'il arrive, même template :
            $this->template = "admin_categories";
            
            /*
                1) Verifier l'existence de la catégorie
                2) Modifier les fils : il faut les affecter à la catégorie mère
                3) Supprimer la catégorie
            */
            
            $cat = $this->getCategorie($id);
            if($cat == null)
            {
                $this->erreur = "catégorie non trouvée";
                return false;
            }
            
            $mere = $cat->getMere();
            $fils = $cat->getFils();
            if($fils != null)
            {
                foreach($fils as $f)
                {
                    $f->modifier($f->getNom(), $f->getDesc(), $mere);
                }
            }
            if(!$cat->supprimer())
            {
                $this->erreur = "Erreur lors de la suppression : \n";
                print_r($this->errorInfo());
                return false;
            }
            
            return true;
        }
        
        public function ajouterCategorie($cat)
        {// Une categorie mère, bien sûr
                    
            $this->categories[$this->nbCategories] = $cat;
            $this->nbCategories++;
            
            return true;
        }
    
        public function enleverCategorie($cat)
        {
            $trouve = false;
            $i = 0;
            while(!$trouve && $i < $this->nbCategories)
            {
                $trouve = ($this->categories[$i]->getId() == $cat->getId());
                $i++;
            }
            if(!$trouve)
                return false;
                
            $i--;
                
            // On va supprimer le Membre du tableau
            if($i < $this->nbCategories-1)
            {
                $this->categories[$i] = $this->categories[$this->nbCategories-1];
            }            
            unset($this->categories[$this->nbCategories-1]);
            $this->nbCategories--; 
                        
            return true;
        }
    
        public function getCategorie($id)
        {
            $i = 0;
            $trouve = false;
            
            while($i < $this->nbCategories && !$trouve)
            {
                $trouve = ($this->categories[$i]->getCategorie($id));
                $i++;
            }
            
            return $trouve;
        }

        ///
        
        public function creerProduit()
        {
            if(!isset($_POST["nom"])    ||
               !isset($_POST["desc"])   ||
               !isset($_POST["prixA"])  ||    
               !isset($_POST["prixL"])  ||    
               !isset($_POST["stock"])  ||
               !isset($_POST["cat"])    ||
               !isset($_POST["image"])    )
            {
                $this->erreur = "Il manque des données !";
                return false;
            }
               
            if($_POST["nom"] == "" || $_POST["prixA"] == "" || $_POST["prixL"] == "")
            {
                $this->erreur = "Certains champs ne sont pas remplis !
                                 <br/> Le prix et le nom sont obligatoires";
                return false;
            }        
            
            $prixA = intval($_POST["prixA"]);
            $prixL = intval($_POST["prixL"]);
            $stock = intval($_POST["stock"]);            
                                
            if($stock < 0 || $prixA < 0 || $prixL < 0)
            {
                $this->erreur = "Valeurs incorrectes (prix ou stock)";
                return false;
            }
            
            if($prixA == 0 && $prixL == 0)
            {
                $this->erreur = "Le produit doit pouvoir être achetabe OU/ET louable";
                return false;
            }
            
            $img = ($_POST["image"] != "NULL") ? $this->getImage(intval($_POST["image"])) : NULL;
            $cat = ($_POST["cat"] != "NULL") ? $this->getCategorie(intval($_POST["cat"])) : NULL;
            
            $req = $this->prepare("
            INSERT INTO produit(`nomProd`, `libelle`, `idImageProd`, `idCatProd`, 
                                `stockProd`, `prixProdLoc`, `PrixProdVente`) 
            VALUES(?, ?, ?, ?, ?, ?, ?)");
            
            $req->execute(array(
                $_POST["nom"],
                $_POST["desc"],               
                $img ? $img->getId() : NULL,
                $cat ? $cat->getId() : NULL,
                $stock,
                $prixL,
                $prixA                
            )) or die(print_r($this->errorInfo()));
                        
            $p = new Produit($this, $cat, $img, $_POST["nom"], $_POST["desc"], $stock, 
                             0, 0, $prixA, $prixL); 
                             
            if(!$p)
            {
                $this->erreur = "Erreur lors de la création du produit";
                return false;
            }
            
            if(!$this->ajouterProduit($p))
            {
                $this->erreur = "Erreur lors de l'ajout du produit crée";
                return false;
            }    
            
            return true;
        }
        
        public function ajouterProduit($p)
        {
            $this->produits[$this->nbProduits] = $p;
            $this->nbProduits++;
            
            return true;
        }
        
        public function getProduit($id)
        {
            $i = 0;
            $trouve = false;
            
            while($i < $this->nbProduits && !$trouve)
            {
                $trouve = ($this->produits[$i]->getId() == $id);
                $i++;
            }
            
            $i--;
            
            if(!$trouve)
                return false;
                
            return $this->produits[$i];
        }
        
        public function calcBestSeller()
        {
            $max = 0;
			$bs = array(
				"tab" => array(),
				"nb"  => 0,
				"rand" => 0
			);
			foreach($this->produits as $p)
			{
				$prix = (($p->getNbVentes()    * $p->getPrixVente()) + 
				         ($p->getNbLocations() * $p->getPrixLocation()));
				$max = ($prix > $max) ? $prix : $max;
			}
			
			foreach($this->produits as $p)
			{
				$prix = (($p->getNbVentes()    * $p->getPrixVente()) + 
				         ($p->getNbLocations() * $p->getPrixLocation()));
						 
				if($prix == $max)
				{
					$bs["tab"][$bs["nb"]] = $p;
					$bs["nb"]++;
				}
			}
			
			$bs["rand"] = rand(0, $bs["nb"]-1);

			return $bs;
        }
        
        public function calcMostPopular()
        {
            $max = 0;
			$mp = array(
				"tab" => array(),
				"nb"  => 0,
				"rand" => 0
			);
			foreach($this->produits as $p)
			{
				$note = $p->calcNoteMoy();
				$max = ($note > $max) ? $note : $max;
			}
			
			foreach($this->produits as $p)
			{
				if($p->calcNoteMoy() == $max)
				{
					$mp["tab"][$mp["nb"]] = $p;
					$mp["nb"]++;
				}
			}
			
			$mp["rand"] = rand(0, $mp["nb"]-1);

			return $mp;
        }
		
		public function recherche($str)
		{				
			$result = array(
				"exact" => array(/* Produits */),
				"ressemble" => array(/*
					array(
						"indice" => 0,
						"produit" => null
					)
				*/)
			);
			
			$max = 0;
			$ecart = RECHERCHE_ECART;
			$min = RECHERCHE_MARGE_ERREUR;
			
			$i = 0;
			foreach($this->produits as $p)
			{
				if($p->getNom() == $str)
				{
					$result["exact"][$i] = $p;
					$i++;
				}
				else
				{
					$pts = compare($p->getNom(), $str);
					$max = ($pts > $max) ? $pts : $max;
				}
			}
			
			$i = 0;
			$req = $max; // Pour trier du plus au moins ressemblant
			while($req >= $max-$ecart && $req >= $min)
			{
				foreach($this->produits as $p)
				{
					if($p->getNom() != $str)
					{
						$pts = compare($p->getNom(), $str);
						if($req <= $pts)
						{
							$result["ressemble"][$i]["indice"] = $pts;
							$result["ressemble"][$i]["produit"] = $p;
							$i++;
						}
					}
				}
				$req--;
			}			
						
			return $result;
		}    
        
        ///
        
        public function creerCommentaire($p)
        {
			if($p == null)
			{
				$this->erreur = "le produit n'existe pas";
				return false;				
			}
			
			if(!isset($_SESSION["connecte"]))
			{
				$this->erreur = "Vous devez être connecté pour ajouter un commentaire";
				return false;
			}
			
			if(!isset($_SESSION["id"])       ||
			   !isset($_POST["titre"])       ||
			   !isset($_POST["commentaire"]) ||
			   !isset($_POST["note"])           )
			{
				$this->erreur = "Il manque des données";
				return false;
			}
					
			$note = intval($_POST["note"]);
			$membre = $this->getMembre(intval($_SESSION["id"]));
			
			// User: on desactive le html
			$commentaire = htmlentities($_POST["commentaire"]); 
			$titre = htmlentities($_POST["titre"]); 
			
			if($titre == ""       ||
			   $note <= 0         ||
			   $membre == null    ||
			   $commentaire == ""   )
			{
			    $this->erreur = "Certains champs sont vides (ou alors vous n'existez pas)";
				return false;
			}
			
			// Données vérifiées
			// on a : $_POST["titre"], $note, $membre et $commentaire
			
			$req = $this->prepare("INSERT INTO evaluation(`noteEval`, `commentaireEval`, `dateEval`)
			                       VALUES (?, ?, NOW())");
			                       
			$req->execute(array(				
				$note,
				$commentaire
			)) or die(print_r($this->errorInfo()));
						
			$c = new Commentaire($this, $membre, $p, 
                                 $titre, $note, $commentaire, date("r"));
                                 
            if(!$c)
            {
				$this->erreur = "Erreur lors de la création du commentaire";
				return false;
			}
                                                                 
            $this->ajouterCommentaire($c);
            
            $req = $this->prepare("INSERT INTO evalproduit(`idProduit`, `idEval`, `idUser`)
			                       VALUES (?, ?, ?)");
			                       
			$req->execute(array(			
				$p->getId(),
				$c->getId(),
				$membre->getId()
			)) or die(print_r($this->errorInfo()));
			
			$p->ajouterCommentaire($c);
          						
			return true;
		}
		
		public function ajouterCommentaire($c)
		{
			if($c == null)
				return false;
			
			$this->commentaires[$this->nbCommentaires] = $c;
			$this->nbCommentaires++;
			
			return true;
		}
       
        ///
        
        public function uploadImage()
        {
            if(!isset($_POST['titre']) || !isset($_POST["desc"]) || !isset($_FILES['img']))
            {
                $this->erreur = "il manque des données";
                return false;
            }
            
            if($_POST['titre'] == "")
            {
                $this->erreur = "Il manque le titre !";
                return false;
            }
            
            if($_FILES['img']['type'] != "image/jpeg" &&
               $_FILES['img']['type'] != "image/png"  &&
               $_FILES['img']['type'] != "image/gif"     )
            {
                $this->erreur = "Type non supporté (jpeg/png/gif)";
                return false;
            }
            
            if($_FILES['img']['size'] <= 0)
            {
                $this->erreur = "erreur lors de l'upload";
                return false;
            }
            
            $fp      = fopen($_FILES['img']['tmp_name'], 'r');
            $content = fread($fp, filesize($_FILES['img']['tmp_name']));
            fclose($fp);

            $req = $this->prepare("INSERT INTO image(titre, legende, image, type)
                                   VALUES(?, ?, ?, ?)");
                    
            $ok = $req->execute(Array(
                $_POST["titre"],
                $_POST["desc"],
                $content,
                $_FILES['img']['type']
            ));
            
            if(!$ok)
            {
                return false;
            }
            
            $i = new Image( $this, 
                            $_POST["titre"], 
                            $_FILES['img']['type'], 
                            $_POST["desc"], 
                            $content,
                            $_FILES['img']['size']);
                                            
            $this->ajouterImage($i);
            
            return true;
        }
        
        public function ajouterImage($image)
        {
            $this->images[$this->nbImages] = $image;
            $this->nbImages++;
            return true;
        }
        
        public function getImage($id)
        {
            $trouve = false;
            $i = 0;
            while(!$trouve && $i < $this->nbImages)
            {
                $trouve = ($this->images[$i]->getId() == $id);
                $i++;
            }
            
            if(!$trouve)
                return null;
            
            return $this->images[$i-1];
        }
        
        // ============= GETTERS ============= //
         
        public function getImages()
        {
            return $this->images;
        }
        
        public function getMembres()
        {
            return $this->membres;
        }
        
        public function getCategories()
        {
            return $this->categories;
        }
        
        public function getProduits()
        {
            return $this->produits;
        }
        
        public function getNbCategories()
        {
            return $this->nbCategories;
        }
        
        public function getErreur()
        {
            return $this->erreur;
        }
            
        public function getCommentaires()
        {
			return $this->commentaires;
        }
    }
?>
