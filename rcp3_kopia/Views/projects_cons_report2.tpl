{extends 'Views/base_layout.tpl'}

{block name='content'}
    
{$excelReportArgs = ''}
<div class="work-card">
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
 </div>  
    <div align='center' class="select-period" >
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
<br>


<table class='gridtable  table-report'>
<thead class="thead-row">
    <tr class="head-row"> 
        
{foreach $report->months as $month}
{$monthArray = explode('-', $month)}
        <th>
            <a href='{$SITE_URL}Users/report/{$monthArray.0}/{$monthArray.1}/{$monthArray.0}/{$monthArray.1}/'>
                {$month}
            </a> 
        </th>
{/foreach}
    </tr>
</thead>
<thead class="thead-col">
{foreach $report->projects as $project}
    <tr><th><a href='{$SITE_URL}Projects/report/{$project->id}/{$excelReportArgs}'>
                {$project->name}
            </a>
        </th>
    </tr>
{/foreach}
</thead>  
<tbody>  
    <tr>
        {foreach $report->projects as $project}
{foreach $report->months as $month}
{$value = $report->data[$project->id][$month]}
        <td>{if $value > 0}{$value|string_format:"%.1f"}d{/if}</td>
{/foreach}
        <th>{$report->totals.project[$project->id]|string_format:"%.1f"}d</th>
    </tr>
{/foreach}
    <tr>
      
{foreach $report->months as $month}
        <th>{$report->totals.month[$month]|string_format:"%.1f"}d</th>
{/foreach}
    </tr>
</tbody>
</table>
<br><br>

{/block}

{block name='body_end'}
    
<script>
$(document).ready(function(){
    
    function setLayout(){
    var marginLeftRow = $(".thead-col").width() -1;
    $(".thead-row").css("left",marginLeftRow);
    $(".table-report tbody").css("margin-left", marginLeftRow);
    var positionCol = $(".thead-row").position().top + $(".thead-row").height() -1;
    $(".thead-col").css("top",positionCol);
    var marginTopBody = $(".thead-row").height() -1;
    $(".table-report tbody").css("margin-top",marginTopBody);

    };
    
    var NAvY = $(".thead-row").offset().top;
    var navleft = $(".thead-col").offset().left;
    var stickyNav = function(){
    var scrolTop = $(window).scrollTop();
    var scrolLeft = $(window).scrollLeft();
    var left = navleft + $(".thead-col").width() - scrolLeft -1;
    var posTop = NAvY + $(".thead-row").height() - scrolTop -1;
   

  
    if ( (scrolLeft > navleft) && (scrolTop > NAvY) ){
     
        $(".thead-col").addClass("stickyLeft");
        $(".stickyLeft").css("top",posTop);
         $(".thead-row").addClass("sticky");
         $(".sticky").css("left",left);
         $(".thead-col").addClass("stickyLeft");
         $(".thead-col").css("left", "0px");

    } else if( (scrolLeft < navleft) && (scrolTop > NAvY) ){
        $(".thead-row").addClass("sticky");
        $(".sticky").css("left",left);
        $(".thead-col").removeClass("stickyLeft");
        $(".thead-col").css("top","187px");

    } else if( (scrolLeft > navleft) && (scrolTop < NAvY) ){
     
        $(".thead-col").addClass("stickyLeft");
        $(".stickyLeft").css("top",posTop);
        $(".thead-row").css("left","379px");
        $(".thead-row").removeClass("sticky");
       
    } else {
       
        $(".thead-row").removeClass("sticky");
        $(".thead-col").removeClass("stickyLeft");
        $(".thead-row").css("left","379px");
        $(".thead-col").css("left", "0px");

        setLayout();
    }
   
    
        
    };
    stickyNav();
    $(window).scroll(function(){
        stickyNav();
    });
});
    
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
