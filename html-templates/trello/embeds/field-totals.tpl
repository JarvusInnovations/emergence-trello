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
        <tbody>
            {foreach from=$board->cards->sumNumberFields() item=sum key=customFieldId}
                <tr>
                    <td>{$board->customFields[$customFieldId].name|escape}</td>
                    <td alight="right">{number_format($sum)}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
{/block}