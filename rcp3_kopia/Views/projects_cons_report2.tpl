{extends 'Views/base_layout.tpl'}

{block name='content'}
    
{$excelReportArgs = ''}
    <h2 align='center'>Raport zbiorczy</h2>
    <h3 align='center'>
{if $report->allTime}
        * cały czas *
{else}
{$excelReportArgs = $report->period.from.year|cat:'/'|cat:$report->period.from.month|cat:'/'|cat:$report->period.to.year|cat:'/'|cat:$report->period.to.month|cat:'/'}
        {$report->period.from.month}/{$report->period.from.year}
{if $report->period.to != $report->period.from}
        - {$report->period.to.month}/{$report->period.to.year}
{/if}
{/if}
    </h3>
    <h3 align='center'> - raport do pliku:
        <a href='{$SITE_URL}Excel/consReport/{$excelReportArgs}'>
            .xls
        </a>
            |
        <a href='{$SITE_URL}Excel/consReportPdf/{$excelReportArgs}'>
            .pdf
        </a>    
            -
    </h3>
    
<table class='gridtable centre'>
    <tr>
        <td style='border: none'>&nbsp;</td>
{foreach $report->months as $month}
{$monthArray = explode('-', $month)}
        <th width='70'>
            <a href='{$SITE_URL}Users/report/{$monthArray.0}/{$monthArray.1}/{$monthArray.0}/{$monthArray.1}/'>
                {$month}
            </a>
        </th>
{/foreach}
    </tr>
{foreach $report->projects as $project}
    <tr>
        <th>
            <a href='{$SITE_URL}Projects/report/{$project->id}/{$excelReportArgs}'>
                {$project->name}
            </a>
        </th>
{foreach $report->months as $month}
{$value = $report->data[$project->id][$month]}
        <td>{if $value > 0}{$value|string_format:"%.1f"}d{/if}</td>
{/foreach}
        <th>{$report->totals.project[$project->id]|string_format:"%.1f"}d</th>
    </tr>
{/foreach}
    <tr>
        <td style='border: none'>&nbsp;</td>
{foreach $report->months as $month}
        <th>{$report->totals.month[$month]|string_format:"%.1f"}d</th>
{/foreach}
    </tr>
</table>
<br><br>
<div align='center'>
<h3>Wybierz okres:</h3>
{if !$report->allTime}
{$fromDateTime = $report->period.from.dateTime}
{$toDateTime = $report->period.to.dateTime}
{else}
{$fromDateTime = ''}
{$toDateTime = ''}
{/if}
{html_select_date time={$fromDateTime} display_days=false month_format='%m' start_year='-5' end_year='+5' year_extra='id="fromYear"' month_extra='id="fromMonth"'} - 
{html_select_date time={$toDateTime} display_days=false month_format='%m' start_year='-5' end_year='+5' year_extra='id="toYear"' month_extra='id="toMonth"'}
<br><br>
<button id='selectPeriodButton'>Pokaż</button>
</div>
{/block}

{block name='body_end'}
    
<script>
    
    $("#fromMonth").change( function() {
        $("#toMonth").val( $(this).val() );
    });
    
    $("#fromYear").change( function() {
        $("#toYear").val( $(this).val() );
    });
    
    
    $("#selectPeriodButton").click( function(event) {
        event.preventDefault();
        document.location.replace(
            "{$SITE_URL}Projects/consReport/"
            +$("#fromYear").val()+"/"
            +$("#fromMonth").val()+"/"
            +$("#toYear").val()+"/"
            +$("#toMonth").val()+"/"
            );
    });
    
</script>

{/block}
