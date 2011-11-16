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
                    {foreach from=$categories item=cat}
                        <input type="checkbox" name="categorie_{$cat->getId()}" id="categorie_{$cat->getId()}" 
                               value="{$cat->getId()}" />
                               <label for="categorie_{$cat->getId()}">{$cat->getNom()}</label>
                               <br/>
                    {/foreach}
                </div>
                
                <div id="bloc-droit-rech">
                    <div id="selection-prix">
                        <h4>Prix entre </h4>
                        <input name="prixmin" id="prixmin" size="5" type="text"/>                            
                        <h4>  € et </h4>
                        <input name="prixmax" id="prixmax" size="5" type="text"/>    
                        <h4> €</h4>
                    </div>
                    <div id="selection-achat-loc">
                        <input type="checkbox" name="achat" id="achat" value="1" />
                        <label for="achat">Achat</label> 
                        <input type="checkbox" name="location" id="location" value="2" />
                        <label for="location">Location</label> 
                    </div>            
                </div>
                
                
                
                
                
                <div id="submit-rech-avancee">
                    <input type="submit" value="C'est parti !" />
                </div>
        
            </form>
        </div>
    </div>
{/block}
