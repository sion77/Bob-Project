<?php
	
	// Permet d'afficher la requête erronée et l'erreur contenue dans mysql_error de manière classe
	function erreur_sql($sql)
	{
		print(nl2br("<h1>Erreur sql</h1>			
			<strong>Voici la requete</strong> : 
			".$sql."
			
			<strong>Voici l'erreur</strong> : ".mysql_error()."
			
			<a href=\"index.php\">Retour</a>
			<a href=\"mailto:moi\">Signaler l'erreur</a>"));
	}
	
	include("classes\\membre.php");

	// Cette fonction permet de supprimer un utilisateur
	function admin_supprimerMembre($id)
	{// $id sécurisé
		
		// On commence par se demander si l'utilisateur est administrateur
		$sql = "SELECT * FROM admin WHERE idAdmin = '".$id."'";
		$req = mysql_query($sql) or die(erreur_sql($sql));
		$count = mysql_num_rows($req); // On compte le nombre de lignes de résultat (0 ou 1)
		mysql_free_result($req);
		
		if($count == 0) // Si ce n'est pas un admin
		{
			// On le supprimme
			$sql = "DELETE FROM utilisateur WHERE idUtilisateur = '".$id."'";
			mysql_query($sql) or die(erreur_sql($sql));
			
			page("ADMIN_MEMBRES", "<span class=\"message\">Le membre n°".$id." à bien été supprimé</span>");
		}
		else // Si c'est un admin
			page("ADMIN_MEMBRES", "<span class=\"erreur\">Le membre n°".$id." est administrateur !</span>");
	}
?>