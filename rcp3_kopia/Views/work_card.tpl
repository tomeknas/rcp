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

    <div class="work-card">
        <h3 align='center'>Karta pracy</h3>
        <h3 align='center'>
            {$report->dayFrom}/{$report->monthFrom}/{$report->yearFrom}
            {if $report->fromDateTime|date_format:'d-m-Y' != $report->toDateTime|date_format:'d-m-Y'}
                - {$report->dayTo}/{$report->monthTo}/{$report->yearTo}
            {/if}
        </h2>
        <h4 align='center'>
            <a href='{$SITE_URL}Excel/workCard/{$report->yearFrom}/{$report->monthFrom}/{$report->yearTo}/{$report->monthTo}/'>
                - raport do pliku .xls -
            </a>
        </h4>
    </div>
    <div align='center' class="select-period">
                    <h3>Wybierz okres:</h3>
{html_select_date time=$report->fromDateTime field_order ='DMY' start_year='-5' end_year='+5' month_format='%m' year_extra='id="fromYear"' day_extra='id="fromDay"' month_extra='id="fromMonth"' } - 
{html_select_date  time=$report->toDateTime field_order = 'DMY' start_year='-5' end_year='+5' month_format='%m' year_extra='id="toYear"' day_extra='id="toDay"' month_extra='id="toMonth"' }
<br><br>
                    <button id='selectPeriodButton'>Pokaż</button>
    </div>


        <table class='gridtable centre table-report' style='margin-top: 240px'>
        <thead class="thead-row">
            <tr>
               <!--  <td style='border: none'>&nbsp;</td> -->
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
        </thead>

<thead class="thead-col">
{foreach $report->users as $user}
            <tr>
                <th>
                    <a href='{$SITE_URL}UserMonth/index/{$user.id}/{$report->yearTo}/{$report->monthTo}/'>
                        {$user.name}
                    </a>
                </th>
            </tr>
{/foreach}
</thead>

<tbody>
{foreach $report->users as $user}
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
                
{foreach $report->leftHorizontalTotals as $total}
                <th>{$total}h</th>
{/foreach}
{foreach $report->rightHorizontalTotals as $total}
                <th>{$total}h</th>
{/foreach}
                <th>{$report->totalsTotals}h</th>
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
     console.log(1);
        $(".thead-col").addClass("stickyLeft");
        $(".stickyLeft").css("top",posTop);
         $(".thead-row").addClass("sticky");
         $(".sticky").css("left",left);
         $(".thead-col").addClass("stickyLeft");
         $(".thead-col").css("left", "0px");

    } else if( (scrolLeft < navleft) && (scrolTop > NAvY) ){
        console.log(2);

        $(".thead-row").addClass("sticky");
        $(".sticky").css("left",left);
        $(".thead-col").removeClass("stickyLeft");
        $(".thead-col").css("top", "379px");

    } else if( (scrolLeft > navleft) && (scrolTop < NAvY) ){
        console.log(3);
     
        $(".thead-col").addClass("stickyLeft");
        $(".stickyLeft").css("top",posTop);
        $(".thead-row").css("left","158px");
        $(".thead-row").removeClass("sticky");
       
    } else {
       console.log(4);
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
            "{$SITE_URL}Users/report/"
            +$("#fromYear").val()+"/"
            +$("#fromMonth").val()+"/"
            +$("#fromDay").val()+"/"
            +$("#toYear").val()+"/"
            +$("#toMonth").val()+"/"
            +$("#toDay").val()+"/"
            );
    });
    
</script>

{/block}