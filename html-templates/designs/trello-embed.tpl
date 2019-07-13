<!DOCTYPE html>
{load_templates designs/site.subtemplates.tpl}

<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> {* disable IE compatibility mode, use Chrome Frame if available *}

    {block "meta"}{/block}

    {block "viewport"}
        <meta name="viewport" content="width=device-width, initial-scale=1"> {* responsive viewport *}
    {/block}

    <title>{block "title"}{$.Site.title|escape}{/block}</title>

    {block "css"}
        {include includes/site.css.tpl}
        <style>
            html {
                height: 100%;
            }
            body {
                min-height: 100%;
            }
            main > table {
                margin: 0;
            }
        </style>
    {/block}
</head>

<body class="{block 'body-class'}{str_replace('/', '_', $.responseId)}-tpl{/block}">
    <div class="wrapper site clearfix">

    <main class="content site clearfix" role="main"> {* !.site.content *}
        {block "content"}{/block}
    </main>

    </div> {* end .site.wrapper *}

</body>

</html>