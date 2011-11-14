function verif_pass() {

// on place les saisies dans des variables pour plus de commodité
mot_de_passe1 = document.formulaire.pass.value;
mot_de_passe2 = document.formulaire.pass2.value;

// si les deux saisies sont différentes :
if ( mot_de_passe1 != mot_de_passe2 ) {
window.alert('Vous n\'avez pas resaisi le meme mot de passe !');
return false;
}

// si elles ne sont pas différentes (si elles sont identiques en fait ;-)
else {
window.alert('C\'est bon, les deux mots de passe sont identiques');
return true;
}
}
