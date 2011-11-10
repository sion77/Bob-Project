# La TODO list 
## Présentation d'une chose à faire
### La liste

1. Inserer une puce à la liste à l'aide d'une \*
2. Ajouter le titre en *italique* entre deux \*
3. Ajouter une éventuelle phrase de description

### Voila comment on détaillera ce qu'il faut faire

Pour commencer, on utilisera ### avant de mettre le titre

Ensuite, on met les points forts en gras en utilisant \** **les doubles étoiles** \**

## Liste

### En cours

* *Panneau d'admin* : Qui permettra à un admin de pouvoir faire (presque) tout ce qu'il veut
* *Fiche produit*
* *Recherche produit*
	* *Formulaire avancé* : **(FAIT)**
	* *algorithme de recherche* : **(Requete SQL simple)**
	* *Page résultat* : **(Sous-categorie fictive : resultat)**
* *Gestion des images* :
* *Gestion des utilisateurs* : **Si on a le temps**
* *Gestion des commentaires*
* *Gestion des coups de coeur*
	* *Meilleure vente*
	* *Meilleure note* : (si notes =, prendre meilleure vente)
* *Séparer Achat/Locations*
                
### Terminé

* *Dossier d'analyse* : A faire pour le **mardi** 18 octobre **avant 13 heures**

## Détails

### Panneau d'admin

Le panneau d'admin va devoir contenir :

* La gestion des membres : **(FAIT)**
* La gestion des catégories
	* Ajout **(FAIT)**
	* Edition/Organisation **En cours**
	* Suppression **En cours**
* La gestion des produits
* La gestion des commentaires
* Le design du panneau d'admin
	* Page principale **(FAIT)**
 	* Les autres pages

Et bien d'autres...

### Fiche produit

### Recherche produit

**Formulaire avancé** : Fait

**algorithme de recherche** : Une petite requete SQL à faire

**Page résultat** : Forme d'une page sous-categorie mais contenant le resultat
	
### Gestion des images

### Gestion des utilisateurs

### Gestion des commentaires

### Gestion des coups de coeur
**Meilleure vente** 

* Le produit le plus acheté/loué, 
* si ex-aequo, prendre la meilleure note, 
* si ex-aequo prendre aléatoirement

**Meilleure note**

* Le produit le mieux noté, 
* si ex-aequo, prendre la meilleure vente, 
* si ex-aequo prendre aléatoirement

### Séparer Achat/Locations

## Terminé

### Dossier d'analyse

Contenu dans le dossier /rapport/ACSI, ce dossier devra contenir :

* Cahier des charges
	* Intro
	* Définition des utilisateurs
	* Cas d'utilisation : description synthètique
	* Diagramme de ces cas
	* Description textuelle des 3 de ces cas les plus importants 
		* connection / inscription
		* recherche
		* fiche produit
	* Spécification des contraintes non fonctionnelles
		* rapidité de réponse
		* charte graphique utilisée
		* norme ergonomiques ( integré a la charte graphique )
		* portabilité de l'application
		* matériel/logiciels utilisés
		* etc..
* Analyse des données
	* Dico des données
	* Diagramme de classe
		* Justification des cardinalites
		* Précision des classes qui font ou non l'objet d'un historique
	* Liste des contraintes non modélisables (Ex : le format d'une adresse email)
	* Jeu de tests