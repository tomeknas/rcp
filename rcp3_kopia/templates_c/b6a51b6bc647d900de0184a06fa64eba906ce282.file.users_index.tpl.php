<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-12-10 22:44:12
         compiled from "Views\users_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:276475a020c5ae32bc1-17471694%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6a51b6bc647d900de0184a06fa64eba906ce282' => 
    array (
      0 => 'Views\\users_index.tpl',
      1 => 1511301780,
      2 => 'file',
    ),
    'cf5d031d7811abe143b2a675129cecdef724eadb' => 
    array (
      0 => 'Views\\base_layout.tpl',
      1 => 1512942248,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '276475a020c5ae32bc1-17471694',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a020c5b189bf2_63284581',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'user' => 0,
    'projectsToSend' => 0,
    'projectBadge' => 0,
    'projectManagerBadges' => 0,
    'projectsForManager' => 0,
    'projectCoordinator' => 0,
    'projectsForCoordinator' => 0,
    'projectBadge2' => 0,
    'projectsToAccept' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a020c5b189bf2_63284581')) {function content_5a020c5b189bf2_63284581($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        
        <title>KPGeo - Rejestracja Czasu Pracy</title>
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/bootstrap.min.css">
        <?php echo '<script'; ?>
 src='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/jquery.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/bootstrap.min.js"><?php echo '</script'; ?>
>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/base_style.css'>
        <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/loading_indicator.css'>

        
    </head>
    <body>
        <div id='menu_div'>
            
                <h3><?php echo $_smarty_tpl->tpl_vars['user']->value->firstName;?>
<br><?php echo $_smarty_tpl->tpl_vars['user']->value->lastName;?>
</h3>
                <a href='#' class='link_logout'>Wyloguj</a><br>
                <a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserSettings/">Ustawienia</a>
                <br><br>
                <hr>
                <ul>
                    <li>
                        <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserMonth/'>Kalendarz użytkownika</a>
                    </li>
                    <?php if ($_smarty_tpl->tpl_vars['user']->value->isProjectManager()||$_smarty_tpl->tpl_vars['user']->value->isCoordinator()||$_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                    <li>
                        <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/'>Projekty </a>
<?php if ($_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                        <span class='badge' title='Do zamknięcia: <?php echo $_smarty_tpl->tpl_vars['projectsToSend']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['projectBadge']->value;?>
</span>
<?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['projectManagerBadges']->value[$_smarty_tpl->tpl_vars['user']->value->id])) {?>
                        <span class='badge blue' title="<?php echo $_smarty_tpl->tpl_vars['projectsForManager']->value[$_smarty_tpl->tpl_vars['user']->value->id];?>
"><?php echo $_smarty_tpl->tpl_vars['projectManagerBadges']->value[$_smarty_tpl->tpl_vars['user']->value->id];?>
</span>
<?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['projectCoordinator']->value[$_smarty_tpl->tpl_vars['user']->value->id])&&$_smarty_tpl->tpl_vars['user']->value->accessLevel<2) {?>
                        <span class='badge orange' title="<?php echo $_smarty_tpl->tpl_vars['projectsForCoordinator']->value[$_smarty_tpl->tpl_vars['user']->value->id];?>
"><?php echo $_smarty_tpl->tpl_vars['projectCoordinator']->value[$_smarty_tpl->tpl_vars['user']->value->id];?>
</span>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['projectBadge2']->value&&$_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                        <span class='badge green' title="Do zaakceptowania: <?php echo $_smarty_tpl->tpl_vars['projectsToAccept']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['projectBadge2']->value;?>
</span>
<?php }?>
                    </li>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                        <ul>
                            <li>
                                <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/consReport/'>Raport zbiorczy</a>
                            </li>
                            <li>
                                <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/addForm/'>Dodaj projekt</a>
                            </li>
                            <li>
                            <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectTemplates/'>Szablony</a>
                            </li>
                        </ul>
                    <li>
                        <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/'>Użytkownicy</a>
                    </li>
                    <ul>
                        <li>
                            <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/report/'>Karta pracy</a>
                        </li>
                        <li>
                        <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/report2/'>Nadgodziny</a>
                        </li>
                        <li>
                        <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/leaves/'>Urlopy</a>
                        </li>
                        <li>
                            <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/addUser/'>Dodaj użytkownika</a>
                        </li>
                    </ul>
                    <?php }?>
                </ul>
            
        </div>
        <div id='content_div' style="height: 100%;">
            

    
    <h3 align='center'>Pracownicy</h3>
<table class="gridtable centre">
    <thead>
        <tr>
            <th>Imie i nazwisko</th>
            <th>Godzin dziennie (h) *</th>
        </tr>
    </thead>
    <tbody>
<?php  $_smarty_tpl->tpl_vars['_user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['userList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_user']->key => $_smarty_tpl->tpl_vars['_user']->value) {
$_smarty_tpl->tpl_vars['_user']->_loop = true;
?>
        <tr>
            <td class="cell-name" id="<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
">
                <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserMonth/index/<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
/' data-toggle="tooltip" data-placement="top" title="<?php echo $_smarty_tpl->tpl_vars['_user']->value->username;?>
"><?php echo $_smarty_tpl->tpl_vars['_user']->value->lastName;?>
 <?php echo $_smarty_tpl->tpl_vars['_user']->value->firstName;?>
</a>
            </td>
            <td class="cell-hours-daily" id="<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['_user']->value->hoursDaily;?>
</td>
            <td>
                <a href="#" id="<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
" class="link-user-login">Zaloguj</a>
            </td>
            <td>
                <a id='<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
' class='edit_user' href='#'>Edytuj</a>
            </td>
            
            <td>
                <a id='<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
' title ="dodaj do archiwum <?php echo $_smarty_tpl->tpl_vars['_user']->value->username;?>
" class='add_to_archives' href='#'><span>Archiwum</span></a>
            </td>
            <td>
                <a id='<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
' class='link_delete_user' href='#'>Usuń</a>
            </td>

            
        </tr>
<?php } ?>
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
<?php  $_smarty_tpl->tpl_vars['_user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['userArchives']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_user']->key => $_smarty_tpl->tpl_vars['_user']->value) {
$_smarty_tpl->tpl_vars['_user']->_loop = true;
?>
        <tr>
            <td class="cell-name" id="<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
">
                <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserMonth/index/<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
/' data-toggle="tooltip" data-placement="top" title="<?php echo $_smarty_tpl->tpl_vars['_user']->value->username;?>
"><?php echo $_smarty_tpl->tpl_vars['_user']->value->lastName;?>
 <?php echo $_smarty_tpl->tpl_vars['_user']->value->firstName;?>
</a>
            </td>
            <td class="cell-hours-daily" id="<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['_user']->value->hoursDaily;?>
</td>
            <td>
                <a href="#" id="<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
" class="link-user-login">Zaloguj</a>
            </td>
            <td>
                <a id='<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
' class='edit_user' href='#'>Edytuj</a>
            </td>
            <td>
                <a id='<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
' title ="dodaj do aktualnych pracowników <?php echo $_smarty_tpl->tpl_vars['_user']->value->username;?>
" class='add_to_active' href='#'><span >Przywróć</span></a>
            </td>
            <td>
                <a id='<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
' class='link_delete_user' href='#'>Usuń</a>
            </td>
            

            
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
    

            <br><br><br><br><br><br>
            
        </div>
        <div class="spinner" hidden='hidden'>
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
        <?php echo '<script'; ?>
>
            $(document).bind("ajaxSend", function(){
                $(".spinner").show();
              }).bind("ajaxComplete", function(){
                $(".spinner").hide();
            });
            $(".link_logout").click( function(event) {
                event.preventDefault();
                $.get("<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Login/logout/")
                    .done(function() {
                        alert('Wylogowano.');
                        document.location.replace("<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
");
                    });
            });

            $(".progress").click(function(){
                $(".progress_content").slideToggle();
            });
        <?php echo '</script'; ?>
>
    

<?php echo '<script'; ?>
>

$('.add_to_active').click( function(event){
    event.preventDefault();

   evtarget = $(event.target.parentElement.parentElement.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.childNodes).text();

    evtarget = evtarget.trim();
    var userId = event.target.parentElement.id;
    if (!confirm('Czy na pewno przenieść ' + evtarget +' do aktywnych pracowników ?')) {
            return;
        } else {
            $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/addToArchive/' + userId + '/',{ 'status' : 0 })
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
    var userId = event.target.parentElement.id;
    if (!confirm('Czy na pewno przenieść ' + evtarget +' do archiwum pracowników ?')) {
            return;
        } else {
            $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/addToArchive/' + userId + '/',{ 'status' : 1 })
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
    
    

$('.edit_user').click( function(event) {
    event.preventDefault();
    
    evtarget = $(event.target.parentElement.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.childNodes).text();

    evtarget = evtarget.trim();
    tableName = evtarget.split(" ", 2);
    login = $(event.target.parentElement.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.lastElementChild.getAttribute("title")).selector;
    
    newLastName = prompt("Podaj nowe nazwisko:", tableName[0]);
    newName = prompt("Podaj nowe imię:", tableName[1]);
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
    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/updateName/' + userId + '/',{ "new_name" : newName, "new_lastname" : newLastName, "new_login":newLogin })
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
        $.get('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Login/loginByUserId/' + event.target.id + '/')
            .fail(function(v1, v2, text) {
                alert($.parseJSON(text));
            })
            .done(function(text){
                alert(text);
                document.location.replace("<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
");
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
    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/updateHoursDaily/' + userId + '/',
                                            { "new_value" : newValue })
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
        
        $.get('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/delete/' + event.target.id + '/')
            .fail(function(v1, v2, text) {
                alert($.parseJSON(text));
                console.log("poszło");
            })
            .done(function(text){
                console.log(event.target.id);
                console.log(text);
                document.location.reload();
            });
    });

<?php echo '</script'; ?>
>
    

    </body>
</html><?php }} ?>
