{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
	{assign var="design" value="special/fiche-prod"}
{/block}

{* Le contenu de la page *}
{block name=content}
	<div id="fiche-produit">
		<span id="categorie-fiche-produit">JARDIN ></span><span id="sous-categorie-fiche-produit">Outils</span>
		
		<div id="image-fiche-produit">
			<img src="img/tronconeuse.jpg" alt="Tronconeuse"/>
		</div>
		<div id="fiche-technique-produit">
			<h2> TRONCONEUSE DE LA MORT QUI TUE </h2>
			
			<div id="fiche-technique-description-produit">
				<p>
					Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
					Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
					Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique 
					Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique Ceci est la fiche technique
				</p>
			</div>
			
			<div id="prix-fiche-produit">
				<h4>666E</h4>
			</div>
			<div id="ajouter-au-panier">
				<h4>Ajouter au panier !</h4>
			</div>

			<div id="select-quantite">
				<form method="post" action="#">
				   <p>
					   <label for="pays">Quantité :</label><br />
					   <select name="quantité" id="quantité">
						   <option value="1">1</option>
						   <option value="2">2</option>
						   <option value="3">3</option>
						   <option value="4">4</option>
						   <option value="5">5</option>
						   <option value="6">6</option>
						   <option value="7">7</option>
						   <option value="8">8</option>
					   </select>
				   </p>
				</form>
			</div>
			
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/greystar.png" alt="greyStar" /></div>
			<div class="rating-star"><img src="img/greystar.png" alt="greyStar" /></div>
			
			</br><div id="fiche-produit-nbavis"><h6>( 5 Avis )</h6></div>
		</div>
		
		<div class="avis-fiche-produit">
			<h3> Très efficace ! <h3>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<h6> Par : Jean-luc   le 06/06/06 </h6>
			<p>
				blabla blablablablablablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablablablablablabla
			</p>
		</div>
		
		<div class="avis-fiche-produit">
			<h3> Très efficace ! <h3>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
			<h6> Par : Jean-luc   le 06/06/06 </h6>
			<p>
				blabla blablablablablablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablabla
				blablablablablablablablablablablablablablablablablablablablablablablabla
			</p>
		</div>		
	</div>
{/block}
