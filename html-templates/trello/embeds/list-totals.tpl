{extends 'designs/trello-embed.tpl'}

{block css}
    {$dwoo.parent}
    <style>
        td:last-child {
            text-align: right;
        }
    </style>
{/block}

{block content}
    <table>
        {foreach from=$board->cards->sumNumberFieldsByList() item=sums key=listId}
            <thead>
                <tr>
                    <th colspan="2">{$board->lists[$listId].name|escape}</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$sums item=sum key=customFieldId}
                    <tr>
                        <td>{$board->customFields[$customFieldId].name|escape}</td>
                        <td alight="right">{number_format($sum)}</td>
                    </tr>
                {/foreach}
            </tbody>
            </tr>
        {/foreach}
    </table>
{/block}