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
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4 && xhr.status == 200) 
                {
                    switch(xhr.responseText)
                    {
                        case "0" : 
                            document.getElementById("pseudoEtat").src = "img/ok.png";
                        break;
                        
                        case "1" : 
                            document.getElementById("pseudoEtat").src = "img/croix.png";
                        break;
                        
                        case "Erreur" : 
                        default : 
                            document.getElementById("pseudoEtat").src = "img/croix.png";
                        break;
                    }
                }        
            };
        }
        else
        {
            document.getElementById("pseudoEtat").src = "img/croix.png";
        }    
    }
    else
    {
        document.getElementById("pseudoEtat").src = "img/croix.png";
    }
    
}

function checkPass(champ)
{    
    var pass = champ.value;    
    
    if(pass.length <= 0) // Vide (ou bizarre)
    {
        document.getElementById("passEtat").src = "img/bob_js1.png";
    }
    else if(pass.length <= 4) // Entre 0 (exclu) et 4 (inclu)
    {
        document.getElementById("passEtat").src = "img/bob_js1.png";
    }
    else if(pass.length <= 8) // Entre 4 (exclu) et 8 (inclu)
    {
        document.getElementById("passEtat").src = "img/bob_js3.png";
    }
    else if (pass.length <= 12) // Entre 8 (exclu) et 12 (inclu)
    {
        document.getElementById("passEtat").src = "img/bob_js4.png";
    }
    else // Supérieur à 12 strictement
    {
        document.getElementById("passEtat").src = "img/bob_js2.png";
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
        }
        else
        {
            document.getElementById("confirmEtat").src = "img/croix.png";
        }        
    }
    else
    {
        document.getElementById("confirmEtat").src = "img/croix.png";
    }
    
}

function verifForm(f)
{
   var pseudoOk = checkPseudo(f.pseudo);
   var passOk = checkPass(f.pass);
   var pass2Ok = checkPass2(f.pass2);
   
   if(pseudoOk && passOk && pass2Ok)
      return true;
   else
   {
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
}
