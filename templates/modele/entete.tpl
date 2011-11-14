<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="pragma"        content="no-cache"                   />
<link rel="stylesheet" media="screen" href="style.css" type="text/css"/>

{assign var="noDesign" value=false}

{block name=design}
    {assign var="noDesign" value=true}
    <!-- Aucun design supplémentaire -->
{/block}

{if !$noDesign}
    {foreach from=$design item=item}
        <link rel="stylesheet" media="screen" href="css/{$item}.css" type="text/css"/>
    {/foreach}
{/if}

<title>Site - Chez Bob</title>
