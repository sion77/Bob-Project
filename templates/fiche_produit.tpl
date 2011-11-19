{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
    {assign var="design" value="special/fiche-prod"}
{/block}

{* Le contenu de la page *}
{block name=content}
    <div id="fiche-produit">
    
        {* Le path : tableau des parents *}
        {assign var="path" value=$prod->getCat()->getPath()}
        
        {* Pour chaque parent (jusqu'à soi) *}
        {foreach from=$path item=cat name="fastbar"} 
                 
            {* Pour chaque parent, on ajoute un lien pour revenir en arrière *}
            {if !$smarty.foreach.fastbar.first}
                <span id="sous-categorie-fiche-produit">
                    <a href="index.php?page=SOUSCATEGORIES&amp;id={$cat->getId()}">
                        {$cat->getNom()|lower|capitalize}</a>                     
            {else}
                <span id="categorie-fiche-produit">
                    <a href="index.php?page=SOUSCATEGORIES&amp;id={$cat->getId()}">
                        {$cat->getNom()|upper}</a>                     
            {/if}
            {if !$smarty.foreach.fastbar.last}
                >
            {/if}
            </span>
        {/foreach}
        
        <div id="image-fiche-produit">
            <img src="index.php?image={$prod->getImg()->getId()}" alt="Tronconeuse"/>
        </div>
        <div id="fiche-technique-produit">
            <h2>{$prod->getNom()}</h2>
            
            <div id="fiche-technique-description-produit">
                <p>
					{$prod->getDesc()}
                </p>
            </div>
            
            <div id="prix-fiche-produit">
                <h4>{$prod->getPrixVente()}€</h4>
            </div>
            <div id="ajouter-au-panier">
                <h4>Ajouter au panier !</h4>
            </div>

            <div id="select-quantite">
                <label for="pays">Quantité (stock : {$prod->getStock()}) :</label>
                <input type="text" name="quantité" id="quantité" size="3" />    
            </div>
            <br/>
            <div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
            <div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
            <div class="rating-star"><img src="img/yellowstar.png" alt="YellowStar" /></div>
            <div class="rating-star"><img src="img/greystar.png" alt="greyStar" /></div>
            <div class="rating-star"><img src="img/greystar.png" alt="greyStar" /></div>
        
            <div id="fiche-produit-nbavis"><h6>( 1 Avis )</h6></div>
        </div>
               
        {assign var=coms value=$prod->getCommentaires()} 
        {foreach from=$coms item=com}
			<div class="avis-fiche-produit">
				<h3>{$com->getNom()}</h3>
				{assign var=note value=$com->getNote()}
				{for $i = 1; $i <= $note; $i++}
					<div class="rating-star">
						<img src="img/yellowstar.png" alt="YellowStar" />
					</div>
				{/for}
				{for $i = $note; $i <= 5; $i++}
					<div class="rating-star">
						<img src="img/greystar.png" alt="greyStar" />
					</div>				
				{/for}
				
				<h6>Par : {$com->getMembre()->getPseudo()} le {$com->getDate()} </h6>
				<p>
					{$com->getTexte()}
				</p>
			</div>  
		{/foreach}  
            
        <div id="ajouter-un-avis">
			<h1>Ajouter un avis</h1>
			<form action="index.php?action=AJOUTECOMMENTAIRE" method="post">
			<p>
				<label for="titre">Titre :</label>
				<input id="titre" name="titre" type="text" />
				<label for="pseudo">Votre pseudo :</label>
				<input id="pseudo" name="pseudo" type="text" />
				<br/>
				<textarea name="commentaire" rows="8" cols="60"></textarea>
				
				<script type="text/javascript" src="js/notes.js"></script>
				
				<div id="select-quantite">				
					<label for="note">Note :</label><br />
					<div id="chooseNote" onmouseout="loosefocus();">
						{for $i = 1; $i <= 5; $i++}
							<div class="rating-star">
								<img src="img/yellowstar.png" 
									 id="star{$i}" 
									 onclick="etoile({$i});" 
									 onmouseover="focusetoile({$i});" />
							</div>
						{/for}
					</div>	
				</div>			
				
				<input type="hidden" id="note" name="note" value="1" />					
				<input type="submit" value="Envoyer" />		
			</p>		  
			</form>    
        </div>
{/block}
