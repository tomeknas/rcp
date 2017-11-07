<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-12-24 06:10:37
         compiled from "Views/projects_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1771035569549a4acd146392-58029450%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70dc7401f5c530c891848023ab421e717fad107a' => 
    array (
      0 => 'Views/projects_index.tpl',
      1 => 1419392091,
      2 => 'file',
    ),
    'b6e50672c2c09029b21b01eda864187f23cf1d76' => 
    array (
      0 => 'Views/base_layout.tpl',
      1 => 1419392418,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1771035569549a4acd146392-58029450',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SITE_URL' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_549a4acd21fe10_26319435',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549a4acd21fe10_26319435')) {function content_549a4acd21fe10_26319435($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        
        <title>KPGeo - Rejestracja Czasu Pracy</title>
        <?php echo '<script'; ?>
 src='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/jquery.js'><?php echo '</script'; ?>
>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
/Includes/base_style.css'>
        <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
/Includes/loading_indicator.css'>
        
    </head>
    <body>
        <div id='menu_div'>
            
                <h3><?php echo $_smarty_tpl->tpl_vars['user']->value->firstName;?>
</br><?php echo $_smarty_tpl->tpl_vars['user']->value->lastName;?>
</h3>
                <a href='#' class='link_logout'>Wyloguj</a>
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
Users/addUser/'>Dodaj użytkownika</a>
                        </li>
                    </ul>
                    <?php }?>
                </ul>
            
        </div>
        <div id='content_div'>
            
    
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
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['projects']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value) {
$_smarty_tpl->tpl_vars['project']->_loop = true;
?>
        <tr>
            <td>
                <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/report/<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
/'><?php echo $_smarty_tpl->tpl_vars['project']->value->name;?>
</a>
            </td>
            <td><?php echo sprintf("%.1f",$_smarty_tpl->tpl_vars['totals']->value[$_smarty_tpl->tpl_vars['project']->value->id]);?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value->budget;?>
</td>
            <td>
                <a class='link_update_progress' id='<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
' href='#'><?php echo $_smarty_tpl->tpl_vars['project']->value->progress;?>
%</a>
            </td>
            <?php $_smarty_tpl->tpl_vars['timeProgress'] = new Smarty_variable($_smarty_tpl->tpl_vars['project']->value->timeProgress(), null, 0);?>
            <td><?php if (null!=$_smarty_tpl->tpl_vars['timeProgress']->value) {
echo sprintf("%.1f",$_smarty_tpl->tpl_vars['timeProgress']->value);?>
%<?php }?></td>
            <td>
                <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/editForm/<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
/'>Edytuj</a>
<?php if ($_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                <a id='<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
' class='project_delete_link' href='#'>Usuń</a>
<?php }?>
            </td>
        </tr>
<?php } ?>
    </tbody>
</table>
    

            </br></br></br></br></br></br>
            
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
/Login/logout/")
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
    $(".link_update_progress").click( function(event) {
        event.preventDefault();
        
        var oldProgress = $(event.target).html().replace('%', '');
        var newProgress = prompt("Podaj nową wartość (%)", oldProgress);
        if (isNaN(newProgress) || (null === newProgress) || oldProgress === newProgress || newProgress < 0 || newProgress > 100) {
            return;
        }
        
        $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/updateProgress/' + event.target.id + '/', { "new_progress" : newProgress })
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
        
        $.get('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/delete/' + event.target.id + '/')
            .fail(function(v1, v2, text) {
                alert(text);
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
