{extends 'Views/base_layout.tpl'}

{block name='head'}
    
    <style>
        
     th.rotate {
  /* Something you can count on */
  height: 140px;
  white-space: nowrap;
}

th.rotate > div {
  transform: 
    /* Magic Numbers */
    translate(25px, 51px)
    /* 45 is really 360 - 45 */
    rotate(315deg);
  width: 30px;
}
th.rotate > div > span {
  border-bottom: 1px solid #ccc;
  padding: 5px 10px;
}
        
        
    </style>
    
{/block}

{block name='content'}
        <h2 align='center'>Karta pracy</h2>
        <h2 align='center'>
            {$report->monthFrom}/{$report->yearFrom}
            {if $report->fromDateTime|date_format:'Y-m' != $report->toDateTime|date_format:'Y-m'}
                - {$report->monthTo}/{$report->yearTo}
            {/if}
        </h2>
        <h3 align='center'>
            <a href='{$SITE_URL}Excel/workCard/{$report->yearFrom}/{$report->monthFrom}/{$report->yearTo}/{$report->monthTo}/'>
                - raport do pliku .xls -
            </a>
        </h3>

        <table class='gridtable centre' style='margin-top: 100px'>
            <tr>
                <td style='border: none'>&nbsp;</td>
{foreach $report->projects as $project}
                <th style='background: none; border: none' class="rotate"><div><span>
                    <a href='{$SITE_URL}Projects/report/{$project.id}/'>
                        {$project.name}
                    </a>
                </span></div></th>
{/foreach}
{foreach $report->project3Tasks as $project3Task}
                <th style='background: none; border: none' class="rotate"><div><span>
                    <a href='{$SITE_URL}Projects/report/3/'>
                        {$project3Task.name}
                    </a>
                </span></div></th> 
{/foreach}
            </tr>
{foreach $report->users as $user}
            <tr>
                <th>
                    <a href='{$SITE_URL}UserMonth/index/{$user.id}/{$report->yearTo}/{$report->monthTo}/'>
                        {$user.name}
                    </a>
                </th>
{foreach $report->leftTableContent[$user@index] as $dur}
                <td>{if $dur}{$dur}h{else}&nbsp;{/if}</td>
{/foreach}
{foreach $report->rightTableContent[$user@index] as $dur}
                <td>{if $dur}{$dur}h{else}&nbsp;{/if}</td>
{/foreach}
                <th>{$report->verticalTotals[$user@index]}h</th>
            </tr>
{/foreach}
            <tr>
                <td style='border: none'>&nbsp;</td>
{foreach $report->leftHorizontalTotals as $total}
                <th>{$total}h</th>
{/foreach}
{foreach $report->rightHorizontalTotals as $total}
                <th>{$total}h</th>
{/foreach}
                <th>{$report->totalsTotals}h</th>
            </tr>
        </table>
            <br><br>
                <div align='center'>
                    <h3>Wybierz okres:</h3>
{html_select_date time=$report->fromDateTime display_days=false start_year='-5' end_year='+5' month_format='%m' year_extra='id="fromYear"' month_extra='id="fromMonth"'} - 
{html_select_date time=$report->toDateTime display_days=false start_year='-5' end_year='+5' month_format='%m' year_extra='id="toYear"' month_extra='id="toMonth"'}
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
            "{$SITE_URL}Users/report/"
            +$("#fromYear").val()+"/"
            +$("#fromMonth").val()+"/"
            +$("#toYear").val()+"/"
            +$("#toMonth").val()+"/"
            );
    });
    
</script>

{/block}