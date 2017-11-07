<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-03 06:50:09
         compiled from "Views/project_templates.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1627728576552ef3cbdaf305-72672406%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a802152d31bb9738042e064683223d0032d5d8b5' => 
    array (
      0 => 'Views/project_templates.tpl',
      1 => 1429144265,
      2 => 'file',
    ),
    'b6e50672c2c09029b21b01eda864187f23cf1d76' => 
    array (
      0 => 'Views/base_layout.tpl',
      1 => 1435897172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1627728576552ef3cbdaf305-72672406',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_552ef3cbe67798_47445323',
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
<?php if ($_valid && !is_callable('content_552ef3cbe67798_47445323')) {function content_552ef3cbe67798_47445323($_smarty_tpl) {?><!DOCTYPE html>
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
        
    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/notification-boxes.css'>
    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/hint.css'>

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
            
    
    
        
    <h2 align='center'>Szablony projektów</h2>
    <h3 align='center'><a id='link_new_template' href='#'>> Nowy szablon <</a></h3>
    <?php  $_smarty_tpl->tpl_vars['template'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['template']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['templates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['template']->key => $_smarty_tpl->tpl_vars['template']->value) {
$_smarty_tpl->tpl_vars['template']->_loop = true;
?>
        <table class='gridtable centre'>
        
        <tr>
            <th>
                <a class='link_delete_template' id='<?php echo $_smarty_tpl->tpl_vars['template']->value->id;?>
' href='#'>x</a>
                <span class='template_name' id='<?php echo $_smarty_tpl->tpl_vars['template']->value->id;?>
'><?php echo $_smarty_tpl->tpl_vars['template']->value->name;?>
</span>
            </th>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['task']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template']->value->getTasks(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value) {
$_smarty_tpl->tpl_vars['task']->_loop = true;
?>
            <tr>
                <td>
                    <a class='link_delete_task' id='<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
' href='#'>x</a>
                    <span class='task_name' id='<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
'><?php echo $_smarty_tpl->tpl_vars['task']->value->name;?>
</span>
                </td>
            </tr>
            <?php } ?>
                    <tr><td>
                <a class='link_new_task' id='<?php echo $_smarty_tpl->tpl_vars['template']->value->id;?>
' href='#'>> Dodaj zadanie <</a>
                </td></tr>
        </table><br>
        <?php } ?>
        <h5 align='center'>* podwójne kliknięcie nazwy szablonu lub zadania aby zmienić nazwę</h5>

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
$('#link_new_template').click( function(event) {
    event.preventDefault();
    var templateName = prompt("Podaj nazwę szablonu");
    if(null === templateName || templateName.length < 2)
    {
        return;
    }
    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectTemplates/addTemplate/', { "template_name" : templateName })
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
    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectTemplates/deleteTemplate/' + event.target.id + '/')
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
    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectTemplates/renameTemplate/' + event.target.id + '/', { "template_new_name" : templateName })
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
    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectTemplates/addTask/' + event.target.id + '/', { "task_name" : taskName })
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
    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectTemplates/deleteTask/' + event.target.id + '/')
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
    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectTemplates/renameTask/' + event.target.id + '/', { "task_new_name" : taskName })
        .fail(function(v1, v2, text) {
            alert(text);
        })
        .done(function(text){
            document.location.reload();
        });
});
<?php echo '</script'; ?>
>


    </body>
</html><?php }} ?>
