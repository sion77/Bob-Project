<?php
	class Bob extends PDO
	{
		private $template;
		private $smarty;
		private $action;
		
		private $membres;
		private $nbMembres;
		
		private $message;
		private $erreur;
				
		public function __construct($host, $port, $db, $login, $pass, $smarty = "")
		{
			// On commence par le constructeur de PDO
			PDO::__construct('mysql:host='.$host.';port='.$port.';dbname='.$db, $login, $pass);
			
			// Puis les d�pendances
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
			//$this->membres = new Array();
			
			$req = $this->query("SELECT * FROM utilisateur");			
			while($rep = $req->fetch())
			{
				$this->membres[$this->nbMembres] = new Membre($this, $rep["pseudoUtilisateur"]);				
				$this->nbMembres++;
			}
			$req->closeCursor();
		}
		
		public function estAction()
		{
			return $this->action;
		}
		
		public function getMessage()
		{
			return $message;
		}
		
		public function getErreur()
		{
			return $erreur;
		}
		
		public function analyser()
		{			
			// Acc�s au panneau d'admin
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
												$this->template("admin_membres");
												$this->message = "id non renseign�";
												$this->erreur = true;
											}
										break;
										
										// Sinon
										default:
											$this->template("admin_membres");
										break;
									}
								}
								
								// Si on vient d'arriver sur la gestion des membres
								else
									$this->template("admin_membres");
							break;
							
							/* Gestion des categories */
							case "CATEGORIES" : 
								$this->template("admin_categories");
							break;
							
							/* Sinon, ou si on demande explicitement l'accueil */
							case "ACCUEIL":
							default:
								$this->template("admin");
							break;
						}
					}
					else
						$this->template("acceuil");
				}
				else
					$this->template("acceuil");
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
					
					//Si on nous demande de d�connecter l'utilisateur
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
					
					//Si on nous demande d'afficher les cat�gories
					case "CATEGORIES":
						$this->template = "categories";
					break;
					
					//Si on nous demande d'afficher les sous-cat�gories
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
						$this->message = "Fonction non impl�ment�e";
						$this->template("accueil");
					break;
					
					case "inscription":
						if(isset($_POST["pseudo"]) && isset($_POST["pass"]) && isset($_POST["pass2"]))
						{	
							try
							{
								$this->inscription($_POST["pseudo"], $_POST["pass"], $_POST["pass2"]);
								$this->template = "accueil";
								$this->message = "Votre inscription s'est d�roul�e avec succ�s";								
							}
							catch(Exception $e)
							{
								$this->template = "inscription";
								$this->erreur = true;
								$this->message = $e->getMessage();
							}
						}
						else
						{
							$this->template = "inscription";
							$this->erreur = true;
							$this->message = "Donn�es manquantes";
						}
					break;
				}
			}
		}
		
		public function afficher()
		{
			$this->smarty->assign(array(
				"erreur" => $this->erreur,
				"message" => $this->message,
				"connecte" => isset($_SESSION["connecte"])
			));
			
			$this->smarty->display("templates\\".$this->template.".tpl");
		}
	
		private function inscription($pseudo , $pass, $pass2) // return Membre
		{
			// On v�rifie que les infos sont l�
			if($pseudo == "" || $pass == "")
			{
				throw new Exception("Certains champs sont vides !");
			}
			
			// On v�rifie que les mots de passe sont identiques
			if($pass != $pass2)
			{
				throw new Exception("Les mots de passes sont diff�rents");
			}
			
			// On crypte le mot de passe pour qu'il ne soit pas lisible du premier coup d'oeil dans la BDD
			$pass = sha1($pass);
			
			// On echappe les quotes pour �viter les injections SQL.
			// $pseudo = mysql_real_escape_string($pseudo);
			
			// On regarde s'il n'y a pas d�j� de membres avec ce pseudo
			$i = 0;
			$dejaUtilise = false;
			while($i < $this->nbMembres && !$dejaUtilise)
			{
				$dejaUtilise = ($this->membres[$i]->getPseudo() == $pseudo);
				$i++;
			}
							
			// Si personne n'a d�j� ce pseudo
			if($dejaUtilise)
			{
				throw new Exception("Quelqu'un utilise d�j� ce pseudo");
			}
			
			// On ajoute l'utilisateur
			$sql = "INSERT INTO utilisateur(pseudoUtilisateur, passUtilisateur)
					VALUES(:pseudo, :pass)";
												
			$req = $this->prepare($sql);
			$req->execute(array(
				"pseudo" => $pseudo,
				"pass" => $pass
			));
			
			return new Membre($this, $pseudo);
		}	
	}
?>