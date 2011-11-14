{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
	{assign var='design' value="special/recherche_avancee"}
{/block}

{* Le contenu de la page *}
{block name=content}
	<div id="page-rech-avancee">
		<div id="panneau-rech-avancee">
			<h1>Recherche Avancée</h1>
			<form action="index.php?action=RECHERCHE_AVANCEE" method="post">
				<div id="nom-prod-rech">
					<label for="nomprod">Nom de produit :</label>
					<input id="nomprod" name="nomprod" type="text" />
				</div>

				<div id="selection-categorie">
					<h4> Catégories : </h4>
					<input type="checkbox" name="categorie1" id="categorie1" value="1" /> Catégorie 1 </br>
					<input type="checkbox" name="categorie2" id="categorie2" value="2" /> Catégorie 2 </br>
					<input type="checkbox" name="categorie3" id="categorie3" value="3" /> Catégorie 3 </br>
					<input type="checkbox" name="categorie4" id="categorie4" value="4" /> Catégorie 4 </br>
				</div>
				
				<div id="bloc-droit-rech">
					<div id="selection-prix">
						<h4>Prix entre </h4>
						<select id="prixmin" size="1">
							<option>0</option>
							<option>5</option>
							<option>10</option>
							<option>15</option>
							<option>20</option>
							<option>25</option>
							<option>30</option>
							<option>35</option>
							<option>40</option>
							<option>45</option>
							<option>50</option>
							<option>60</option>
							<option>70</option>
							<option>80</option>
							<option>90</option>
							<option>100</option>
							<option>110</option>
							<option>120</option>
							<option>130</option>
							<option>140</option>
							<option>150</option>
							<option>160</option>
							<option>170</option>
							<option>180</option>
							<option>190</option>
							<option>200</option>
							<option>250</option>
							<option>300</option>
							<option>350</option>
							<option>400</option>
							<option>450</option>
							<option>500</option>
							<option>550</option>
							<option>600</option>
							<option>650</option>
						</select>
						<h4>  € et </h4>
						<select id="prixmin" size="1">
							<option>0</option>
							<option>5</option>
							<option>10</option>
							<option>15</option>
							<option>20</option>
							<option>25</option>
							<option>30</option>
							<option>35</option>
							<option>40</option>
							<option>45</option>
							<option>50</option>
							<option>60</option>
							<option>70</option>
							<option>80</option>
							<option>90</option>
							<option>100</option>
							<option>110</option>
							<option>120</option>
							<option>130</option>
							<option>140</option>
							<option>150</option>
							<option>160</option>
							<option>170</option>
							<option>180</option>
							<option>190</option>
							<option>200</option>
							<option>250</option>
							<option>300</option>
							<option>350</option>
							<option>400</option>
							<option>450</option>
							<option>500</option>
							<option>550</option>
							<option>600</option>
							<option>650</option>
						</select>
						<h4> €</h4>
					</div>
					<div id="selection-achat-loc">
						<input type="checkbox" name="achat" id="achat" value="1" /> Achat 
						<input type="checkbox" name="location" id="location" value="2" /> Location 
					</div>			
				</div>
				
				
				
				
				
				<div id="submit-rech-avancee">
					<input type="submit" value="C'est parti !" />
				</div>
		
			</form>
		</div>
	</div>
{/block}
