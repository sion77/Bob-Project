{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
    {assign var='design' value="special"}
{/block}

{block name=content}
    <div id="page-admin-produits">
        <div id="panneau-admin-produits">
            <h1>Ajouter un produit</h1>
            <form method="post" action="index.php?admin=PRODUITS&amp;action=CREER">
            <p>
                <label for="nom">Nom du produit : </label>
                <input type="text" name="nom" id="nom" /><br/><br/>

                <label for="desc">Description :</label><br/>
                <textarea id="desc" name="desc" rows="15" cols="100"></textarea><br/><br/>

                <label for="prixA">Prix Achat (0 si non achetable) :</label>
                <input type="text" name="prixA" id="prixA" value="0" /><br/><br/>
                
                <label for="prixL">Prix Location (0 si non louable) :</label>
                <input type="text" name="prixL" id="prixL" value="0" /><br/><br/>

                <label for="stock">Stock de base :</label>
                <input type="text" name="stock" id="stock" value="0" /><br/><br/>

                <label for="cat">Attacher à : </label>
                <select id="cat" name="cat">
                    {foreach from=$categories item=cat} 
                        {$cat->afficheOption()}
                    {/foreach}
                </select>
                <br/><br/>

                <label for="image">Image : </label>
                <select id="image" name="image">
                    <option value="NULL">(image par défaut)</option>
                    {foreach from=$images item=img} 
                        <option value="{$img->getId()}">{$img->getTitre()}</option>
                    {/foreach}
                </select>
                <br/><br/>
                
                <input type="submit" value="Envoyer" />
            </p>
            </form>    
            <h1>Modifier un produit</h1>
            <ul>
                {foreach from=$produits item=cat}
                    <li>{$cat->getNom()}</li>
                {/foreach}
            </ul>
        </div>
    </div>
{/block}
