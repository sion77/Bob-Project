<ul id="liste_menu">
    <li><a href='index.php?page=CATEGORIES'>Acheter</a>
        <ul class="sous-menu">
            {foreach from=$categories item=mere name=categorieSousMenu}
                {if $smarty.foreach.categorieSousMenu.first}
                    <span class="first-elem-sous-menu">
                {elseif $smarty.foreach.categorieSousMenu.last}
                    <span class="last-elem-sous-menu">
                {else}
                    <span>
                {/if}
                    <li>
                        <a href='index.php?page=SOUSCATEGORIES&amp;id={$mere->getId()}'>
                            {$mere->getNom()}
                        </a>
                    </li>
                </span>
            {/foreach}
        </ul>
    </li>
    <li><a href='index.php?page=CATEGORIES-LOCATION'>Louer</a>
        {foreach from=$categories item=mere name=categorieSousMenu}
                {if $smarty.foreach.categorieSousMenu.first}
                    <span class="first-elem-sous-menu">
                {elseif $smarty.foreach.categorieSousMenu.last}
                    <span class="last-elem-sous-menu">
                {else}
                    <span>
                {/if}
                    <li>
                        <a href='index.php?page=SOUSCATEGORIES&amp;id={$mere->getId()}'>
                            {$mere->getNom()}
                        </a>
                    </li>
                </span>
            {/foreach}
    </li>
    <li><a href='index.php?page=ABOUT'>A propos</a>
    </li>
     <li><a href='index.php?page=CONTACT'>Contact</a>
    </li>
</ul>
