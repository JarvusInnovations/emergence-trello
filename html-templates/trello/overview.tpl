{extends designs/site.tpl}


{block content}
    <header class="page-header">
        <h1 class="header-title title-1">Board: <code>{$board->name|escape}</code></h1>
    </header>

    <header class="section-header">
        <h2 class="header-title title-2">Custom Field Sums by Label</h2>
    </header>
    <table border="1" class="reading-width well">
        <tr>
            <th>Label</th>
            <th>Total</th>
        </tr>

        {foreach from=$board->cards->sumNumberFieldsByLabel() item=sums key=labelId}
            <tr>
                <td>{$board->labels[$labelId].name|escape}</td>
                <td>
                    <table border="1">
                        {foreach from=$sums item=sum key=customFieldId}
                            <tr>
                                <th scope="row">{$board->customFields[$customFieldId].name|escape}</th>
                                <td>{number_format($sum)}</td>
                            </tr>
                        {/foreach}
                    </table>
                </td>
            </tr>
        {/foreach}
    </table>

    <header class="section-header">
        <h2 class="header-title title-2">Custom Field Totals</h2>
    </header>
    <table border="1" class="reading-width well">
        {foreach from=$board->cards->sumNumberFields() item=sum key=customFieldId}
            <tr>
                <th scope="row">{$board->customFields[$customFieldId].name|escape}</th>
                <td>{number_format($sum)}</td>
            </tr>
        {/foreach}
    </table>


    <header class="section-header">
        <h2 class="header-title title-2">Processed Cards</h2>
    </header>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Labels</th>
            <th>Custom Fields</th>
        </tr>

        {foreach from=$board->cards item=card}
            <tr>
                <td>{$card.idShort}</td>
                <td>{$card.name|escape}</td>
                <td>
                    {foreach from=$card.labels item=label}
                        <div style="border-bottom: 10px dashed grey">
                            {$label.name|escape}
                        </div>
                    {/foreach}
                </td>
                <td>
                    {foreach from=$card.customFieldItems item=customFieldItem}
                        <div style="border-bottom: 1px dashed grey">
                            {$board->customFields[$customFieldItem.idCustomField].name|escape}
                            {if $customFieldItem.value.number}
                                : <code>{$customFieldItem.value.number}</code>
                            {/if}
                        </div>
                    {/foreach}
                </td>
            </tr>
        {/foreach}
    </table>
{/block}