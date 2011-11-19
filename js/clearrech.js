function clearrechtext()
{	
	if (document.getElementById("rechtext").value = "Rechercher")
	{
	document.getElementById("rechtext").value = "";
	}
}

function textout()
{

	if (document.getElementById("rechtext").value == "")
	{
		document.getElementById("rechtext").value = "Rechercher";
	}
}
