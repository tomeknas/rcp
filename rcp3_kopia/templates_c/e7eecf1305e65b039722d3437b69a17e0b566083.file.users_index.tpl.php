<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-03 06:43:58
         compiled from "Views/users_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1233752865549a4ab19215e6-90048937%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7eecf1305e65b039722d3437b69a17e0b566083' => 
    array (
      0 => 'Views/users_index.tpl',
      1 => 1435890249,
      2 => 'file',
    ),
    'b6e50672c2c09029b21b01eda864187f23cf1d76' => 
    array (
      0 => 'Views/base_layout.tpl',
      1 => 1435897172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1233752865549a4ab19215e6-90048937',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_549a4ab19bd015_08049981',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'user' => 0,
    'projectBadge' => 0,
    'projectManagerBadges' => 0,
    'projectBadge2' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549a4ab19bd015_08049981')) {function content_549a4ab19bd015_08049981($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        
        <title>KPGeo - Rejestracja Czasu Pracy</title>
        <?php echo '<script'; ?>
 src='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/jquery.js'><?php echo '</script'; ?>
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
                    <?php if ($_smarty_tpl->tpl_vars['user']->value->isProjectManager()||$_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                    <li>
                        <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/'>Projekty</a>
<?php if ($_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                        <span class='badge'><?php echo $_smarty_tpl->tpl_vars['projectBadge']->value;?>
</span>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['projectManagerBadges']->value[$_smarty_tpl->tpl_vars['user']->value->id]) {?>
    <span class='badge green'><?php echo $_smarty_tpl->tpl_vars['projectManagerBadges']->value[$_smarty_tpl->tpl_vars['user']->value->id];?>
</span>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['projectBadge2']->value&&$_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
    <span class='badge green'><?php echo $_smarty_tpl->tpl_vars['projectBadge2']->value;?>
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
            

    
    <h2 align='center'>Użytkownicy</h2>
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
            <td>
                <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserMonth/index/<?php echo $_smarty_tpl->tpl_vars['_user']->value->id;?>
/'>
                    <?php echo $_smarty_tpl->tpl_vars['_user']->value->lastName;?>
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
' class='link_delete_user' href='#'>Usuń</a>
            </td>
        </tr>
<?php } ?>
    </tbody>
</table>
    

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
        <?php echo '</script'; ?>
>
    
<?php echo '<script'; ?>
>
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
        
        if (!confirm('Na pewno usunąć użytkownika?')) {
            return;
        };
        
        $.get('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/delete/' + event.target.id + '/')
            .fail(function(v1, v2, text) {
                alert($.parseJSON(text));
            })
            .done(function(text){
                alert(text);
                document.location.reload();
            });
    });

<?php echo '</script'; ?>
>
    

    </body>
</html><?php }} ?>
