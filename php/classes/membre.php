<?php
	class Membre {
	
		protected static $erreur;
		protected $id;
		
		public function __construct($bdd, $id)
		{
			
		}
		
		public static function get_erreur()
		{
			return $this->erreur;
		}
	
		public static function inscription($pseudo , $pass, $pass2) // return Membre
		{
			// On vérifie que les mots de passe sont identiques
			if($pass != $pass2)
			{
				$this->erreur = "Les mots de passes sont différents";
				return false;
			}
			
			// On crypte le mot de passe pour qu'il ne soit pas lisible du premier coup d'oeil dans la BDD
			$pass = sha1($pass);
			
			// On echappe les quotes pour éviter les injections SQL.
			$pseudo = mysql_real_escape_string($pseudo);
			
			// On compte le nombre de personnes ayant le pseudo $pseudo
			$req = mysql_query("SELECT idUtilisateur FROM utilisateur WHERE pseudoUtilisateur = '".$pseudo."'");
			$count = mysql_num_rows($req);
			mysql_free_result($req);
				
			// Si personne n'a déjà ce pseudo
			if($count != 0)
			{
				$this->erreur = "Quelqu'un utilise déjà ce pseudo";
				return false;
			}
			
			// On ajoute l'utilisateur
			$sql = "INSERT INTO utilisateur(pseudoUtilisateur, passUtilisateur)
					VALUES('".$pseudo."', '".$pass."')";
												
			mysql_query($sql) or die(erreur_sql($sql));
			
			return true;
		}
		
		public static function connection()
		{
		
		}
		
		public function suppression()
		{
		
		}
		
		public function update()
		{
		
		}	
		
		public function upgrade()
		{
		
		}
	}
	
	class Admin extends Membre {
		
	}
?>
