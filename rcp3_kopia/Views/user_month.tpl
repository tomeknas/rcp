{extends file='Views/base_layout.tpl'}


{block name=head}
{if $showMediabox}
        <link rel='stylesheet' type='text/css' href='{$SITE_URL}Includes/mediabox.css'>
        <script>var baseUrl = '{$SITE_URL}';</script>
        <script src='{$SITE_URL}Includes/mediabox.js'></script> 
{/if}
{/block}


{block name=content}
    <h2 align='center'>{$cal->user->getFullName()}</h2>
    <h2 align='center'><a href="{$SITE_URL}UserMonth/index/{$cal->user->id}/{$cal->prevMonthYear}/{$cal->prevMonth}/"><<</a>
    {$cal->monthName} {$cal->yearNum}
    <a href="{$SITE_URL}UserMonth/index/{$cal->user->id}/{$cal->nextMonthYear}/{$cal->nextMonth}/">>></a></h2>

<table id='calendar' class='gridtable centre'>
    <colgroup>
       <col span="1" style="width: 50px;">
       <col span="1" style="width: 110px;">
       <col span="1" style="width: 110px;">
       <col span="1" style="width: 40px;">
       <col span="1" style="width: 80px;">
       <col span="1" style="width: 300px;">
       <col span="1" style="width: 300px;">
       <col span="1" style="width: 50px;">
    </colgroup>
<thead>
    
<tr><th>Dzień</th><th>Początek</th><th>Koniec</th>
<th>Czas</th><th>Nadgodziny</th><th>Zadanie</th>
<th>Komentarz</th><th>Edycja</th></tr>
</thead>
{foreach $cal as $day}
<tbody id='{$day->dayNum}' class='holiday{$day->isHoliday}{if $day->isToday} today{/if}'>
    <tr>
    <td rowspan='{math equation='max(a,b)' a=1 b=count($day)}' valign='bottom'>
        <a class='add_link' href='#' id='{$day->dayNum}'{if $day->isToday and $showMediabox} data-mediabox="{$user->id}" data-direction="top" data-title="Nowe zadanie" data-content="Aby dodać nowy wpis, kliknij +"{/if}>
            +
        </a> {$day->dayNum}
    </td>
{foreach $day as $task}
{if $task@iteration > 1}
    <tr>
{/if}
        <td id="cellBegin{$task->id}">{$task->beginTime}</td>
        <td id="cellEnd{$task->id}">{$task->endTime}</td>
        <td>{$task->duration}h</td>
{if $task@iteration == 1}
        <td rowspan='{math equation='max(a,b)' a=1 b=count($day)}' valign='bottom'>{$day->overHoursDaily}h{if $day->isToday} ({$cal->overHoursSoFar($day->dayNum)}h){/if}</td>
{/if}  
        <td id="cellTask{$task->id}">{$task->getTask()->getProject()->name} - {$task->getTask()->name}</td>
        <td id="cellComment{$task->id}">{$task->comment}</td>
        <td id="cellSubmit{$task->id}">
            <a class='edit_link' href='#' id='{$task->id}'>E</a>&nbsp;&nbsp;
            <a class='delete_link' href='#' id='{$task->id}'>X</a>
        </td>
    </tr>
{/foreach}
{if count($day) == 0}
        <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>{if $day->isToday} ({$cal->overHoursSoFar($day->dayNum)}h){/if}</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
    </tr>
{/if}
</tbody>
{/foreach}
<tfoot>
    <tr>
        <th rowspan='{$cal->summary.totalsCount}' colspan='3' style='background: none; border: none; text-align: right; vertical-align: text-top;'>
            Suma:
        </th>
        <th>{$cal->summary.total}h</th>
        <th>{$cal->summary.overHours}h</th>
    </tr>
{foreach $cal->summary.projects as $projectName => $project}
    <tr>
        <th>{$project.total}h</th>
        <th colspan='2'>{$projectName}</th>
    </tr>
{foreach $project.tasks as $taskName => $taskTotal}
    <tr>
        <td>{$taskTotal}h</td>
        <td colspan='2'> - {$taskName}</td>
    </tr>
{/foreach}
{/foreach}
</tfoot>


</table>



    <table id="hidden_table" hidden="hidden">
    <tr id='form_row'>
    <form id='add_form'>
        <td>{html_select_time display_seconds=false minute_interval=30 field_separator=' : ' prefix='begin_' hour_extra='id="beginHourEdit"' minute_extra='id="beginMinuteEdit"'}</td>
        <td>{html_select_time display_seconds=false minute_interval=30 field_separator=' : ' prefix='end_' hour_extra='id="endHourEdit"' minute_extra='id="endMinuteEdit"'}</td>
        <td></td>
        <td>
            <select id='group_select' style='width: 280px'>
                <option value="-1">Wybierz grupę</option>
{foreach $groups as $group}
                <option id="{$group->id}" value="{$group->id}">{$group->name}</option>
{/foreach}
            </select><br>
            <select id="project_select" style="width: 280px">
                <option value="-1"> --- </option>
            </select><br>
            <select id="task_select" name="task_id" style="width: 280px">
                <option value='-1'> --- </option>
            </select>
        </td>
        <td><input id="commentEdit" name="comment" style="width: 280px"></td>
        <td><input type="submit" value="Dodaj"/></td>
    </form> 
    </tr>
    </table>
{/block}

{block name=body_end}
<script>
    var formSelectedDay = 0;
    var editedUserTask = 0;
    var editMode = false;
    
    var defaultRowBackground;
 
    
    $( ".delete_link").click( function(event) {
        event.preventDefault();
        
        if (!confirm("Na pewno usunąć wpis?")) {
            return;
        }
        
        $.get("{$SITE_URL}UserTask/delete/"+ event.target.id +"/")
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $( ".edit_link ").click( function(event) {
        event.preventDefault();
        
        if(editMode && editedUserTask == event.target.id) {
            editMode = false;
            $( "*" ).css("text-decoration", "none");
            $("#hidden_table").append( $("#form_row") );
            return;
        }
        
        editedUserTask = event.target.id;
        
        $( ".add_link").html('+');
        formSelectedDay = 0;
        
        $.get("{$SITE_URL}TaskPickup/getUserTask/"+ event.target.id +"/")
            .done( function(data){
                var userTask = $.parseJSON(data);
                
                var dayNumberCell = $( "#cellBegin" + event.target.id).parent().parent().children("tr:first-child").children("td:first");
                var overHoursCell = $( "#cellBegin" + event.target.id).parent().parent().children("tr:first-child").children("td:nth-child(5)");
                dayNumberCell.prop("rowspan", dayNumberCell.prop("rowspan") + 1);
                overHoursCell.prop("rowspan", overHoursCell.prop("rowspan") + 1);
                
                
                $("#cellBegin" + event.target.id).parent().after($("#form_row"));
                $("#beginHourEdit").val(userTask.beginHour);
                $("#beginMinuteEdit").val(userTask.beginMinute);
                $("#endHourEdit").val(userTask.endHour);
                $("#endMinuteEdit").val(userTask.endMinute);
                $("#commentEdit").val(userTask.comment);
                $("#group_select").val(userTask.groupId);
                
                $("#project_select > option").remove();
                $.each(userTask.projects, function(id, name) {
                    $( "#project_select" ).append("<option id='"+ id +"' value='"+ id +"'>" + name + "</option>");
                });
                
                $("#project_select").val(userTask.projectId);
                
                $("#task_select > option").remove();
                $.each(userTask.tasks, function(id, name) {
                    $( "#task_select" ).append("<option value='"+ id +"'>" + name + "</option>");
                });
                
                $("#task_select").val(userTask.taskId);
                
                editMode = true;
                $( "*" ).css("text-decoration", "none");
                $( event.target ).parent().parent().children().css("text-decoration", "line-through");
                $(":submit").val("Zapisz");
            });
    });
    
    $(".add_link").click( function(event) {
        event.preventDefault();


        editedUserTask = 0;
        editMode = false;
        $( "*" ).css("text-decoration", "none");
        $(":submit").val("Dodaj");
        
        $( ".add_link").html('+');
        
        if (formSelectedDay == event.target.id) {
            $("#hidden_table").append( $("#form_row") );
            formSelectedDay = 0;
            return;
        }
        
        formSelectedDay = event.target.id;
        $( event.target ).html('-');
        
        var dayNumberCell = $( "#calendar > tbody#" + event.target.id + " > tr:first > td:first");
        var overHoursCell = $( "#calendar > tbody#" + event.target.id + " > tr:first > td:nth-child(5)");
        dayNumberCell.prop("rowspan", dayNumberCell.prop("rowspan") + 1);
        overHoursCell.prop("rowspan", overHoursCell.prop("rowspan") + 1);
        
        $( "#calendar > tbody#" + event.target.id )
                .append( $("#form_row") );
        
    });
    
    $( "#add_form" ).submit( function( event ){
        event.preventDefault();
        if ( $("#task_select > option:selected").val() < 0 ) {
            alert("Wybierz zadanie");
            return;
        }
        var url;
        if (!editMode) {
            url = "{$SITE_URL}UserTask/add/{$user->id}/{$cal->yearNum}/{$cal->monthNum}/"+formSelectedDay+"/";
        } else {
            url = "{$SITE_URL}UserTask/update/"+editedUserTask+"/{$cal->yearNum}/{$cal->monthNum}/"
            + $("#cellBegin"+editedUserTask).parent().parent().prop("id");
        }
        $.post( url, $("#add_form").serialize() )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            })
            ;
    });
            
     $( "#group_select").change( function( event ){
        if ($("#group_select").val() < 0) {
            $( "#project_select > option" ).remove();
            $( "#project_select" ).append("<option value='-1'> --- </option>");
            
            $( "#task_select > option" ).remove();
            $( "#task_select" ).append("<option value='-1'> --- </option>");
            return;
        }
        $.get("{$SITE_URL}TaskPickup/getProjects/"+ $( "#group_select > option:selected" ).prop("id") +"/")
            .done( function(data){
                $( "#project_select > option" ).remove();
                $( "#project_select" ).append("<option> --- </option>");
                
                $( "#task_select > option" ).remove();
                $( "#task_select" ).append("<option> --- </option>");
                
                
                var projectList = $.parseJSON(data);
                $.each(projectList, function(key, project) {
                    $( "#project_select" ).append("<option id='" + project.id + "' value='"+ project.id +"'>" + project.name + "</option>");
                });
                $( "#project_select" ).show();
            });
    });
            
    $( "#project_select").change( function( event ){
        if ($("#project_select").val() < 0) {
            $( "#task_select > option" ).remove();
            $( "#task_select" ).append("<option value='-1'> --- </option>");
            return;
        }
        $.get("{$SITE_URL}TaskPickup/getTasks/"+ $( "#project_select > option:selected" ).prop("id") +"/")
            .done( function(data){
                $( "#task_select > option" ).remove();
                $( "#task_select" ).append("<option> --- </option>");
                var taskList = $.parseJSON(data);
                $.each(taskList, function(id, name) {
                    $( "#task_select" ).append("<option value='"+ id +"'>" + name + "</option>");
                });
                $( "#task_select" ).show();
            });
    });
    
</script>
    
{/block}