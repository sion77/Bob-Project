<?php
	class Bob extends PDO
	{
		private $template;
		private $smarty;
		private $action;
		private $message;
				
		public function __construct($host, $port, $db, $login, $pass)
		{
			// On commence par le constructeur de PDO
			PDO::__construct('mysql:host='.$host.';port='.$port.';dbname='.$db, $login, $pass);
			
			// Puis les dépendances
			$this->smarty = new Smarty();
				
			// Et enfin nos variables
			$this->template = "accueil";
			$this->action = false;		
			$this->message = false;
		}
		
		public function estAction()
		{
			return $this->action;
		}
		
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
												$this->template("admin_membres");
												$this->smarty->assign("erreur", "id non renseigné");
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
						$this->smarty->assign("erreur", "Fonction non implémentée");
						$this->template("accueil");
					break;
					
					case "inscription":
						if(isset($_POST["pseudo"]) && isset($_POST["pass"]) && isset($_POST["pass2"]))
						{							
							
						}
						else
						{
							$this->template("inscription");
							$this->smarty->assign("erreur", "Données manquantes");
						}
					break;
				}
			}
		}
		
		public function afficher()
		{
			$this->smarty->assign(array(
				"message" => $this->message,
				"connecte" => isset($_SESSION["connecte"])
			));
			
			$this->smarty->display("templates\\".$this->template.".tpl");
		}
	
		public function inscription()
		{
			
		}
	
	}
?>