{* Le modèle de la page *}
{extends file="modele/main.tpl"}

{* Le design de la page *}
{block name=design}
    {assign var='design' value="admin"}
{/block}

{* Le contenu de la page *}
{block name=content}
    <div id="page-admin">
        <div id="panneau-admin">
            <h1>Panneau d'administrateur</h1>
            <div class="icon-panneau-admin">
                <a href="index.php?admin=MEMBRES">
                <div id="gestion-membres">
                    
                </div>
                </a>
                <a href="index.php?admin=MEMBRES">Gestion des membres</a>
                <p>Permet de bannir des membres ou d'en rendre certains administrateurs</p>
            </div>    
            <div class="icon-panneau-admin">
                <a href="index.php?admin=CATEGORIES">
                <div id="gestion-categories">
                    
                </div>
                </a>
                <a href="index.php?admin=CATEGORIES">Gestion des categories</a>
                <p>Permet d'ajouter, de modifier, de supprimer et d'organiser les catégories</p>
            </div>
            <div class="icon-panneau-admin">
                <a href="index.php?admin=CATEGORIES">
                <div id="gestion-produits">
                    
                </div>
                
                </a>
                <a href="index.php?admin=PRODUITS">Gestion des produits</a>
                <p>Permet d'ajouter, de modifier, de supprimer et d'organiser les produits</p>
            </div>
            <div class="icon-panneau-admin">
                <a href="index.php?admin=PRODUITS">
                <div id="gestion-question">
                    
                </div>
                
                </a>
                <a href="index.php?admin=CATEGORIES">Gestion des questions</a>
                <p>Permet de voir la liste des commentaires sur les produits afin de pouvoir les moderer et de répondre aux eventuelles questions</p>
            </div>
            <div class="icon-panneau-admin">
                <a href="index.php?admin=IMAGES">
                <div id="gestion-image">
                    
                </div>
                
                </a>
                <a href="index.php?admin=IMAGES">Gestion des images</a>
                <p>Permet de voir la liste des images, de les modifier, d'en ajouter et de supprimer les images inutiles</p>
            </div>
        </div>
    </div>
{/block}
