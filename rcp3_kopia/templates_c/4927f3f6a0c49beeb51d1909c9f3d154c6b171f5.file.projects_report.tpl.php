<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-06 10:53:25
         compiled from "Views/projects_report.tpl" */ ?>
<?php /*%%SmartyHeaderCode:988776691549a4af65e0aa9-18988109%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4927f3f6a0c49beeb51d1909c9f3d154c6b171f5' => 
    array (
      0 => 'Views/projects_report.tpl',
      1 => 1435887746,
      2 => 'file',
    ),
    'b6e50672c2c09029b21b01eda864187f23cf1d76' => 
    array (
      0 => 'Views/base_layout.tpl',
      1 => 1435897172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '988776691549a4af65e0aa9-18988109',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_549a4af66df332_14834034',
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
<?php if ($_valid && !is_callable('content_549a4af66df332_14834034')) {function content_549a4af66df332_14834034($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/rcp/rcp3/Application/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_html_select_date')) include '/var/www/rcp/rcp3/Application/Smarty/plugins/function.html_select_date.php';
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
        
    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Application/gantt/jquery.ganttView.css'>
    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Application/gantt/jquery-ui-1.8.4.css'>
<?php if (!$_smarty_tpl->tpl_vars['project']->value->active) {?>
    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/notification-boxes.css'>
<?php }?>

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
            
    
    
    <div id="quarter">
    <table class='gridtable centre'>
        <tr>
            <th>Nazwa projektu</th>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value->name;?>
</td>
        </tr>
        <tr>
            <th>Opis</th>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value->description;?>
</td>
        </tr>
        <tr>
            <th>Grupa</th>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value->groupName();?>
</td>
        </tr>
        <tr>
            <th>Numer zlecenia</th>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value->orderNumber;?>
</td>
        </tr>
        <tr>
            <th>Klient</th>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value->client;?>
</td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['project']->value->beginTimeStamp>0) {?>
        <tr>
            <th>Data rozpoczęcia</th>
            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['project']->value->beginTimeStamp,'%Y-%m-%d');?>
</td>
        </tr>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['project']->value->endTimeStamp>0) {?>
        <tr>
            <th>Data zakończenia</th>
            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['project']->value->endTimeStamp,'%Y-%m-%d');?>
</td>
        </tr>
        <?php }?>
        <tr>
            <th>Kierownik projektu</th>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value->projectManager->getFullName();?>
</td>
        </tr>
        <tr>
            <th>Budżet (dni)</th>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value->budget;?>
</td>
        </tr>
        <tr>
            <th>Budżet (zł)</th>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value->budgetPLN;?>
</td>
        </tr>
        <tr>
            <th>Postęp prac</th>
            <td><?php echo $_smarty_tpl->tpl_vars['project']->value->progress;?>
%</td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['project']->value->sent) {?>
        <tr>
            <th>Data wysyłki</th>
            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['project']->value->sent,'%Y-%m-%d');?>
</td>
        </tr>
        <?php }?>
        <tr>
            <td colspan="2" align="center"><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
PDF/index/<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
">* Plan realizacji usługi (pdf) *</a></td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
        <tr>
            <td colspan="2" align="center"><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/editForm/<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
">Edycja projektu</a></td>
        </tr>
        <?php }?>
        <?php if (!$_smarty_tpl->tpl_vars['project']->value->active) {?>
        <tr>
            <td style='border: none' colspan='2'>
                <div class='notice error'>
                    <p>Projekt jest nieaktywny.<br><br><a id='project-activate-link' href='#'> - przywróć -</a></p>
                </div>
            </td>
        </tr>
        <?php }?>
    </table>
    </div>
    <div id="quarter">
        <h2 align="center">Historia zmian</h2>
        <table class="gridtable centre">
            <tr>
                <th>Osoba</th>
                <th>Zmiana</th>
                <th>Data</th>
                <th>Zatwierdził</th>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['projectEvents']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value) {
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['event']->value->getUser()->getFullName();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['event']->value->event;?>
</td>
                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['event']->value->time,"%Y-%m-%d");?>
</td>
                <?php $_smarty_tpl->tpl_vars['acceptedBy'] = new Smarty_variable($_smarty_tpl->tpl_vars['event']->value->getAccepts(), null, 0);?>
                <td><?php if ($_smarty_tpl->tpl_vars['acceptedBy']->value) {
echo $_smarty_tpl->tpl_vars['acceptedBy']->value->getFullName();
}?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['project']->value->beginTimeStamp>0&&$_smarty_tpl->tpl_vars['project']->value->endTimeStamp>0) {?>
    <div id="half" style="">
        <h2 align="center">Plan realizacji usługi</h2>

    <div style="text-align: center;">
    
        <div id="gantt" style="display: inline-block; text-align: initial"></div>
    </div>
    </div>
    <?php }?>
    <div id="half">
        <br><br>
      
        <h2 align='center'>Podsumowanie godzin</h2>
<?php if (!$_smarty_tpl->tpl_vars['allTime']->value) {?>
        <h2 align='center'><?php echo $_smarty_tpl->tpl_vars['args']->value[2];?>
/<?php echo $_smarty_tpl->tpl_vars['args']->value[1];?>
 - <?php echo $_smarty_tpl->tpl_vars['args']->value[4];?>
/<?php echo $_smarty_tpl->tpl_vars['args']->value[3];?>
</h2>
<?php }?>
    
        <table class='gridtable centre'>
            <tr>
                <td style='border: none'>&nbsp;</td>
<?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['task']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->tasks; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value) {
$_smarty_tpl->tpl_vars['task']->_loop = true;
?>
                <th><?php echo $_smarty_tpl->tpl_vars['task']->value->name;?>
</th>
<?php } ?>
            </tr>
<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->users; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
            <tr>
                <th><?php echo $_smarty_tpl->tpl_vars['user']->value->getFullName();?>
</th>
<?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['task']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->tasks; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value) {
$_smarty_tpl->tpl_vars['task']->_loop = true;
?>
                <td><?php echo $_smarty_tpl->tpl_vars['report']->value->data[$_smarty_tpl->tpl_vars['task']->value->id][$_smarty_tpl->tpl_vars['user']->value->id];?>
h</td>
<?php } ?>
                <th><?php echo $_smarty_tpl->tpl_vars['report']->value->usersTotal[$_smarty_tpl->tpl_vars['user']->value->id];?>
h</th>
            </tr>
<?php } ?>
            <tr>
                <td style='border: none'>&nbsp;</td>
<?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['task']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->tasks; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value) {
$_smarty_tpl->tpl_vars['task']->_loop = true;
?>
                <th><?php echo $_smarty_tpl->tpl_vars['report']->value->tasksTotal[$_smarty_tpl->tpl_vars['task']->value->id];?>
h</th>
<?php } ?>
                <th><?php echo $_smarty_tpl->tpl_vars['report']->value->total;?>
h</th>
            </tr>
        </table>
            <br><br>
                <div align='center'>
                    <h3>Wybierz okres:</h3>
<?php echo smarty_function_html_select_date(array('display_days'=>false,'start_year'=>'-5','end_year'=>'+5','month_format'=>'%m','year_extra'=>'id="fromYear"','month_extra'=>'id="fromMonth"'),$_smarty_tpl);?>
 - 
<?php echo smarty_function_html_select_date(array('display_days'=>false,'start_year'=>'-5','end_year'=>'+5','month_format'=>'%m','year_extra'=>'id="toYear"','month_extra'=>'id="toMonth"'),$_smarty_tpl);?>

<br><br>
                    <button id='selectPeriodButton'>Pokaż</button>
                </div>
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
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Application/gantt/date.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Application/gantt/jquery-ui-1.8.4.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Application/gantt/jquery.ganttView.js"><?php echo '</script'; ?>
>
    
<?php echo '<script'; ?>
>
    var ganttData = [
        <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['task']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->tasks; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value) {
$_smarty_tpl->tpl_vars['task']->_loop = true;
?>
            {
                id: <?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
, name: "<?php echo $_smarty_tpl->tpl_vars['task']->value->name;?>
", progress: <?php echo $_smarty_tpl->tpl_vars['task']->value->progress;?>
, series: [
                    { 
                        name: "", 
                        start: new Date(<?php if ($_smarty_tpl->tpl_vars['task']->value->begin) {
echo $_smarty_tpl->tpl_vars['task']->value->begin;
} else {
echo $_smarty_tpl->tpl_vars['project']->value->beginTimeStamp;
}?> * 1000), 
                        end: new Date(<?php if ($_smarty_tpl->tpl_vars['task']->value->end) {
echo $_smarty_tpl->tpl_vars['task']->value->end;
} else {
echo $_smarty_tpl->tpl_vars['project']->value->endTimeStamp;
}?> * 1000) 
                    }
                ]
            },
        <?php } ?>
    ];

    $(function () {
        $("#gantt").ganttView({ 
            data: ganttData,   
            slideWidth: "800",
            behavior: {
                draggable: false,
                resizable: false,
                onClick: function(data) { 
                    //alert(data.start);
                    return;
                    var newProgress = prompt("Postęp prac (%):", data.progress);
                    if (isNaN(newProgress) || (null === newProgress) || data.progress === newProgress || newProgress < 0 || newProgress > 100) {
                        return;
                    }

                    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/setTaskProgress/' + data.id + '/', { "new_progress" : newProgress })
                        .fail(function(v1, v2, text) {
                            alert(text);
                        })
                        .done(function(text){
                            document.location.reload();
                        });
                }
            }
        });
    });
        
    $("#project-activate-link").click( function(event) {
        event.preventDefault();
        
        $.get('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/close/<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
/')
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $("#selectPeriodButton").click( function(event) {
        event.preventDefault();
        document.location.replace(
            "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/report/<?php echo $_smarty_tpl->tpl_vars['report']->value->projectId;?>
/"
            +$("#fromYear").val()+"/"
            +$("#fromMonth").val()+"/"
            +$("#toYear").val()+"/"
            +$("#toMonth").val()+"/"
            );
    });
    
<?php echo '</script'; ?>
>


    </body>
</html><?php }} ?>
