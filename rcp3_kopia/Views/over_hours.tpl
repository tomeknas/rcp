{extends 'Views/base_layout.tpl'}

{block name='head'}
    <link rel='stylesheet' type='text/css' href='{$SITE_URL}Includes/hint.css'>
{/block}

{block name='content'}
 
    <h2 align='center'>Nadgodziny</h2>
    <table class='gridtable centre'>
        <tr>
            <th rowspan='2' style='min-width: 200px'>Imię i nazwisko</th>
            <th rowspan='2'>Stan</th>
            <th rowspan="2">Wypłacone</th>
            <th rowspan="2">Odebrane</th>
            
{for $month = 1 to date('m')}
            <th colspan='{cal_days_in_month(1, $month, 2015)}'>{$monthNames[$month]}</th>
{/for}
        </tr>
        <tr>
{for $month = 1 to date('m')}
{for $day = 1 to cal_days_in_month(1, $month, 2015)}
            <th>{$day}</th>
{/for}
{/for}  
        </tr>
{foreach $users as $dude}
    <tr>
        <th>{$dude->getFullName()}</th>
        {$overHours = $dude->getOverHours(2015)}
        <th>{$overHours.total - $overHours.takenTotal - $overHours.modTotal}</th>
        <th>{$overHours.modTotal}</th>
        <th>{$overHours.takenTotal}</th>
        {foreach $overHours.daily as $monthNum => $month}
        {foreach $month as $dayNum => $day}
        <td
            {if $day.isHoliday}style='background-color: #efefef'{/if}
            class='clickable_cell'
            id='{$dude->id}-2015-{$monthNum}-{$dayNum}'
            {if $day.taken}style="background-color:red;"{/if}>
            <span class="hint--info hint--bottom"
                  style=""
data-hint="{$dude->getFullName()}&#10;2015-{$monthNum}-{$dayNum}{if $day.mod}&#10;Wypłacone nadgodziny: {$day.mod}{/if}{if $day.taken}&#10;Odebrane nadgodziny: {$day.taken}{/if}">
            {if $day.mod}
                <b>{$day.count - $day.taken - $day.mod} ({$day.count})</b>
            {else}
                {$day.count - $day.taken}
            {/if}
            </span>
        </td>
        {/foreach}
        {/foreach}
    </tr>
    
{/foreach}
    </table>
     <h5 align='center'>* podwójne kliknięcie na konkretny dzień danej osoby aby zmienić status nadgodzin</h5>
{/block}

{block name='body_end'}
<script>
$('.clickable_cell').dblclick( function(event) {
    event.preventDefault();
    newValue = prompt("Nadgodziny do wypłaty:", 0);
    if(null === newValue || isNaN(newValue))
    {
        return;
    }
    var dateArray = $(event.target).closest('td').attr('id').split("-");
    var userId = dateArray[0];
    var year = dateArray[1];
    var month = dateArray[2];
    var day = dateArray[3];
    $.post('{$SITE_URL}Users/updateOverHours/' + userId + '/' + year + '/' + month + '/' + day + '/',
                                            {literal}{ "new_value" : newValue }{/literal})
        .fail(function(v1, v2, text) {
            alert(text);
        })
        .done(function(text){
            document.location.reload();
        });
});
</script>

{/block}