{extends 'Views/base_layout.tpl'}

{block name='content'}

    
    <h2 align='center'>Użytkownicy</h2>
<table class="gridtable centre">
    <thead>
        <tr>
            <th>Imie i nazwisko</th>
            <th>Godzin dziennie (h) *</th>
        </tr>
    </thead>
    <tbody>
{foreach $userList as $_user}
        <tr>
            <td class="cell-name" id="{$_user->id}">
                <a href='{$SITE_URL}UserMonth/index/{$_user->id}/'>{$_user->lastName} {$_user->firstName}</a>
            </td>
            <td class="cell-hours-daily" id="{$_user->id}">{$_user->hoursDaily}</td>
            <td>
                <a href="#" id="{$_user->id}" class="link-user-login">Zaloguj</a>
            </td>
            <td>
                <a id='{$_user->id}' class='link_delete_user' href='#'>Usuń</a>
            </td>
            
        </tr>
{/foreach}
    </tbody>
</table>
    
{/block}
{block name='body_end'}
<script>
    $(".link-user-login").click( function(event) {
       event.preventDefault();
        $.get('{$SITE_URL}Login/loginByUserId/' + event.target.id + '/')
            .fail(function(v1, v2, text) {
                alert($.parseJSON(text));
            })
            .done(function(text){
                alert(text);
                document.location.replace("{$SITE_URL}");
            });
    });

$('.cell-name').dblclick( function(event) {
    event.preventDefault();
    // target = '.' + $(event.target).attr('class') + " " + "a"; 
    
    evtarget = $(event.target.lastElementChild).html();
    console.log(evtarget);
    newValue = prompt("Podaj nowe nazwisko i imię:", evtarget);
    if(null === newValue || isNaN(newValue))
    {
        return;
    }
    var userId = event.target.id;
    $.post('{$SITE_URL}Users/updateName/' + userId + '/',
                                            {literal}{ "new_value" : newValue }{/literal})
        .fail(function(v1, v2, text) {
            alert(text);
        })
        .done(function(text){
            document.location.reload();
        });
});
    
$('.cell-hours-daily').dblclick( function(event) {
    event.preventDefault();
    newValue = prompt("Podaj nową wartość:", $(event.target).html());
    if(null === newValue || isNaN(newValue))
    {
        return;
    }
    var userId = event.target.id;
    $.post('{$SITE_URL}Users/updateHoursDaily/' + userId + '/',
                                            {literal}{ "new_value" : newValue }{/literal})
        .fail(function(v1, v2, text) {
            alert(text);
        })
        .done(function(text){
            document.location.reload();
        });
});
    
    $(".link_delete_user").click( function(event) {
        event.preventDefault();
        
        if (!confirm('Na pewno usunąć użytkownika?')) {
            return;
        };
        
        $.get('{$SITE_URL}Users/delete/' + event.target.id + '/')
            .fail(function(v1, v2, text) {
                alert($.parseJSON(text));
            })
            .done(function(text){
                alert(text);
                document.location.reload();
            });
    });

</script>
    
{/block}