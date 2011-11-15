function verifAlphaNum(chaine)
{
	var regex = /^\w*$/;
	return regex.test(chaine);
}

function checkPseudo()
{
	var pseudo = encodeURIComponent(document.getElementById("pseudo").value);
	
	if(verifAlphaNum(pseudo) == true)
	{
<<<<<<< HEAD
		document.getElementById("pseudoEtat").innerHTML = "Pseudo correct (syntaxe)";
=======
		xhr.open('GET', 'http://localhost/Bob-Project/index.php?ajax=existe_membre&pseudo=' + pseudo);
		xhr.send(null);
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) 
			{
				alert(xhr.responseText);
			}
		// Ici
		};
>>>>>>> 11612da49e037e12b893bf180e3ee20f93e3f37a
	}
	else
	{
		document.getElementById("pseudoEtat").innerHTML = "Pseudo incorrect (syntaxe)";
	}
	
	
<<<<<<< HEAD
	xhr.open('GET', 'http://localhost/Bob-Project/index.php?ajax=existe_membre&pseudo=' + pseudo);
	xhr.send(null);
	xhr.onreadystatechange = function() {
    if(xhr.readyState == 4 && xhr.status == 200) 
	{
		alert(xhr.responseText);
    }
};
=======
//};
>>>>>>> 11612da49e037e12b893bf180e3ee20f93e3f37a
	
	
}

/* http://localhost/Bob-Project/index.php?ajax=existe_membre&pseudo=root */