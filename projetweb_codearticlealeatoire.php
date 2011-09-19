CODE ARTICLE ALEATOIRE

		<div id="random_stuff">
<?php


    $req = $bdd->prepare('SELECT ma_bite FROM TONCUL WHERE sodomy IS NOT NULL');
    $req->execute(array($random_stuff));
    $donnees = $req->fetch();
?>	
	
		<h2>Random bullshit !</h2>
		
		<div class="link_random_stuff"> <a href="XXX.php?page=<?php echo $donnees['id']; ?>"><?php echo htmlspecialchars($donnees['titre']); ?></a>
		</div>
		<div class="small_stuff_pic">
	    <a href="XXX.php?page=<?php echo $donnees['id']; ?>"><img src="img/smalls<?php echo htmlspecialchars($donnees['image']); ?>.jpg" alt="your naked mum pic"  /></a>
		</div>
		
		<div class="random_stuff_desc">
		<!-- pour tronquer la description de l'article au cas ou il est trop long -->
		<?php
		$lgmax = 150; // la longueur max d'un article
		$desc = $donnees['contenu'];
		if (strlen($desc) > $lgmax) {
		$desc = substr($desc, 0, $lgmax);
		$last_space = strrpos($desc, " "); 
		$desc = substr($desc, 0, $last_space)."...";	
		}
echo $desc;
?>

<span = "learnmore">
<a href="XXX.php?page=<?php echo $donnees['id']; ?>">Learn more</a>
</span>

</div>
</div>
