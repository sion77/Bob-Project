{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
	{assign var="design" value="special/sous-categorie"}
{/block}

{* Le contenu de la page *}
{block name=content}
	<div id="page-sous-categories">
		<h2>{$sc->getNom()}</h2>			
		<img src="img/pub-ideejardin.jpg" alt="Test categories"/>
				
		{* Bloc categorie *}
		{foreach from=$sc->getFils() item=f}
			
			{* On affiche le titre, l'image et la description de la catégorie *}
			<div class="sous-categorie">	
			
				<h4>{$f->getNom()}</h4>
				<img src="img/souscat-tondeuses.jpg" alt="Test categories"/>
				<p>
					{$f->getDesc()}
				</p>
				<a href='#'>Voir les autres produits</a>
				
			</div>			
		{/foreach}			
	</div>
{/block}
