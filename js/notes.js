function etoile (e) 
{
	var i;

	for(i = 1; i <= e; i++)
		document.getElementById("star"+i).src = "img/yellowstar.png";	
	for(i = e+1; i <= 5; i++)
		document.getElementById("star"+i).src = "img/greystar.png";	

	document.getElementById("note").value = e;

}

function focusetoile (t)
{
	var i;
	for(i = 1; i <= t; i++)
		document.getElementById("star"+i).src = "img/yellowstar.png";	
	for(i = t+1; i <= 5; i++)
		document.getElementById("star"+i).src = "img/greystar.png";
	
}

function loosefocus ()
{
	var i;	
	for(i = 1; i <= document.getElementById("note").value; i++)
		document.getElementById("star"+i).src = "img/yellowstar.png";
	for(i = 5 ; i > document.getElementById("note").value; i--)
		document.getElementById("star"+i).src = "img/greystar.png";
	
}