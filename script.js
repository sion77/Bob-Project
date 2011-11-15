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
		xhr.open('GET', 'http://localhost/Bob-Project/index.php?ajax=existe_membre&pseudo=' + pseudo);
		xhr.send(null);
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) 
			{
				alert(xhr.responseText);
			}
		// Ici
		};
	}
	else
	{
		document.getElementById("pseudoEtat").innerHTML = "Pseudo incorrect (syntaxe)";
	}
	
	
//};
	
	
}

/* http://localhost/Bob-Project/index.php?ajax=existe_membre&pseudo=root */