{extends 'Views/base_layout.tpl'}

{block name='content'}
    

    <h2 align='center'>Raport zbiorczy</h2>
    <h2 align='center'>Rok: {$report->year}</h2>
    
<table class='gridtable centre'>
    <tr>
        <td style='border: none'>&nbsp;</td>
{for $month=1 to 12}
        <th width='50'>{$month}</th>
{/for}
    </tr>
{foreach $report->projects as $project}
    <tr>
        <th>{$project->name}</th>
{for $month=1 to 12}
{$value = $report->data[$project->id][$month]}
        <td>{if $value > 0}{$value|string_format:"%.1f"}d{/if}</td>
{/for}
    </tr>
{/foreach}
    <tr>
        <td style='border: none'>&nbsp;</td>
{for $month=1 to 12}
        <th width='50'>{$report->totals[$month]|string_format:"%.1f"}d</th>
{/for}
    </tr>
</table>
<br><br>
<div align='center'>
    <h3>Wybierz okres:</h3>
{html_select_date display_days=false display_months=false start_year='-5' end_year='+5' year_extra='id="selectYear"'}
</div>
{/block}

{block name='body_end'}
    
<script>
    
    $("#selectYear").change( function(event) {
        event.preventDefault();
        document.location.replace(
            "{$SITE_URL}Projects/consReport/"
            +$("#selectYear").val()+"/"
            );
    });
    
</script>

{/block}
