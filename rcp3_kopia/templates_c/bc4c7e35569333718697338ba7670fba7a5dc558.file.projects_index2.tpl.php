<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-03 06:32:38
         compiled from "Views/projects_index2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96534081554a15886b525b9-27410694%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc4c7e35569333718697338ba7670fba7a5dc558' => 
    array (
      0 => 'Views/projects_index2.tpl',
      1 => 1435897883,
      2 => 'file',
    ),
    'b6e50672c2c09029b21b01eda864187f23cf1d76' => 
    array (
      0 => 'Views/base_layout.tpl',
      1 => 1435897172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96534081554a15886b525b9-27410694',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54a15886c3aad9_06692104',
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
<?php if ($_valid && !is_callable('content_54a15886c3aad9_06692104')) {function content_54a15886c3aad9_06692104($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/rcp/rcp3/Application/Smarty/plugins/modifier.date_format.php';
?><!DOCTYPE html>
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
        
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/ml-loading-bars.css">
    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/notification-boxes.css'>
    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/hint.css'>
    <style>
        table tbody.c1:nth-child(even) td
        {
            background-color: #efefef;
        }
    </style>

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
<?php $_smarty_tpl->tpl_vars['doZamkniecia'] = new Smarty_variable(array(), null, 0);?>
<?php $_smarty_tpl->tpl_vars['doZaakceptowania'] = new Smarty_variable(array(), null, 0);?>
<?php $_smarty_tpl->tpl_vars['doKierownika'] = new Smarty_variable(array(), null, 0);?>
<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
    <tbody class='holiday1'>
        <tr>
            <td colspan="5" style='border: none; height: 30px; vertical-align: bottom'><?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</td>
        </tr>
    </tbody>
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['group']->value['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value) {
$_smarty_tpl->tpl_vars['project']->_loop = true;
?>
    <?php if ($_smarty_tpl->tpl_vars['project']->value['project']->sent) {?>
        <?php $_smarty_tpl->createLocalArrayVariable('doZamkniecia', null, 0);
$_smarty_tpl->tpl_vars['doZamkniecia']->value[] = $_smarty_tpl->tpl_vars['project']->value['project'];?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['project']->value['project']->status==1) {?>
        <?php $_smarty_tpl->createLocalArrayVariable('doZaakceptowania', null, 0);
$_smarty_tpl->tpl_vars['doZaakceptowania']->value[] = $_smarty_tpl->tpl_vars['project']->value['project'];?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['project']->value['project']->status==0&&$_smarty_tpl->tpl_vars['project']->value['project']->projectManagerId==$_smarty_tpl->tpl_vars['user']->value->id) {?>
        <?php $_smarty_tpl->createLocalArrayVariable('doKierownika', null, 0);
$_smarty_tpl->tpl_vars['doKierownika']->value[] = $_smarty_tpl->tpl_vars['project']->value['project'];?>
    <?php }?>
    <tbody class="c1">
        <tr>
            <td style="font-weight: bold">
                <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/report/<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
/'><?php echo $_smarty_tpl->tpl_vars['project']->value['name'];?>
</a><br>
            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value['project']->orderNumber;?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value['project']->client;?>
</td>
            <td><?php echo sprintf("%.1f",$_smarty_tpl->tpl_vars['project']->value['total']);?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value['project']->budget;?>
</td>
            <td>
                <a class='link_update_progress' id='<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
' href='#'><?php echo $_smarty_tpl->tpl_vars['project']->value['project']->progress;?>
%</a>
            </td>
            <?php $_smarty_tpl->tpl_vars['timeProgress'] = new Smarty_variable($_smarty_tpl->tpl_vars['project']->value['project']->timeProgress(), null, 0);?>
            <td><?php if (null!=$_smarty_tpl->tpl_vars['timeProgress']->value) {
echo sprintf("%.1f",$_smarty_tpl->tpl_vars['timeProgress']->value);?>
%<?php }?></td>
            <td><?php if ($_smarty_tpl->tpl_vars['project']->value['project']->sent) {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['project']->value['project']->sent,'%Y-%m-%d');
}?></td>
            <td rowspan="2">
<?php if ($_smarty_tpl->tpl_vars['user']->value->accessLevel>3) {?>
                <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/docs/<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
/'>Dokumentacja</a><br>
<?php }?>                
                <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/editForm/<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
/'>Edytuj</a><br>
                <a id='<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
' class='project_send_link' href='#'>Wysyłka</a><br>
<?php if ($_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                <a id='<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
' class='project_close_link' href='#'>Zamknij</a>
<?php }?>
            </td>
        </tr>
        <tr>
            <td colspan="8">
                <?php if ($_smarty_tpl->tpl_vars['project']->value['project']->sent) {?>
                <div class='notice info'>
                    <p>Projekt został wysłany - do zamknięcia.</p>
                </div>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['project']->value['project']->status==0) {?>
                <div class='notice warning'>
                    <p>Projekt czeka na stworzenie harmonogramu.</p>
                    <p><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/editForm/<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
/">-- Kliknij tutaj --</a></p>
                </div>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['project']->value['project']->status==1) {?>
                <?php if ($_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                <div class='notice warning'>
                    <p><b>Harmonogram czeka na akceptację.</b></p>
                    <p><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/editForm/<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
/">-- Kliknij tutaj --</a></p>
                </div>
                <?php } else { ?>
                <div class='notice success'>
                    <p>Harmonogram czeka na akceptację.</p>
                </div>
                <?php }?>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['project']->value['project']->budget>0) {?>
                    <div class="loading-container-13">
                    <div class="loading-progress-13 hint--bottom hint--info" 
                         data-hint="Wykorzystany budżet: <?php echo $_smarty_tpl->tpl_vars['project']->value['total'];?>
d / <?php echo $_smarty_tpl->tpl_vars['project']->value['project']->budget;?>
d" 
                         style="width:<?php echo sprintf("%d",min(100,(100*$_smarty_tpl->tpl_vars['project']->value['total']/$_smarty_tpl->tpl_vars['project']->value['project']->budget)));?>
%;"></div>
                </div>
                <?php }?>
                <div class="loading-container-14">
                    <div class="loading-progress-14 hint--bottom hint--success" 
                         data-hint="Postęp prac: <?php echo $_smarty_tpl->tpl_vars['project']->value['project']->progress;?>
%"  
                         style="width:<?php echo $_smarty_tpl->tpl_vars['project']->value['project']->progress;?>
%;"></div>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['timeProgress']->value!=null) {?>
                    <?php if ($_smarty_tpl->tpl_vars['timeProgress']->value<=100) {?>
                <div class="loading-container-15 hint--bottom hint--warning" 
                         data-hint="Data rozpoczęcia: <?php echo $_smarty_tpl->tpl_vars['project']->value['project']->begin;?>
, data zakończenia: <?php echo $_smarty_tpl->tpl_vars['project']->value['project']->end;?>
">
                    <div class="loading-progress-15" style="width:<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['timeProgress']->value);?>
%;"></div>
                </div>
                <div>
                    <div style="float: left;"><?php echo $_smarty_tpl->tpl_vars['project']->value['project']->begin;?>
</div>
                    <div style="float: right;"><?php echo $_smarty_tpl->tpl_vars['project']->value['project']->end;?>
</div>
                </div>
                    <?php } else { ?>
                <div class="loading-container-15 hint--bottom hint--warning" 
                        data-hint="Data rozpoczęcia: <?php echo $_smarty_tpl->tpl_vars['project']->value['project']->begin;?>
, data zakończenia: <?php echo $_smarty_tpl->tpl_vars['project']->value['project']->end;?>
"
                        style="background-color: red;">
                    <div class="loading-progress-15" style="width:<?php echo sprintf("%d",(10000/$_smarty_tpl->tpl_vars['timeProgress']->value));?>
%;"></div>
                </div>
                <div>
                    <div style="position: relative;"><?php echo $_smarty_tpl->tpl_vars['project']->value['project']->begin;?>
</div>
                    <div style="position: relative; top: -13px; left: <?php echo sprintf("%d",(10000/$_smarty_tpl->tpl_vars['timeProgress']->value));?>
%"><?php echo $_smarty_tpl->tpl_vars['project']->value['project']->end;?>
</div>
                </div>
                    <?php }?>
                <?php }?>
            </td>
        </tr>
    </tbody>

<?php } ?>
<?php } ?>
</table>
<?php if (count($_smarty_tpl->tpl_vars['inactive']->value)>0) {?> 
<br><br>
<h2 align="center"><a id='inactive-toggle' href='#'>+ Projekty nieaktywne</a></h2>
<table id='inactive-projects' class='gridtable centre' hidden='hidden'>
    <tr>
        <th>Projekt</th>
    </tr>
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['inactive']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value) {
$_smarty_tpl->tpl_vars['project']->_loop = true;
?>
    <tr>
        <td>
            <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/report/<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
/'><?php echo $_smarty_tpl->tpl_vars['project']->value['project']->name;?>
</a>
        </td>
    </tr>
<?php } ?>
</table>
<?php }?>
<div class="centered-box" hidden="hidden">
    <h2 align="center"></h2>
    
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
        <?php echo '</script'; ?>
>
    
<?php echo '<script'; ?>
>
    
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
        
        $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/updateProgress/' + event.target.id + '/', { "new_progress" : newProgress })
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
        
    });
    
    $(".project_send_link").click( function(event) {
        event.preventDefault();
        
        var today = new Date;
        var todayString = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDay();
        var projectSentDate = prompt("Podaj datę wysyłki (RRRR-MM-DD)", todayString);
        if (null === projectSentDate) {
            return;
        }
        
        $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/send/' + event.target.id + '/', { "project_sent_date" : projectSentDate })
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $(".project_close_link").click( function(event) {
        event.preventDefault();
        
        if (!confirm('Na pewno zamknąć projekt?')) {
            return;
        };
        
        $.get('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/close/' + event.target.id + '/')
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
