{extends 'Views/base_layout.tpl'}

{block name='content'}

    
    <h3 align='center'>Pracownicy</h3>
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
                <a href='{$SITE_URL}UserMonth/index/{$_user->id}/' data-toggle="tooltip" data-placement="top" title="{$_user->username}">{$_user->lastName} {$_user->firstName}</a>
            </td>
            <td class="cell-hours-daily" id="{$_user->id}">{$_user->hoursDaily}</td>
            <td>
                <a href="#" id="{$_user->id}" class="link-user-login">Zaloguj</a>
            </td>
            <td>
                <a id='{$_user->id}' class='link_delete_user' href='#'>Usuń</a>
            </td>
            <td>
                <a id='{$_user->id}' title ="dodaj do archiwum {$_user->username}" class='add_to_archives' href='#'> <span class="glyphicon glyphicon-book"></span></a>
            </td>
            
        </tr>
{/foreach}
    </tbody>
</table>


    <h4 align='center'>Archiwum <button align="right" type="button" class="btn btn-default btn-sm toggle-archives">
          <span class="glyphicon glyphicon-resize-vertical"></span>
    </button> </h4>

    <div class="archive">
    <table class="gridtable centre">
        <thead>
            <tr>
                <th>Imie i nazwisko</th>
                <th>Godzin dziennie (h) *</th>
            </tr>
        </thead>
    <tbody>
{foreach $userArchives as $_user}
        <tr>
            <td class="cell-name" id="{$_user->id}">
                <a href='{$SITE_URL}UserMonth/index/{$_user->id}/' data-toggle="tooltip" data-placement="top" title="{$_user->username}">{$_user->lastName} {$_user->firstName}</a>
            </td>
            <td class="cell-hours-daily" id="{$_user->id}">{$_user->hoursDaily}</td>
            <td>
                <a href="#" id="{$_user->id}" class="link-user-login">Zaloguj</a>
            </td>
            <td>
                <a id='{$_user->id}' class='link_delete_user' href='#'>Usuń</a>
            </td>
            <td>
                <a id='{$_user->id}' title ="dodaj do aktualnych pracowników {$_user->username}" class='add_to_active' href='#'><span class="glyphicon glyphicon-user"></span></a>
            </td>
            
        </tr>
{/foreach}
    </tbody>
</table>
</div>
    
{/block}
{block name='body_end'}

<script>

$('.add_to_active').click( function(event){
    event.preventDefault();

   evtarget = $(event.target.parentElement.parentElement.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.childNodes).text();

    evtarget = evtarget.trim();
    var userId = event.target.parentElement.id;
    if (!confirm('Czy na pewno przenieść ' + evtarget +' do aktywnych pracowników ?')) {
            return;
        } else {
            $.post('{$SITE_URL}Users/addToArchive/' + userId + '/',{ 'status' : 0 })
            .fail(function(v1, v2, text) {
            alert(text);
                })
            .done(function(text){
            document.location.reload();
                });
            };

});

$('.add_to_archives').click( function(event){
    event.preventDefault();
    evtarget = $(event.target.parentElement.parentElement.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.childNodes).text();

    evtarget = evtarget.trim();
    console.log(evtarget);
    var userId = event.target.parentElement.id;
    if (!confirm('Czy na pewno przenieść ' + evtarget +' do archiwum pracowników ?')) {
            return;
        } else {
            $.post('{$SITE_URL}Users/addToArchive/' + userId + '/',{ 'status' : 1 })
            .fail(function(v1, v2, text) {
            alert(text);
                })
            .done(function(text){
            document.location.reload();
                });
            };
});


$('.toggle-archives').click( function() {
    $('.archive').toggle();
});
    
    

$('.cell-name').dblclick( function(event) {
    event.preventDefault();
    
    evtarget = $(event.target.lastElementChild).html();
    tableName = evtarget.split(" ", 2);
    console.log(tableName);
    
    newLastName = prompt("Podaj nowe nazwisko:", tableName[0]);
    newName = prompt("Podaj nowe imię:", tableName[1]);
    login = ($(event.target.lastElementChild.getAttribute("title")).selector);
    newLogin = prompt("Podaj nowy login:", login ); 
   
        if( newName == "" || newName == null){
                alert ("Błąd, nie wpisano imienia");
                return;
            } else if ( newLastName == "" || newLastName == null){
                alert ("Błąd, nie wpisano nazwiska");
                return;
            } else if( newLogin == "" || newLogin == null){
                alert ("Błąd, nie wpisano loginu");
                return;
            }else{
    var userId = event.target.id;
    console.log(newName);
    $.post('{$SITE_URL}Users/updateName/' + userId + '/',{ "new_name" : newName, "new_lastname" : newLastName, "new_login":newLogin })
        .fail(function(v1, v2, text) {
            alert(text);
        })
        .done(function(text){
            document.location.reload();
        });
    };
});

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
        
        if (!confirm('Na pewno usunąć użytkownika?  Kliknięcie Ok spowoduje nieodwracalne zmiany')) {
            return;
        };
        
        $.get('{$SITE_URL}Users/delete/' + event.target.id + '/')
            .fail(function(v1, v2, text) {
                alert($.parseJSON(text));
            })
            .done(function(text){
                document.location.reload();
            });
    });

</script>
    
{/block}