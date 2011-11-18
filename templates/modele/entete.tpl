<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="pragma"        content="no-cache"                />
<link rel="stylesheet" media="screen" href="style.css" type="text/css"/>
<link rel="shortcut icon" href="favicon.ico" >
<!-- link rel="icon" type="image/gif" href="animated_favicon1.gif" -->

{block name=design}
    <!-- Pas de design supplémentaire -->
{/block}

{if isset($design)}
    {foreach from=$design item=item}
        <link rel="stylesheet" media="screen" href="css/{$item}.css" type="text/css"/>
    {/foreach}
{/if}

<title>Site - Chez Bob</title>

