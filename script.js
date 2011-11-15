function verifAlphaNum(chaine)
{
	var regex = /^\w*$/;
	return regex.test(chaine);
}

function checkPseudo()
{
	var pseudo = encodeURIComponent(document.getElementById("pseudo").value);
	
	if(!empty(pseudo))
	{
		if(verifAlphaNum(pseudo) == true)
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
					};
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
	

};	
	

/* http://localhost/Bob-Project/index.php?ajax=existe_membre&pseudo=root */
/* document.getElementById("pseudoEtat").innerHTML */
/* document.getElementById("idImage").src = "unLien/vers/uneImage.bmp"; */