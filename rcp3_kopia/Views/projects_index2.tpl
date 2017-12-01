{extends 'Views/base_layout.tpl'}

{block name='head'}
    <link rel="stylesheet" type="text/css" href="{$SITE_URL}Includes/ml-loading-bars.css">
    <link rel='stylesheet' type='text/css' href='{$SITE_URL}Includes/notification-boxes.css'>
    <link rel='stylesheet' type='text/css' href='{$SITE_URL}Includes/hint.css'>
    <style>
        table tbody.c1:nth-child(even) td
        {
            background-color: #efefef;
        }
        .quality_control{
            width: 300px;
            height: 100px;
            position: absolute;
            left:400px;
            border: 2px solid grey;
            z-index: 1;
            background-color: white;
            display:none;
        }
    </style>
{/block}

{block name='content'}

    <div class="quality_control">
        <form>
            <label>Wybierz kontrolera jakości:</label>
            <select id="QC">{foreach $userList as $_user}
                <option value="{$_user->id}" id="">{$_user->lastName} {$_user->firstName}</option>
                {/foreach} 
            </select>
            <button type="button" class="btn btn-warning btn-sm" id="confirm_QC">Zatwierdź</button>
        </form>
    </div>
   
    <h2 align="center">Projekty</h2>
    
<table class="gridtable centre">
    <thead>
        <tr><td style='border: none' colspan="3">&nbsp;</td><th colspan="2">Budżet (dni)</th></tr>
        <tr>
            <th>Nazwa</th>
            <th>Numer zlecenia</th>
            <th>Klient</th>
            <th>Wykorzystany</th>
            <th>Zakładany</th>
            <th>Postęp prac</th>
            <th>Czas</th>
            <th>Data wysyłki</th>
        </tr>
    </thead>
{$doZamkniecia = array()}
{$doZaakceptowania = array()}
{$doKierownika = array()}
{foreach $groups as $group}
    <tbody class='holiday1'>
        <tr>
            <td colspan="5" style='border: none; height: 30px; vertical-align: bottom'>{$group.name}</td>
        </tr>
    </tbody>
{foreach $group.projects as $project}
    {if $project.project->sent}
        {$doZamkniecia[] = $project.project}
    {/if}
    {if $project.project->status == 1}
        {$doZaakceptowania[] = $project.project}
    {/if}
    {if $project.project->status == 0 and $project.project->projectManagerId == $user->id}
        {$doKierownika[] = $project.project}
    {/if}
    <tbody class="c1">
        <tr>
            <td style="font-weight: bold">
                <a href='{$SITE_URL}Projects/report/{$project.id}/'>{$project.name}</a><br>
            </td>
            <td>{$project.project->orderNumber}</td>
            <td>{$project.project->client}</td>
            <td>{$project.total|string_format:"%.1f"}</td>
            <td>{$project.project->budget}</td>
            <td>
                <a class='link_update_progress' id='{$project.id}' href='#'>{$project.project->progress}%</a>
            </td>
            {$timeProgress = $project.project->timeProgress()}
            <td>{if null != $timeProgress}{$timeProgress|string_format:"%.1f"}%{/if}</td>
            <td>{if $project.project->sent}{$project.project->sent|date_format:'%Y-%m-%d'}{/if}</td>
            <td rowspan="2">
{if $user->accessLevel > 3}
                <a href='{$SITE_URL}Projects/docs/{$project.id}/'>Dokumentacja</a><br>
{/if}                
                <a href='{$SITE_URL}Projects/editForm/{$project.id}/'>Edytuj</a><br>
                <a id='{$project.id}' class='project_send_link' href='#'>Wysyłka</a><br>
{if $user->accessLevel > 1}
                <a id='{$project.id}' class='project_close_link' href='#'>Zamknij</a>
{/if}
            </td>
        </tr>
        <tr>
            <td colspan="8">
                {if $project.project->sent}
                <div class='notice info'>
                    <p>Projekt został wysłany - do zamknięcia.</p>
                </div>
                {/if}
                {if $project.project->status == 0}
                <div class='notice warning'>
                    <p>Projekt czeka na stworzenie harmonogramu.</p>
                    <p><a href="{$SITE_URL}Projects/editForm/{$project.id}/">-- Kliknij tutaj --</a></p>
                </div>
                {/if}
                {if $project.project->status == 1}
                {if $user->accessLevel > 1}
                <div class='notice warning'>
                    <p><b>Harmonogram czeka na akceptację.</b></p>
                    <p><a href="{$SITE_URL}Projects/editForm/{$project.id}/">-- Kliknij tutaj --</a></p>
                </div>
                {else}
                <div class='notice success'>
                    <p>Harmonogram czeka na akceptację.</p>
                </div>
                {/if}
                {/if}
                {if $project.project->budget > 0}
                    <div class="loading-container-13">
                    <div class="loading-progress-13 hint--bottom hint--info" 
                         data-hint="Wykorzystany budżet: {$project.total}d / {$project.project->budget}d" 
                         style="width:{min(100,(100 * $project.total / $project.project->budget))|string_format:"%d"}%;"></div>
                </div>
                {/if}
                <div class="loading-container-14">
                    <div class="loading-progress-14 hint--bottom hint--success" 
                         data-hint="Postęp prac: {$project.project->progress}%"  
                         style="width:{$project.project->progress}%;"></div>
                </div>
                {if $timeProgress != null}
                    {if $timeProgress <= 100}
                <div class="loading-container-15 hint--bottom hint--warning" 
                         data-hint="Data rozpoczęcia: {$project.project->begin}, data zakończenia: {$project.project->end}">
                    <div class="loading-progress-15" style="width:{$timeProgress|string_format:"%d"}%;"></div>
                </div>
                <div>
                    <div style="float: left;">{$project.project->begin}</div>
                    <div style="float: right;">{$project.project->end}</div>
                </div>
                    {else}
                <div class="loading-container-15 hint--bottom hint--warning" 
                        data-hint="Data rozpoczęcia: {$project.project->begin}, data zakończenia: {$project.project->end}"
                        style="background-color: red;">
                    <div class="loading-progress-15" style="width:{(10000 / $timeProgress)|string_format:"%d"}%;"></div>
                </div>
                <div>
                    <div style="position: relative;">{$project.project->begin}</div>
                    <div style="position: relative; top: -13px; left: {(10000 / $timeProgress)|string_format:"%d"}%">{$project.project->end}</div>
                </div>
                    {/if}
                {/if}
            </td>
        </tr>
    </tbody>

{/foreach}
{/foreach}
</table>{*
<div style="position: fixed; top: 20px; left: 170px; width: 100px; white-space: nowrap; overflow: hidden">
{if count($doZamkniecia) > 0}
    <h4>Projekty do zamknięcia:</h4>
    {foreach $doZamkniecia as $project}
        {$project->name}<br>
    {/foreach}
{/if}
{if count($doZamkniecia) > 0}
    Projekty do zamknięcia:<br>
    {foreach $doZamkniecia as $project}
        {$project->name}<br>
    {/foreach}
{/if}
</div>*}
{if count($inactive) > 0} 
<br><br>
<h2 align="center"><a id='inactive-toggle' href='#'>+ Projekty nieaktywne</a></h2>
<table id='inactive-projects' class='gridtable centre' hidden='hidden'>
    <tr>
        <th>Projekt</th>
    </tr>
{foreach $inactive as $project}
    <tr>
        <td>
            <a href='{$SITE_URL}Projects/report/{$project.id}/'>{$project.project->name}</a>
        </td>
    </tr>
{/foreach}
</table>
{/if}
<div class="centered-box" hidden="hidden">
    <h2 align="center"></h2>
    
</div>
{/block}
{block name='body_end'}
<script>
    
    $("#inactive-toggle").click( function(event) {
        event.preventDefault();
        $("#inactive-projects").show();
    });
    
    $(".link_update_progress").click( function(event) {
        event.preventDefault();
        
        var oldProgress = $(event.target).html().replace('%', '');
        var newProgress = prompt("Podaj nową wartość (%)", oldProgress);
        if (isNaN(newProgress) || (null === newProgress) || oldProgress === newProgress || newProgress < 0 || newProgress > 100) {
            return;
        }
        
        $.post('{$SITE_URL}ProjectAction/updateProgress/' + event.target.id + '/', {literal}{ "new_progress" : newProgress }{/literal})
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
        
    });

 
    
   // $("#confirm_QC").click(function(event){ 
   //          $(".quality_control").hide();
   //          var qcId = $("#QC option:selected").val();


   //  $.post('{$SITE_URL}ProjectAction/setQualityControl/' + event.target.id + '/', {literal}{ "quality_control_id" : qcId }{/literal})
   //          .fail(function(v1, v2, text) {
   //              alert(text);
   //          })
   //          .done(function(text){
   //              document.location.reload();
   //          });
   //      });
  
  
    $(".project_send_link").click( function(event) {
        event.preventDefault();
        var today = new Date;
        var todayString = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDay();
        var projectSentDate = prompt("Podaj datę wysyłki (RRRR-MM-DD)", todayString);
        var eventTargetId = event.target.id;

        $(".quality_control").show();
        $.post('{$SITE_URL}ProjectAction/send/' + event.target.id + '/', {literal}{ "project_sent_date" : projectSentDate }{/literal})
            .fail(function(v1, v2, text) {
                alert(text); 
                     
            })
            .done(function(text){
                // document.location.reload();
               
            });
        $("#confirm_QC").click(function(){ 
            
            $(".quality_control").hide();
            var qcId = $("#QC option:selected").val();
          


    $.post('{$SITE_URL}ProjectAction/setQualityControl/' + eventTargetId + '/', {literal}{ "quality_control_id" : qcId }{/literal})
            .fail(function(v1, v2, text) {
                alert(text);
                
            })
            .done(function(text){
                document.location.reload();
                
            });
        });
    });

    
    $(".project_close_link").click( function(event) {
        event.preventDefault();
        
        if (!confirm('Na pewno zamknąć projekt?')) {
            return;
        };
        
        $.get('{$SITE_URL}ProjectAction/close/' + event.target.id + '/')
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
   });
    
    $(".project_delete_link").click( function(event) {
        event.preventDefault();
        
        if (!confirm('Na pewno usunąć projekt?')) {
            return;
        };
        
        $.get('{$SITE_URL}ProjectAction/delete/' + event.target.id + '/')
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