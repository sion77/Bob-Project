function verifAlphaNum(chaine)
{
	var regex = /^\w*$/;
	return regex.test(chaine);
}

