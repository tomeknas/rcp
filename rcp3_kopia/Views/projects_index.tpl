{extends 'Views/base_layout.tpl'}

{block name='content'}
    
    <h2 align="center">Projekty</h2>
    
<table class="gridtable centre">
    <thead>
        <tr><td style='border: none'>&nbsp;</td><th colspan="2">Budżet (dni)</th></tr>
        <tr>
            <th>Nazwa</th>
            <th>Wykorzystany</th>
            <th>Zakładany</th>
            <th>Postęp prac</th>
            <th>Czas</th>
        </tr>
    </thead>
    <tbody>
{foreach $projects as $project}
        <tr>
            <td>
                <a href='{$SITE_URL}Projects/report/{$project->id}/'>{$project->name}</a>
            </td>
            <td>{$totals[$project->id]|string_format:"%.1f"}</td>
            <td>{$project->budget}</td>
            <td>
                <a class='link_update_progress' id='{$project->id}' href='#'>{$project->progress}%</a>
            </td>
            {$timeProgress = $project->timeProgress()}
            <td>{if null != $timeProgress}{$timeProgress|string_format:"%.1f"}%{/if}</td>
            <td>
                <a href='{$SITE_URL}Projects/editForm/{$project->id}/'>Edytuj</a>
{if $user->accessLevel > 1}
                <a id='{$project->id}' class='project_delete_link' href='#'>Usuń</a>
{/if}
            </td>
        </tr>
{/foreach}
    </tbody>
</table>
    
{/block}
{block name='body_end'}
<script>
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