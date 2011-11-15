function verifAlphaNum(chaine)
{
	var regex = /^\w*$/;
	return regex.test(chaine);
}

function checkPseudo()
{
	var pseudo = document.getElementById("pseudo").value;
	alert(pseudo);	
}
