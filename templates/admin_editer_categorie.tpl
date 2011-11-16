{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
    {assign var='design' value="special"}
{/block}

{* Le contenu de la page *}
{block name="content"}
    {assign var="cat" value=$Bob->getCategorie($smarty.get.id)}
    <div id="page-editer-categorie">
        <div id="panneau-admin_editer_categorie">
            <h1>Editer une catégorie</h1>
            <form method="POST" action="index.php?admin=CATEGORIES&amp;action=EDITER&amp;id={$cat->getId()}">
            <p style="text-align: center;">
                <label for="titre">Le titre : </label>
                <input type="text" id="titre" name="titre" value="{$cat->getNom()}"/>
                <br/><br/>
                
                <label for="desc">Description : </label><br/>
                <textarea id="desc" name="desc" cols="70" rows="10">{$cat->getDesc()}</textarea>
                <br/><br/>
                
                <label for="mere">Attacher à : </label>
                <select id="mere" name="mere">
                    <optgroup label="Avant">
                        {if $cat->getMere() != null}
                            <option value="{$cat->getMere()->getId()}">{$cat->getMere()->affichePath()}</option>
                        {else}
                            <option value="NULL">/</option>
                        {/if}
                    </optgroup>
                    
                    {* On affiche tout sauf nous, notre mère et nos sous-catégories *}
                    <optgroup label="Modifier">
                        {if $cat->getMere() != null}
                            <option value="NULL">(categorie mère)</option>
                        {/if}            
                        
                        {* On affiche les freres et leurs sous-categories *}
                        {foreach from=$cat->getFreres() item=cats} 
                            {if $cats->getId() != $cat->getId()}
                                {$cats->afficheOption()}
                            {/if}
                        {/foreach}
                        
                        {* On affiche les frères de notre mères et leurs sous-catégories *}
                        {if $cat->getMere() != null}
                            {foreach from=$cat->getMere()->getFreres() item=cats} 
                                {if $cats->getId() != $cat->getMere()->getId()}
                                    {$cats->afficheOption()}
                                {/if}
                            {/foreach}
                        {/if}
                    </optgroup>
                </select>
                <br/><br/>
                <label for="image">Image : </label>
                <select id="image" name="image">
                    <optgroup label="Avant">
                        {if $cat->getImg() == NULL}
                            <option value="NULL">Par défaut</option>
                        {else}
                            <option value="{$cat->getImg()->getId()}">{$cat->getImg()->getTitre()}</option>
                        {/if}
                    </optgroup>
                    <optgroup label="Modifier">
                        {if $cat->getImg() != NULL}
                            <option value="NULL">Par défaut</option>
                        {/if}
                        {foreach from=$images item=img}
                            {if $cat->getImg() == NULL || $cat->getImg()->getId() != $img->getId()}
                                <option value="{$img->getId()}">{$img->getTitre()}</option>
                            {/if}
                        {/foreach}
                    </optgroup>
                </select>
                <br/><br/>
                
                <input type="submit" value="Modifier"/>
            </p>
            </form>
    </div>
    </div>
{/block}
