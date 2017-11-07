{extends 'Views/base_layout.tpl'}

{block name='head'}
    <link rel='stylesheet' type='text/css' href='{$SITE_URL}Includes/notification-boxes.css'>
    <link rel='stylesheet' type='text/css' href='{$SITE_URL}Includes/hint.css'>
{/block}

{block name='content'}
    
    
        
    <h2 align='center'>Szablony projektów</h2>
    <h3 align='center'><a id='link_new_template' href='#'>> Nowy szablon <</a></h3>
    {foreach $templates as $template}
        <table class='gridtable centre'>
        
        <tr>
            <th>
                <a class='link_delete_template' id='{$template->id}' href='#'>x</a>
                <span class='template_name' id='{$template->id}'>{$template->name}</span>
            </th>
        </tr>
        {foreach $template->getTasks() as $task}
            <tr>
                <td>
                    <a class='link_delete_task' id='{$task->id}' href='#'>x</a>
                    <span class='task_name' id='{$task->id}'>{$task->name}</span>
                </td>
            </tr>
            {/foreach}
                    <tr><td>
                <a class='link_new_task' id='{$template->id}' href='#'>> Dodaj zadanie <</a>
                </td></tr>
        </table><br>
        {/foreach}
        <h5 align='center'>* podwójne kliknięcie nazwy szablonu lub zadania aby zmienić nazwę</h5>
{/block}

{block name='body_end'}
<script>
$('#link_new_template').click( function(event) {
    event.preventDefault();
    var templateName = prompt("Podaj nazwę szablonu");
    if(null === templateName || templateName.length < 2)
    {
        return;
    }
    $.post('{$SITE_URL}ProjectTemplates/addTemplate/', {literal}{ "template_name" : templateName }{/literal})
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
});


$('.link_delete_template').click( function(event) {
    event.preventDefault();
    if (!confirm('Na pewno usunąć szablon?')) {
        return;
    };
    $.post('{$SITE_URL}ProjectTemplates/deleteTemplate/' + event.target.id + '/')
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
});

$('.template_name').dblclick( function(event) {
    event.preventDefault();
    var templateName = $(event.target).html();
    templateName = prompt("Podaj nową nazwę", templateName);
    if(null === templateName || templateName.length < 2)
    {
        return;
    }
    $.post('{$SITE_URL}ProjectTemplates/renameTemplate/' + event.target.id + '/', {literal}{ "template_new_name" : templateName }{/literal})
        .fail(function(v1, v2, text) {
            alert(text);
        })
        .done(function(text){
            document.location.reload();
        });
});

$('.link_new_task').click( function(event) {
    event.preventDefault();
    var taskName = prompt("Podaj nazwę zadania");
    if(null === taskName || taskName.length < 2)
    {
        return;
    }
    $.post('{$SITE_URL}ProjectTemplates/addTask/' + event.target.id + '/', {literal}{ "task_name" : taskName }{/literal})
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
});

$('.link_delete_task').click( function(event) {
    event.preventDefault();
    if (!confirm('Na pewno usunąć zadanie z szablonu?')) {
        return;
    };
    $.post('{$SITE_URL}ProjectTemplates/deleteTask/' + event.target.id + '/')
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
});

$('.task_name').dblclick( function(event) {
    event.preventDefault();
    var taskName = $(event.target).html();
    taskName = prompt("Podaj nową nazwę", taskName);
    if(null === taskName || taskName.length < 2)
    {
        return;
    }
    $.post('{$SITE_URL}ProjectTemplates/renameTask/' + event.target.id + '/', {literal}{ "task_new_name" : taskName }{/literal})
        .fail(function(v1, v2, text) {
            alert(text);
        })
        .done(function(text){
            document.location.reload();
        });
});
</script>

{/block}