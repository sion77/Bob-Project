function verifAlphaNum(chaine)
{
    var regex = /^\w*$/;
    return regex.test(chaine);
}

function checkPseudo(champ)
{
    var pseudo = encodeURIComponent(champ.value);
	var retour;
    
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
							document.getElementById("pseudoEtat").alt = "OK";	
                        break;
                        
                        case "1" : 
                            document.getElementById("pseudoEtat").src = "img/croix.png";
							document.getElementById("pseudoEtat").alt = "Déjà utilisé";	
                        break;
                        
                        case "Erreur" : 
                        default : 
                            document.getElementById("pseudoEtat").src = "img/croix.png";
							document.getElementById("pseudoEtat").alt = "";		
                        break;
                    }
                }        
            };	// Fin de la fonction de "onreadystatechange"
        }
        else
        {
            document.getElementById("pseudoEtat").src = "img/croix.png";
            document.getElementById("pseudoEtat").alt = "Contient autre chose que des lettres et des chiffres";	
        }    
    }
    else
    {
        document.getElementById("pseudoEtat").src = "img/croix.png";
        document.getElementById("pseudoEtat").alt = "Vide";	
    }    
}

function checkPass(champ)
{    
    var pass = champ.value;    
    
    if(pass.length <= 0) // Vide (ou bizarre)
    {
        document.getElementById("passEtat").src = "img/bob_js1.png";
		checkPass2(); // Ne pas oublier !
        return false;
    }
    if(pass.length <= 4) // Entre 0 (exclu) et 4 (inclu)
    {
        document.getElementById("passEtat").src = "img/bob_js1.png";
		checkPass2(); // Ne pas oublier !
        return false;
    }
    if(pass.length <= 8) // Entre 4 (exclu) et 8 (inclu)
    {
        document.getElementById("passEtat").src = "img/bob_js3.png";
		checkPass2(); // Ne pas oublier !
        return true;
    }
    if (pass.length <= 12) // Entre 8 (exclu) et 12 (inclu)
    {
        document.getElementById("passEtat").src = "img/bob_js4.png";
		checkPass2(); // Ne pas oublier !
        return true;
    }
	
    // Supérieur à 12 strictement
    
    document.getElementById("passEtat").src = "img/bob_js2.png";
	checkPass2(); // Ne pas oublier !
    return true;
}

function checkPass2(champ)
{
    var pass = document.getElementById("pass").value;
    var pass2 = champ.value;
    
    if(pass2.length <= 0)
    {    
		document.getElementById("confirmEtat").src = "img/croix.png";
        return false;
	}
	
    if(pass2 != pass)
    {
        document.getElementById("confirmEtat").src = "img/croix.png";
        return false;
    }
	
	document.getElementById("confirmEtat").src = "img/ok.png";
    return true;       
}

function verifForm(f)
{
	checkPseudo(f.pseudo); // Va modifier document.getElementById("pseudoEtat").alt
	                       // Ne peut pas retourner le resultat car il se situe dans la fonction anonyme !
		
    var pseudoOk = (document.getElementById("pseudoEtat").alt == "" || 
	                document.getElementById("pseudoEtat").alt == "OK"  );
					
    var passOk = checkPass(f.pass);
    var pass2Ok = checkPass2(f.pass2);
   		
	if(!pseudoOk)
	{
		alert(document.getElementById("pseudoEtat").alt);
		return false;
	}

	if(!passOk)
	{
		alert("Mot de passe vide ou trop court");
		return false;
	}
	
	if (!pass2Ok)
	{
		alert("Mot de passe de confirmation erronne");
		return false;
	}
	
	return true;	
}

