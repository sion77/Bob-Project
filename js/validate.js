function valider() {

  if(document.formSaisie.prenom.value != "") {
    document.formSaisie.submit();
  }
  
  else 
  {
	alert("Saisissez le prénom");
  }
}
