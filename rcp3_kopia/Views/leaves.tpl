{extends 'Views/base_layout.tpl'}

{block name='head'}
    <link rel='stylesheet' type='text/css' href='{$SITE_URL}Includes/hint.css'>
{/block}

{block name='content'}
 
    <h2 align='center'>Urlopy</h2>
    <div align="center">
        <select id="month-select">
            <option id="0">Wybierz miesiąc</option>
            <option id="1">Styczeń 2015</option>
            <option id="2">Luty 2015</option>
            <option id="3">Marzec 2015</option>
            <option id="4">Kwiecień 2015</option>
            <option id="5">Maj 2015</option>
        </select>
    </div>
    <br><br>
    <table class='gridtable centre'>
        <tr>
            <th rowspan='2' style='min-width: 200px'>Imię i nazwisko</th>
            <th rowspan='2'>Zaległy z 2014*</th>
            <th rowspan='2'>Pula na 2015*</th>
            <th rowspan='2'>Wykorzystany</th>
            <th rowspan='2'>Pozostały</th>
            
            
{for $month = 1 to date('m')}
            <th class="month-{$month}" colspan='{cal_days_in_month(1, $month, 2015)}'>{$monthNames[$month]}</th>
{/for}
        </tr>
        <tr>
{for $month = 1 to date('m')}
{for $day = 1 to cal_days_in_month(1, $month, 2015)}
            <th class="month-{$month}">{$day}</th>
{/for}
{/for}  
        </tr>
{foreach $users as $dude}
    <tr>
        <th>{$dude->getFullName()}</th>
        {$overHours = $dude->getOverHours(2015)}
        <th class="clickable_cell2014" id="{$dude->id}">{$dude->leaves2014}</th>
        <th class="clickable_cell" id="{$dude->id}">{$dude->leaves}</th>
        <th>{$overHours.leavesTotal}</th>
        <th>{$dude->leaves + $dude->leaves2014 - $overHours.leavesTotal}</th>
        {foreach $overHours.daily as $monthNum => $month}
        {foreach $month as $dayNum => $day}
        <td class="month-{$monthNum}" style="{if $day.isHoliday}background-color: #efefef;{/if}{if $day.leaves}background-color: yellow;{/if}">
            {$day.leaves}
        </td>
        {/foreach}
        {/foreach}
    </tr>
    
{/foreach}
    </table>
     <h5 align='center'>* podwójne kliknięcie aby zmienić</h5>
{/block}

{block name='body_end'}
<script>

function monthFilter(monthNum) {
    if (monthNum === "0") {
        $("[class^=month-]").show();
        return;
    }
    $("[class^=month-]").hide();
    $(".month-"+monthNum).show();
}

$(document).ready(function() {
    if({if $monthFilter}{$monthFilter}{else}0{/if} > 0) {
        monthFilter({$monthFilter});
    }
});

$("#month-select").change(function() {
    //document.location.replace("{$SITE_URL}Users/leaves/" + $(this).children(":selected").attr("id") + "/");
    var id = $(this).children(":selected").attr("id");
    
    monthFilter(id);
});

$('.clickable_cell2014').dblclick( function(event) {
    event.preventDefault();
    newValue = prompt("Podaj nową wartość:", 0);
    if(null === newValue || isNaN(newValue))
    {
        return;
    }
    var userId = event.target.id;
    $.post('{$SITE_URL}Users/updateLeaves2014/' + userId + '/',
                                            {literal}{ "new_value" : newValue }{/literal})
        .fail(function(v1, v2, text) {
            alert(text);
        })
        .done(function(text){
            document.location.reload();
        });
});
    
$('.clickable_cell').dblclick( function(event) {
    event.preventDefault();
    newValue = prompt("Podaj nową wartość:", 0);
    if(null === newValue || isNaN(newValue))
    {
        return;
    }
    var userId = event.target.id;
    $.post('{$SITE_URL}Users/updateLeaves/' + userId + '/',
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