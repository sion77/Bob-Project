<?php
	class Bob extends PDO
	{
		private $template;
		private $smarty;
		private $action;
		
		private $membres;   // Tableau de membres et admins
		private $nbMembres; // taille du tableau
		
		private $message;
		private $erreur;
				
		public function __construct($host, $port, $db, $login, $pass, $smarty = "")
		{
			// On commence par le constructeur de PDO
			PDO::__construct('mysql:host='.$host.';port='.$port.';dbname='.$db, $login, $pass);
			
			// Puis les dépendances
			$this->smarty = (($smarty == "") ? new Smarty() : $smarty);
			$this->initMembres();
				
			// Et enfin nos variables
			$this->template = "accueil";
			$this->action = false;		
			$this->message = false;
			$this->erreur = false;
		}
		
		private function initMembres()
		{
			$this->nbMembres = 0;
			
			$req = $this->query("	SELECT idUtilisateur AS \"id\",
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
		}
		
		public function estAction() { return $this->action; }		
		public function getMessage() { return $message; }
		public function getErreur()	{ return $erreur; }
		
		public function analyser()
		{			
			// Accès au panneau d'admin
			if(isset($_GET["admin"]))
			{
				// Que si on est connecte
				if(isset($_SESSION["connecte"]) && isset($_SESSION["admin"]))
				{
					// Que si on est admin
					if($_SESSION["admin"] == true)
					{
						// Selon ce que l'on veut faire..
						switch($_GET["admin"])
						{
							/* Gestion des membres */
							case "MEMBRES":
							
								// Si on nous demande de faire quelque chose
								if(isset($_GET["action"]))
								{
									switch($_GET["action"])
									{
										// Supprimer un membre
										case "SUPPRIMER":
											if(isset($_GET["id"]))
											{
												$this->action = "supprimer membre";
											}
											else
											{
												$this->template = "admin_membres";
												$this->message = "id non renseigné";
												$this->erreur = true;
											}
										break;
										
										// Sinon
										default:
											$this->template = "admin_membres";
										break;
									}
								}
								
								// Si on vient d'arriver sur la gestion des membres
								else
									$this->template = "admin_membres";
							break;
							
							/* Gestion des categories */
							case "CATEGORIES" : 
								$this->template = "admin_categories";
							break;
							
							/* Sinon, ou si on demande explicitement l'accueil */
							case "ACCUEIL":
							default:
								$this->template = "admin";
							break;
						}
					}
					else
						$this->template = "accueil";
				}
				else
					$this->template = "accueil";
			}
			
			//Si on nous demande de faire quelque chose 
			elseif(isset($_GET["action"])) 
			{
				switch($_GET["action"]) 
				{
					// Si on veut faire une recherche rapide
					case "RECHERCHE":
						$this->action = "recherche rapide";
					break;
				
					//Si on nous demande d'inscrire un utilisateur
					case "INSCRIPTION":
						$this->action = "inscription";
						
					break;
					
					//Si on nous demande de connecter l'utilisateur
					case "CONNECTION":
						$this->action = "connection";
					break;
					
					//Si on nous demande de déconnecter l'utilisateur
					case "DECONNECTION":
						$this->action = "deconnection";
						
						unset($_SESSION["connecte"]);
						session_destroy();
						$this->template = "accueil";
					break;	
								
					//Sinon retour a l'accueil
					default:
						$this->template = "accueil";
					break;
				}
			}
			
			// Si l'adresse est de la forme http://bob-poject.com/index.php?page=XXX
			elseif(isset($_GET["page"]))
			{
				switch($_GET["page"])
				{						
					// On affiche le formulaire d'inscription
					case "INSCRIPTION":
						$this->template = "inscription";
					break;
					
					// On affiche le formulaire de connection
					case "CONNECTION":
						$this->template = "connection";
					break;
					
					// Si on demande la page about
					case "ABOUT":
						$this->template = "about";
					break;
					
					//Si on nous demande d'afficher les catégories
					case "CATEGORIES":
						$this->template = "categories";
					break;
					
					//Si on nous demande d'afficher les sous-catégories
					case "SOUSCATEGORIES":
						$this->template = "sous-categories";
					break;
					
					case "FICHEPRODUIT":
						$this->template = "fiche-produit";
					break;
					
					// Sinon on affiche la page d'acceuil
					default:
						$this->template = "accueil";
					break;
				}
			}
			
			// Si on vient tout juste de se connecter sur le site 
			else
			{
				$this->template = "accueil";
			}

		}
		
		public function executer()
		{
			if($this->action)
			{
				switch($this->action)
				{
					case "recherche rapide":						
						$this->erreur = true;
						$this->message = "Fonction non implémentée";
						$this->template = ("accueil");
					break;
					
					case "inscription":
						if(isset($_POST["pseudo"]) && isset($_POST["pass"]) && isset($_POST["pass2"]))
						{	
							if($membre = $this->inscription($_POST["pseudo"], $_POST["pass"], $_POST["pass2"]))
							{
								$this->membres[$this->nbMembres] = $membre;
								$this->nbMembres++;
								
								if($this->connection($_POST["pseudo"], $_POST["pass"]))
								{
									$this->template = "accueil";
									$this->message = "Votre inscription s'est déroulée avec succès";	
								}
								else
								{
									$this->template = "accueil";
									$this->erreur = true;
									$this->message = "La connection suivant l'inscription à échouée";
								}								
							}
							else
							{
								$this->template = "inscription";
								// $this->message mis-à-jour.
							}
						}		
						else
						{
							$this->template = "inscription";
							$this->erreur = true;
							$this->message = "Données manquantes";
						}
					break;
					
					case "connection":
						if(isset($_POST["pseudo"]) || isset($_POST["pass"]))
						{	
							if($membre = $this->connection($_POST["pseudo"], $_POST["pass"]))
							{
								$this->template = "accueil";
							}
							else
							{
								$this->template = "connection";
							}
						}
						else
						{							
							$this->template = "connection";
							$this->message = "Il manque des données";
							$this->erreur = true;
						}
					break;
					
					case "supprimer membre":
						if(isset($_GET["id"]))
						{
							$this->supprimerMembre(intval($_GET["id"]));
						}
					break;
										
					default:
						$this->template = "accueil";
					break;
				}
			}
		}
		
		public function afficher()
		{
			$this->smarty->assign(array(
				"erreur" => $this->erreur,
				"message" => $this->message,
				"connecte" => isset($_SESSION["connecte"]),
				"membres" => $this->membres
			));
			
			$this->smarty->display("templates\\".$this->template.".tpl");
		}
	
		private function inscription($pseudo , $pass, $pass2) // return Membre ou false
		{
			// On vérifie que les infos sont là
			if($pseudo == "" || $pass == "")
			{
				$this->erreur = true;
				$this->message = "Certains champs sont vides !";
				return false;
			}
			
			// On vérifie que les mots de passe sont identiques
			if($pass != $pass2)
			{
				$this->erreur = true;
				$this->message = "Les mots de passes sont différents";
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
				$this->message = "Quelqu'un utilise déjà ce pseudo";
				$this->erreur = false;
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
						
			return new Membre($this, 0, $pseudo, $pass);
		}	
	
		private function connection($pseudo, $pass)
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
	
		private function supprimerMembre($id)
		{
			// Quoi qu'il arrive, même template :
			$this->template = "admin_membres";
			
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
	}
?>