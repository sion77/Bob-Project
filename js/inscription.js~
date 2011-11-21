function verifAlphaNum(chaine)
{
    var regex = /^\w*$/;
    return regex.test(chaine);
}

function checkPseudo(champ)
{
    var pseudo = encodeURIComponent(champ.value);
    
    if(pseudo.length > 0)
    {
        if(verifAlphaNum(pseudo))
        {    
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://localhost/Bob-Project/index.php?ajax=existe_membre&pseudo=' + pseudo);
            xhr.send(null);
            xhr.onreadystatechange = function() 
		{
                if(xhr.readyState == 4 && xhr.status == 200) 
                {
                    switch(xhr.responseText)
                    {
                        case "0" : 
                            document.getElementById("pseudoEtat").src = "img/ok.png";
			    return true;
                        break;
                        
                        case "1" : 
                            document.getElementById("pseudoEtat").src = "img/croix.png";
			    return false;
                        break;
                        
                        case "Erreur" : 
                        default : 
                            document.getElementById("pseudoEtat").src = "img/croix.png";
			    return false;
                        break;
                    }
                }        
            };
        }
        else
        {
            document.getElementById("pseudoEtat").src = "img/croix.png";
            return false;
        }    
    }
    else
    {
        document.getElementById("pseudoEtat").src = "img/croix.png";
        return false;
    }
    
}

function checkPass(champ)
{    
    var pass = champ.value;    
    
    if(pass.length <= 0) // Vide (ou bizarre)
    {
        document.getElementById("passEtat").src = "img/bob_js1.png";
        return false;
    }
    else if(pass.length <= 4) // Entre 0 (exclu) et 4 (inclu)
    {
        document.getElementById("passEtat").src = "img/bob_js1.png";
        return false;
    }
    else if(pass.length <= 8) // Entre 4 (exclu) et 8 (inclu)
    {
        document.getElementById("passEtat").src = "img/bob_js3.png";
        return true;
    }
    else if (pass.length <= 12) // Entre 8 (exclu) et 12 (inclu)
    {
        document.getElementById("passEtat").src = "img/bob_js4.png";
        return true;
    }
    else // Supérieur à 12 strictement
    {
        document.getElementById("passEtat").src = "img/bob_js2.png";
        return true;
    }
    
    checkPass2(); // Ne pas oublier !
    
}

function checkPass2(champ)
{
    var pass = document.getElementById("pass").value;
    var pass2 = champ.value;
    
    if(pass2.length > 0)
    {    
        if(pass2 == pass)
        {
            document.getElementById("confirmEtat").src = "img/ok.png";
            return true;
        }
        else
        {
            document.getElementById("confirmEtat").src = "img/croix.png";
            return false;
        }        
    }
    else
    {
        document.getElementById("confirmEtat").src = "img/croix.png";
        return false;
    }
    
}

function verifForm(f)
{
   var pseudoOk = checkPseudo(f.pseudo);
   var passOk = checkPass(f.pass);
   var pass2Ok = checkPass2(f.pass2);
   
   if(pseudoOk == true && passOk == true && pass2Ok == true)
      return true;

   if (pseudoOk)
   {
	if (passOk)
	{
		if (pass2Ok)
		{
			return true;
		}
		else 
		{
			alert("La verification de mot de passe doit être identique au mot de passe.");
			return false;
		}
	}
	else
	{
		alert("Le mot de passe est trop court.");
		return false;
	}
   }
   else
   {
      alert("Le pseudo n'est pas disponible.");
      return false;
   }
}
