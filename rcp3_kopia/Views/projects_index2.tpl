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
        </br>
            <button type="button" class="btn btn-warning btn-sm" id="confirm_QC">Zatwierdź</button>
        </form>
    </div>
   
    <h2 align="center" id="title_project">Projekty</h2>
    
<table class="gridtable centre" id='myTable'>
    <thead>
        <tr>
            <td style='border: none' colspan="3">&nbsp;</td>
            <th colspan="2">Budżet (dni)</th>
        </tr>
        <tr class="sort-header">
            <th id="js-name-header" data-project="data-project-name">Nazwa</th>
            <th data-project="data-project-number">Numer zlecenia</a></th>
            <th data-project="data-project-client">Klient</a></th>
            <th data-project="data-project-budgettotal">Wykorzystany</a></th>
            <th data-project="data-project-budget">Zakładany</a></th>
            <th data-project="data-project-progress">Postęp prac</a></th>
            <th data-project="data-project-time">Czas</a></th>
            <th data-project="data-project-date">Data wysyłki</a></th>
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
        <tr >
            <td data-project-name='{$project.name}' style="font-weight: bold">
                <a href='{$SITE_URL}Projects/report/{$project.id}/'>{$project.name}</a><br>
            </td>
            <td data-project-number='{$project.project->orderNumber}'>{$project.project->orderNumber}</td>
            <td data-project-client='{$project.project->client}'>{$project.project->client}</td>
            <td data-project-budgettotal='{$project.total|string_format:"%.1f"}'>{$project.total|string_format:"%.1f"}</td>
            <td data-project-budget='{$project.project->budget}'>{$project.project->budget}</td>
            <td data-project-progress='{$project.project->progress}' >
                <a class='link_update_progress' id='{$project.id}' href='#'>{$project.project->progress}%</a>
            </td>
            {$timeProgress = $project.project->timeProgress()}
            <td data-project-time='{$timeProgress|string_format:"%.1f"}' >{if null != $timeProgress}{$timeProgress|string_format:"%.1f"}%{/if}</td>
            <td data-project-date='{if $project.project->sent}{$project.project->sent|date_format:'%Y-%m-%d'}{/if}' >{if $project.project->sent}{$project.project->sent|date_format:'%Y-%m-%d'}{/if}</td>
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

    patternOne = new RegExp("toSend");
    patternTwo = new RegExp("forManager");
    patternThree = new RegExp("forCoordinator");
    patternFour = new RegExp("toAccept");
    loc = window.location.pathname;

    if (patternOne.test(loc)){
        $("#title_project").text("Projeky wysłane do klienta- do zamknięcia:");
    }else if (patternTwo.test(loc)){
        $("#title_project").text("Nowe projekty- opracować harmonogram:");
    }else if (patternThree.test(loc)){
        $("#title_project").text("Nowe projekty- opracować harmonogram:");
    }else if (patternFour.test(loc)){
        $("#title_project").text("Harmonogram projektu do akceptacji:");
    }else{
        $("#title_project").text("Projekty");
    }



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
        var eventTargetId = event.target.id;
        
        $(".quality_control").show(1000);


        $("#confirm_QC").click(function(){  
            $(".quality_control").hide();
            var qcId = $("#QC option:selected").val();
          


    $.post('{$SITE_URL}ProjectAction/setQualityControl/' + eventTargetId + '/', {literal}{ "quality_control_id" : qcId }{/literal})
            .fail(function(v1, v2, text) {
                alert(text);
                
            })
            .done(function(text){
                var projectSentDate = prompt("Podaj datę wysyłki (RRRR-MM-DD)", todayString);
                $.post('{$SITE_URL}ProjectAction/send/' + eventTargetId + '/', {literal}{ "project_sent_date" : projectSentDate }{/literal})
                    .fail(function(v1, v2, text) {
                        alert(text); 
                            })
                    .done(function(text){
                document.location.reload();
                                });

                
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



var order = "DSC";
        $(".sort-header th").on('click', function(event){
            var column = event.target.getAttribute("data-project");
            var dataValue = column.substring(5);
            dataValue = dataValue.replace("-","");
            var upper = dataValue.charAt(7).toUpperCase();
            dataValue = dataValue.substring(0,7) + upper + dataValue.substring(8);
          

            var projectNames = [];

            function checkDot(prev, next){
                reg = /\.0/;
                if(reg.test(prev) || reg.test(next)){
                    return true;
                }else{
                    return false;
                }};

            function checkSlash(prev, next){
                        var reg = '\/';
                        reg = new RegExp("/");
                        if (reg.test(prev) && reg.test(next)){
                            return true;
                        }else{
                            return false;
                        }};

            $("td["+ column +"]").each(function(_, projectNameTableData){
                projectNames.push($(projectNameTableData).data(dataValue));
            });

            
      
            if (order === "ASC"){
                projectNames.sort(function (prev, next) {

                    if (typeof prev ==="string" && typeof next ==="string" && checkSlash(prev, next) === false && checkDot(prev, next) === false){  
                    return prev.toLowerCase().localeCompare(next.toLowerCase());
                    }else if (typeof prev ==="number" && typeof next ==="number" ){
                    return prev - next;
                    }else if( typeof prev ==="string"  && typeof next ==="string" && checkSlash(prev, next) === true){
                        prev = prev.replace("/","");
                        next = next.replace("/","");
                        return prev.toLowerCase().localeCompare(next.toLowerCase());
                     } 
                     else if (typeof prev === "number" && typeof next === "string" && checkDot(prev, next) === true){
                        next = Number(next);
                        return prev - next;
                     } else if (typeof prev === "string" && typeof next === "number" && checkDot(prev, next) === true){
                        prev = Number(prev);
                        return prev - next;
                     } else if (typeof prev === "string" && typeof next === "string" && checkDot(prev, next) === true){
                        prev = Number(prev);
                        next = Number(next);
                        return prev - next;
                       
                     }
                   
                })

                    order = "DSC";
                    $(".sort-header th").removeClass("name-header-dsc")
                    $(this).addClass("name-header-asc");
            } else if( order === "DSC"){
                projectNames.sort(function (prev, next) {
                   
                    if (typeof prev ==="string" && typeof next ==="string" && checkSlash(prev, next) === false && checkDot(prev, next) === false){
                       
                    return next.toLowerCase().localeCompare(prev.toLowerCase());
                    }else if (typeof prev ==="number" && typeof next ==="number" ){  
                    return next - prev;
                    }else if( typeof prev ==="string"  && typeof next ==="string" && checkSlash(prev, next) === true){ 
                        prev = prev.replace("/","");
                        next = next.replace("/","");
                        return next.toLowerCase().localeCompare(prev.toLowerCase());
                     } else if (typeof prev === "number" && typeof next === "string" && checkDot(prev, next) === true){
                        next = Number(next);
                        return next - prev;
                     } else if (typeof prev === "string" && typeof next === "number" && checkDot(prev, next) === true){
                        prev = Number(prev); 
                        return next - prev;
                     } else if (typeof prev === "string" && typeof next === "string" && checkDot(prev, next) === true){
                        prev = Number(prev);
                        next = Number(next);
                        return next - prev; 
                     }
                    
                })
                    order = "ASC";
                    $(".sort-header th").removeClass("name-header-asc");
                    $(this).addClass("name-header-dsc");
            }

         var uniqueNames = [];
         
         $.each(projectNames, function(i, el){
            if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
            });
            var uniqueProjects = [];
            for (var i = 0; i < uniqueNames.length; i++) {
                var currentProjects = $('td[' + column + '="' + uniqueNames[i] + '"]').closest("tbody").toArray();
                for (var j = 0; j < currentProjects.length; j ++) {
                    uniqueProjects.push(currentProjects[j]);
                }
            }
            
            for (var i = 1; i < uniqueProjects.length; i++) {
                $(uniqueProjects[i]).insertAfter($(uniqueProjects[i-1]));
            }
        })




</script>
    
{/block}
