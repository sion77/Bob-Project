function verifAlphaNum(chaine)
{
	var regex = /^\w*$/;
	return regex.test(chaine);
}

function checkPseudo()
{
	var pseudo = encodeURIComponent(document.getElementById("pseudo").value);
	
	if(pseudo != "")
	{
		if(verifAlphaNum(pseudo))
		{	
			var xhr = new XMLHttpRequest();
			xhr.open('GET', 'http://localhost/Bob-Project/index.php?ajax=existe_membre&pseudo=' + pseudo);
			xhr.send(null);
			xhr.onreadystatechange = function() {
				if(xhr.readyState == 4 && xhr.status == 200) 
				{
					switch(xhr.responseText)
					{
						case "0" : 
							document.getElementById("pseudoEtat").innerHTML = "Pseudo ok";
						break;
						
						case "1" : 
							document.getElementById("pseudoEtat").innerHTML = "Pseudo pas ok";
						break;
						
						case "Erreur" : 
						default : 
							document.getElementById("pseudoEtat").innerHTML = "Erreur ajax contacter administrateur";
						break;
					}
				}		
			};
		}
		else
		{
			document.getElementById("pseudoEtat").innerHTML = "Pseudo incorrect (syntaxe)";
		}	
	}
	else
	{
		document.getElementById("pseudoEtat").innerHTML = "Pseudo non renseigné";
	}
}

function checkPass()
{	
	var pass = document.getElementById("pass").value;
	
	if(pass != "")
	{	
		if(pass.length >= 4 && pass.length<8)
		{
			document.getElementById("passEtat").innerHTML = "Mot de passe court";
		}
		else if (pass.length >= 8 && pass.length<12)
		{
			document.getElementById("passEtat").innerHTML = "Mot de passe correct";
		}
		else if (pass.length >=12)
		{
			document.getElementById("passEtat").innerHTML = "Mot de passe sécuriser";
		}
		else 
		{
			document.getElementById("passEtat").innerHTML = "Mot de passe trop court";
		}
	}
	
	checkPass2(); // Ne pas oublier !
}

function checkPass2()
{
	var pass = document.getElementById("pass").value;
	var pass2 = document.getElementById("pass2").value;
	
	if(pass != "")
	{	
		if(pass2 == pass)
		{
			document.getElementById("confirm-etat").innerHTML = "Identiques";
		}
		else
		{
			document.getElementById("confirm-etat").innerHTML = "Differents";
		}
		
	}
}

/* http://localhost/Bob-Project/index.php?ajax=existe_membre&pseudo=root */
/* document.getElementById("pseudoEtat").innerHTML */
/* document.getElementById("idImage").src = "unLien/vers/uneImage.bmp"; */