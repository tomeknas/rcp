{extends 'Views/base_layout.tpl'}
{block name='head'}
    <link rel='stylesheet' type='text/css' href='{$SITE_URL}Application/gantt/jquery.ganttView.css'>
    <link rel='stylesheet' type='text/css' href='{$SITE_URL}Application/gantt/jquery-ui-1.8.4.css'>
{if !$project->active}
    <link rel='stylesheet' type='text/css' href='{$SITE_URL}Includes/notification-boxes.css'>
{/if}
{/block}
{block name='content'}
    
    
    <div id="quarter">
    <table class='gridtable centre'>
        <tr>
            <th>Nazwa projektu</th>
            <td>{$project->name}</td>
        </tr>
        <tr>
            <th>Opis</th>
            <td>{$project->description}</td>
        </tr>
        <tr>
            <th>Grupa</th>
            <td>{$project->groupName()}</td>
        </tr>
        <tr>
            <th>Numer zlecenia</th>
            <td>{$project->orderNumber}</td>
        </tr>
        <tr>
            <th>Klient</th>
            <td>{$project->client}</td>
        </tr>
        {if $project->beginTimeStamp > 0}
        <tr>
            <th>Data rozpoczęcia</th>
            <td>{$project->beginTimeStamp|date_format:'%Y-%m-%d'}</td>
        </tr>
        {/if}
        {if $project->endTimeStamp > 0}
        <tr>
            <th>Data zakończenia</th>
            <td>{$project->endTimeStamp|date_format:'%Y-%m-%d'}</td>
        </tr>
        {/if}
        <tr>
            <th>Kierownik projektu</th>
            <td>{$project->projectManager->getFullName()}</td>
        </tr>
        <tr>
            <th>Koordynator projektu</th>
            <td>
             
                {$project->projectCoordinat->getFullName()}
                 
             </td>
        </tr>
        <tr>
            <th>Budżet (dni)</th>
            <td>{$project->budget}</td>
        </tr>
        <tr>
            <th>Budżet (zł)</th>
            <td>{$project->budgetPLN}</td>
        </tr>
        <tr>
            <th>Budżet (PM)</th>
            <td>{$project->budgetPM}</td>
        </tr>
        <tr>
            <th>Postęp prac</th>
            <td>{$project->progress}%</td>
        </tr>
        {if $project->sent}
        <tr>
            <th>Data wysyłki</th>
            <td>{$project->sent|date_format:'%Y-%m-%d'}</td>
        </tr>
        {/if}
        <tr>
            <td colspan="2" align="center"><a href="{$SITE_URL}PDF/index/{$project->id}">* Plan realizacji usługi (pdf) *</a></td>
        </tr>
        {if $user->accessLevel > 1}
        <tr>
            <td colspan="2" align="center"><a href="{$SITE_URL}Projects/editForm/{$project->id}">Edycja projektu</a></td>
        </tr>
        {/if}
        {if !$project->active}
        <tr>
            <td style='border: none' colspan='2'>
                <div class='notice error'>
                    <p>Projekt jest nieaktywny.<br><br><a id='project-activate-link' href='#'> - przywróć -</a></p>
                </div>
            </td>
        </tr>
        {/if}
    </table>
    </div>
    <div id="quarter">
        <h2 align="center">Historia zmian</h2>
        <table class="gridtable centre">
            <tr>
                <th>Osoba</th>
                <th>Zmiana</th>
                <th>Data</th>
                <th>Zatwierdził</th>
            </tr>
            {foreach $projectEvents as $event}
            <tr>
                <td>{$event->getUser()->getFullName()}</td>
                <td>{$event->event}</td>
                <td>{$event->time|date_format:"%Y-%m-%d"}</td>
                {$acceptedBy = $event->getAccepts()}
                <td>{if $acceptedBy}{$acceptedBy->getFullName()}{/if}</td>
            </tr>
            {/foreach}
        </table>
    </div>
    {if $project->beginTimeStamp > 0 && $project->endTimeStamp > 0}
    <div id="half" style="">
        <h2 align="center">Plan realizacji usługi</h2>
{*        <div id="gantt"  style="padding: 20px 50px 20px 100px; display: inline-block;"></div>*}
    <div style="text-align: center;">
    
        <div id="gantt" style="display: inline-block; text-align: initial"></div>
    </div>
    </div>
    {/if}
    <div id="half">
        <br><br>
      
        <h2 align='center'>Podsumowanie godzin</h2>
{if !$allTime}
        <h2 align='center'>{$args[2]}/{$args[1]} - {$args[4]}/{$args[3]}</h2>
{/if}
    
        <table class='gridtable centre'>
            <tr>
                <td style='border: none'>&nbsp;</td>
{foreach $report->tasks as $task}
                <th>{$task->name}</th>
{/foreach}
            </tr>
{foreach $report->users as $user}
            <tr>
                <th>{$user->getFullName()}</th>
{foreach $report->tasks as $task}
                <td>{$report->data[$task->id][$user->id]}h</td>
{/foreach}
                <th>{$report->usersTotal[$user->id]}h</th>
            </tr>
{/foreach}
            <tr>
                <td style='border: none'>&nbsp;</td>
{foreach $report->tasks as $task}
                <th>{$report->tasksTotal[$task->id]}h</th>
{/foreach}
                <th>{$report->total}h</th>
            </tr>
        </table>
            <br><br>
                <div align='center'>
                    <h3>Wybierz okres:</h3>
{html_select_date display_days=false start_year='-5' end_year='+5' month_format='%m' year_extra='id="fromYear"' month_extra='id="fromMonth"'} - 
{html_select_date display_days=false start_year='-5' end_year='+5' month_format='%m' year_extra='id="toYear"' month_extra='id="toMonth"'}
<br><br>
                    <button id='selectPeriodButton'>Pokaż</button>
                </div>
    </div>
{/block}

{block name='body_end'}
<script type="text/javascript" src="{$SITE_URL}Application/gantt/date.js"></script>
<script type="text/javascript" src="{$SITE_URL}Application/gantt/jquery-ui-1.8.4.js"></script>
<script type="text/javascript" src="{$SITE_URL}Application/gantt/jquery.ganttView.js"></script>
    
<script>
    var ganttData = [
        {foreach $report->tasks as $task}
            {ldelim}
                id: {$task->id}, name: "{$task->name}", progress: {$task->progress}, series: [
                    {ldelim} 
                        name: "", 
                        start: new Date({if $task->begin}{$task->begin}{else}{$project->beginTimeStamp}{/if} * 1000), 
                        end: new Date({if $task->end}{$task->end}{else}{$project->endTimeStamp}{/if} * 1000) 
                    {rdelim}
                ]
            {rdelim},
        {/foreach}
    ];

    $(function () {
        $("#gantt").ganttView({ 
            data: ganttData,   
            slideWidth: "800",
            behavior: {
                draggable: false,
                resizable: false,
                onClick: function(data) { 
                    //alert(data.start);
                    return;
                    var newProgress = prompt("Postęp prac (%):", data.progress);
                    if (isNaN(newProgress) || (null === newProgress) || data.progress === newProgress || newProgress < 0 || newProgress > 100) {
                        return;
                    }

                    $.post('{$SITE_URL}ProjectAction/setTaskProgress/' + data.id + '/', {literal}{ "new_progress" : newProgress }{/literal})
                        .fail(function(v1, v2, text) {
                            alert(text);
                        })
                        .done(function(text){
                            document.location.reload();
                        });
                }
            }
        });
    });
        
    $("#project-activate-link").click( function(event) {
        event.preventDefault();
        
        $.get('{$SITE_URL}ProjectAction/close/{$project->id}/')
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $("#selectPeriodButton").click( function(event) {
        event.preventDefault();
        document.location.replace(
            "{$SITE_URL}Projects/report/{$report->projectId}/"
            +$("#fromYear").val()+"/"
            +$("#fromMonth").val()+"/"
            +$("#toYear").val()+"/"
            +$("#toMonth").val()+"/"
            );
    });
    
</script>

{/block}