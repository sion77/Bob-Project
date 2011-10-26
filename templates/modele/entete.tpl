<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="pragma"		content="no-cache"				   />
<link rel="stylesheet" media="screen" href="style.css" type="text/css"/>

{block name=design}
	<!-- Aucun design supplémentaire -->
{/block}

{foreach from=$design item=item}
	<link rel="stylesheet" media="screen" href="css/{$item}.css" type="text/css"/>
{/foreach}

<title>Site - Chez Bob</title>
