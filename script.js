function verifAlphaNum(chaine)
{
    var regex = /^\w*$/;
    return regex.test(chaine);
}

function checkPseudo()
{
    var pseudo = encodeURIComponent(document.getElementById("pseudo").value);
    
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
                            document.getElementById("pseudoEtat").innerHTML = "Pseudo ok";
                        break;
                        
                        case "1" : 
                            document.getElementById("pseudoEtat").innerHTML = "Pseudo pas ok";
                        break;
                        
                        case "Erreur" : 
                        default : 
                            document.getElementById("pseudoEtat").innerHTML = "Erreur AJAX contacter administrateur";
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
    
    if(pass.length <= 0) // Vide (ou bizarre)
    {
        document.getElementById("passEtat").innerHTML = "Mot de passe non renseigné";
    }
    else if(pass.length <= 4) // Entre 0 (exclu) et 4 (inclu)
    {
        document.getElementById("passEtat").innerHTML = "Mot de passe trop court";
    }
    else if(pass.length <= 8) // Entre 4 (exclu) et 8 (inclu)
    {
        document.getElementById("passEtat").innerHTML = "Mot de passe court";
    }
    else if (pass.length <= 12) // Entre 8 (exclu) et 12 (inclu)
    {
        document.getElementById("passEtat").innerHTML = "Mot de passe correct";
    }
    else // Supérieur à 12 strictement
    {
        document.getElementById("passEtat").innerHTML = "Mot de passe sécurisé";
    }
    
    checkPass2(); // Ne pas oublier !
}

function checkPass2()
{
    var pass = document.getElementById("pass").value;
    var pass2 = document.getElementById("pass2").value;
    
    if(pass2.length > 0)
    {    
        if(pass2 == pass)
        {
            document.getElementById("confirmEtat").innerHTML = "Identiques";
        }
        else
        {
            document.getElementById("confirmEtat").innerHTML = "Differents";
        }        
    }
    else
    {
        document.getElementById("confirmEtat").innerHTML = "Non renseigné";
    }
}

/* http://localhost/Bob-Project/index.php?ajax=existe_membre&pseudo=root */
/* document.getElementById("pseudoEtat").innerHTML */
/* document.getElementById("idImage").src = "unLien/vers/uneImage.bmp"; */