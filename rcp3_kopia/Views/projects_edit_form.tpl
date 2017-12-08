{extends 'Views/base_layout.tpl'}
{block name='content'}
    <h2 align='center'>Edycja projektu</h2>
    <br><br>
    
    <form id='project_edit_form' align='center'>
        <table class='gridtable centre'>
            <tr>
                <th>Nazwa projektu</th>
                <td><input name='name' value='{$project->name}' required></td>
            </tr>
            <tr>
                <th>Opis</th>
                <td><input name='description' value='{$project->description}'></td>
            </tr>
            <tr>
                <th>Grupa</th>
                <td>
                    <select name='group'>
{foreach $groupList as $group}
                        <option value='{$group->id}'{if $group->id == $project->groupId} selected='selected'{/if}>
                            {$group->name}
                        </option>
{/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <th>Numer zlecenia</th>
                <td><input name='order_number' value='{$project->orderNumber}'></td>
            </tr>
            <tr>
                <th>Klient</th>
                <td><input name='client' value='{$project->client}'></td>
            </tr>
            <tr>
                <th>Data rozpoczęcia</th>
                <td><input name='begin' type='date' value='{$project->begin}'></td>
            </tr>
            <tr>
                <th>Data zakończenia</th>
                <td><input name='end' type='date' value='{$project->end}'></td>
            </tr>
            <tr>
                <th>Kierownik projektu</th>
                <td>
                    <select name='project_manager'>
{foreach $userList as $userObject}
                    <option value='{$userObject->id}'{if $userObject->id == $project->projectManagerId} selected='selected'{/if}>{$userObject->getFullName()}</option>
{/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <th>Koordynator projektu</th>
                <td>
                    <select name='project_coordinator'>
{foreach $userList as $userObject}
                    <option value='{$userObject->id}'{if $userObject->id == $project->projectCoordinator} selected='selected'{/if}>{$userObject->getFullName()}</option>
{/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <th>Budżet (dni robocze)</th>
                <td><input name='budget' type='number' value='{$project->budget}' min='0'></td>
            </tr>
            <tr>
                <th>Budżet (zł)</th>
                <td><input name='budgetPLN' type='number' value='{$project->budgetPLN}' min='0'></td>
            </tr>
            <tr>
                <th>Budżet (PM)</th>
                <td><input name='budgetPM' type='number' value='{$project->budgetPM}' min='0'></td>
            </tr>
            <tr>
                <td style='border: none'>&nbsp;</td>
                <td><input type='submit' value='Zapisz zmiany'></td>
            </tr>
        </table>
    </form>
               
    
        <table class='gridtable centre' style='margin-top: 50px'>
            <tr>
                <th>Zadania</th>
                <th>Data rozpoczęcia</th>
                <th>Data zakończenia</th>
            </tr>
            {foreach $project->getTasks() as $task}
            <tr>
                <td>{$task->name}</td>
                <td>
                    {if $task->begin}
                        <a href="#" class="link-delete-begin" id="{$task->id}">
                        {$task->begin|date_format:"%Y-%m-%d"}
                        </a>
                    {else}
                        <a href="#" class="link-set-begin" id="{$task->id}">Dodaj datę</a>
                    {/if}   
                </td>
                <td>
                    {if $task->end}
                        <a href="#" class="link-delete-end" id="{$task->id}">
                        {$task->end|date_format:"%Y-%m-%d"}
                        </a>
                    {else}
                        <a href="#" class="link-set-end" id="{$task->id}">Dodaj datę</a>
                    {/if}   
                </td>
                <td><a class='link_delete_task' id='{$task->id}' href='#'>Usuń zadanie</a></td>
            </tr>
            {/foreach}
            <tr>
                <td>
                    <form id='form_add_task'>
                        <input type='text' name='task_name'>
                        <input type='submit' value='Dodaj'>
                    </form>
                </td>
                
                {if $project->status == 0}
                <td colspan="3">
                    <button id="link-send-schedule">
                        Wyślij harmonogram do zaakceptowania
                    </button>
                </td>
                {/if}
                {if $project->status == 1 && $user->accessLevel > 1}
                <td colspan="3">
                    <button id="link-accept-schedule">
                        Akceptuj harmonogram
                    </button>
                    <button id="link-decline-schedule">
                        Wyślij do poprawy
                    </button>
                </td>
                {/if}
            </tr>
        </table>


            
{if $user->accessLevel > 1}
    <br><br><br><br><br>
            <h3 align='center'>
                <a href='#' id='project-delete-link' style='color: red'>
                    Usuń projekt
                </a>
            </h3>
{/if}
{/block}

{block name='body_end'}
<script>
    
    function setProjectStatus(newStatus) {
        $.post( "{$SITE_URL}ProjectAction/setProjectStatus/{$project->id}/", {literal} { "new_status" : newStatus } {/literal} )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    }
    
    $("#link-send-schedule").click(function() {
        setProjectStatus(1);
    });
    $("#link-accept-schedule").click(function() {
        setProjectStatus(2);
    });
    $("#link-decline-schedule").click(function() {
        setProjectStatus(0);
    });
    
    function dateToday() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd='0'+dd
        } 

        if(mm<10) {
            mm='0'+mm
        } 

        today = yyyy+'-'+mm+'-'+dd;
        return today;
    }
    
    function beforeSetTaskDate() {
        if ({$user->accessLevel} > 1) {
            return true;
        }
        if ({$project->status} > 0) {
            if({$project->status} > 1) {
                alert("Harmonogram został już zaakceptowany.");
                return false;
            }
            alert("Harmonogram został już wysłany do zaakceptowania.");
            return false;
        }
        return true;
    }
    
    $(".link-set-begin").click(function(event) {
        event.preventDefault();
        if (!beforeSetTaskDate()) {
            return;
        }
        var newBegin = prompt("Data rozpoczęcia zadania:", dateToday());
        var newBeginTs = Date.parse(newBegin) / 1000;
        
        if (isNaN(newBeginTs) || newBeginTs < 1000) {
            return;
        }
        
        $.post( "{$SITE_URL}ProjectAction/setTaskBegin/"+event.target.id+"/", {literal} { "new_begin" : newBeginTs } {/literal} )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $(".link-set-end").click(function(event) {
        event.preventDefault();
        if (!beforeSetTaskDate()) {
            return;
        }
        var newEnd = prompt("Data zakończenia zadania:", dateToday());
        var newEndTs = Date.parse(newEnd) / 1000;
        
        if (isNaN(newEndTs) || newEndTs < 1000) {
            return;
        }
        
        $.post( "{$SITE_URL}ProjectAction/setTaskEnd/"+event.target.id+"/", {literal} { "new_end" : newEndTs } {/literal} )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $(".link-delete-begin").click(function(event) {
        event.preventDefault();
        if (!beforeSetTaskDate()) {
            return;
        }
        
        $.post( "{$SITE_URL}ProjectAction/setTaskBegin/"+event.target.id+"/", {literal} { "new_begin" : 0 } {/literal} )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $(".link-delete-end").click(function(event) {
        event.preventDefault();
        if (!beforeSetTaskDate()) {
            return;
        }
        
        $.post( "{$SITE_URL}ProjectAction/setTaskEnd/"+event.target.id+"/", {literal} { "new_end" : 0 } {/literal} )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $("#project-delete-link").click( function(event) {
        event.preventDefault();
        
        if (!confirm('Na pewno usunąć projekt?')) {
            return;
        };
        
        $.get('{$SITE_URL}ProjectAction/delete/{$project->id}/')
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(){
                alert('Projekt został usunięty!');
                document.location.replace('{$SITE_URL}Projects/');
            });
    });
    
    $( "#project_edit_form" ).submit( function( event ){
        event.preventDefault();
        
        $.post( "{$SITE_URL}ProjectAction/edit/{$project->id}/", $("#project_edit_form").serialize() )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                alert(text);
                document.location.reload();
            });
    });
    
    $( "#form_add_task" ).submit( function( event ){
        event.preventDefault();
        
        if (!beforeSetTaskDate()) {
            return;
        }
        
        $.post( "{$SITE_URL}ProjectAction/addTask/{$project->id}/", $("#form_add_task").serialize() )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                alert(text);
                document.location.reload();
            });
    });
    
    $( ".link_delete_task").click( function( event) {
        event.preventDefault();
        
        $.get( "{$SITE_URL}ProjectAction/deleteTask/" + event.target.id + "/" )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                alert(text);
                document.location.reload();
            });
        
    });
    
</script>
{/block}