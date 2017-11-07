<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-03 08:19:10
         compiled from "Views/projects_edit_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:153944729654a14bdf30c1a5-83590088%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cbf7962e0637a14b83bb3ab7c50f9defbce52bf3' => 
    array (
      0 => 'Views/projects_edit_form.tpl',
      1 => 1435887642,
      2 => 'file',
    ),
    'b6e50672c2c09029b21b01eda864187f23cf1d76' => 
    array (
      0 => 'Views/base_layout.tpl',
      1 => 1435897172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153944729654a14bdf30c1a5-83590088',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54a14bdf496863_30068312',
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
<?php if ($_valid && !is_callable('content_54a14bdf496863_30068312')) {function content_54a14bdf496863_30068312($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/rcp/rcp3/Application/Smarty/plugins/modifier.date_format.php';
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
            
    <h2 align='center'>Edycja projektu</h2>
    <br><br>
    
    <form id='project_edit_form' align='center'>
        <table class='gridtable centre'>
            <tr>
                <th>Nazwa projektu</th>
                <td><input name='name' value='<?php echo $_smarty_tpl->tpl_vars['project']->value->name;?>
' required></td>
            </tr>
            <tr>
                <th>Opis</th>
                <td><input name='description' value='<?php echo $_smarty_tpl->tpl_vars['project']->value->description;?>
'></td>
            </tr>
            <tr>
                <th>Grupa</th>
                <td>
                    <select name='group'>
<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groupList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
                        <option value='<?php echo $_smarty_tpl->tpl_vars['group']->value->id;?>
'<?php if ($_smarty_tpl->tpl_vars['group']->value->id==$_smarty_tpl->tpl_vars['project']->value->groupId) {?> selected='selected'<?php }?>>
                            <?php echo $_smarty_tpl->tpl_vars['group']->value->name;?>

                        </option>
<?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Numer zlecenia</th>
                <td><input name='order_number' value='<?php echo $_smarty_tpl->tpl_vars['project']->value->orderNumber;?>
'></td>
            </tr>
            <tr>
                <th>Klient</th>
                <td><input name='client' value='<?php echo $_smarty_tpl->tpl_vars['project']->value->client;?>
'></td>
            </tr>
            <tr>
                <th>Data rozpoczęcia</th>
                <td><input name='begin' type='date' value='<?php echo $_smarty_tpl->tpl_vars['project']->value->begin;?>
'></td>
            </tr>
            <tr>
                <th>Data zakończenia</th>
                <td><input name='end' type='date' value='<?php echo $_smarty_tpl->tpl_vars['project']->value->end;?>
'></td>
            </tr>
            <tr>
                <th>Kierownik projektu</th>
                <td>
                    <select name='project_manager'>
<?php  $_smarty_tpl->tpl_vars['userObject'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['userObject']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['userList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['userObject']->key => $_smarty_tpl->tpl_vars['userObject']->value) {
$_smarty_tpl->tpl_vars['userObject']->_loop = true;
?>
                    <option value='<?php echo $_smarty_tpl->tpl_vars['userObject']->value->id;?>
'<?php if ($_smarty_tpl->tpl_vars['userObject']->value->id==$_smarty_tpl->tpl_vars['project']->value->projectManagerId) {?> selected='selected'<?php }?>><?php echo $_smarty_tpl->tpl_vars['userObject']->value->getFullName();?>
</option>
<?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Budżet (dni robocze)</th>
                <td><input name='budget' type='number' value='<?php echo $_smarty_tpl->tpl_vars['project']->value->budget;?>
' min='0'></td>
            </tr>
            <tr>
                <th>Budżet (zł)</th>
                <td><input name='budgetPLN' type='number' value='<?php echo $_smarty_tpl->tpl_vars['project']->value->budgetPLN;?>
' min='0'></td>
            </tr>
            <tr>
                <td style='border: none'>&nbsp;</td>
                <td><input type='submit' value='Zapisz zmiany'></td>
            </tr>
        </table>
    </form>
               
    
        <table class='gridtable centre' style='margin-top: 50px'>
            <tr>
                <th>Zadania</th>
                <th>Data rozpoczęcia</th>
                <th>Data zakończenia</th>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['task']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['project']->value->getTasks(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value) {
$_smarty_tpl->tpl_vars['task']->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['task']->value->name;?>
</td>
                <td>
                    <?php if ($_smarty_tpl->tpl_vars['task']->value->begin) {?>
                        <a href="#" class="link-delete-begin" id="<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
">
                        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['task']->value->begin,"%Y-%m-%d");?>

                        </a>
                    <?php } else { ?>
                        <a href="#" class="link-set-begin" id="<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
">Dodaj datę</a>
                    <?php }?>   
                </td>
                <td>
                    <?php if ($_smarty_tpl->tpl_vars['task']->value->end) {?>
                        <a href="#" class="link-delete-end" id="<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
">
                        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['task']->value->end,"%Y-%m-%d");?>

                        </a>
                    <?php } else { ?>
                        <a href="#" class="link-set-end" id="<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
">Dodaj datę</a>
                    <?php }?>   
                </td>
                <td><a class='link_delete_task' id='<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
' href='#'>Usuń zadanie</a></td>
            </tr>
            <?php } ?>
            <tr>
                <td>
                    <form id='form_add_task'>
                        <input type='text' name='task_name'>
                        <input type='submit' value='Dodaj'>
                    </form>
                </td>
                
                <?php if ($_smarty_tpl->tpl_vars['project']->value->status==0) {?>
                <td colspan="3">
                    <button id="link-send-schedule">
                        Wyślij harmonogram do zaakceptowania
                    </button>
                </td>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['project']->value->status==1&&$_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                <td colspan="3">
                    <button id="link-accept-schedule">
                        Akceptuj harmonogram
                    </button>
                    <button id="link-decline-schedule">
                        Wyślij do poprawy
                    </button>
                </td>
                <?php }?>
            </tr>
        </table>


            
<?php if ($_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
    <br><br><br><br><br>
            <h3 align='center'>
                <a href='#' id='project-delete-link' style='color: red'>
                    Usuń projekt
                </a>
            </h3>
<?php }?>

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
    
    function setProjectStatus(newStatus) {
        $.post( "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/setProjectStatus/<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
/",  { "new_status" : newStatus }  )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    }
    
    $("#link-send-schedule").click(function() {
        setProjectStatus(1);
    });
    $("#link-accept-schedule").click(function() {
        setProjectStatus(2);
    });
    $("#link-decline-schedule").click(function() {
        setProjectStatus(0);
    });
    
    function dateToday() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd='0'+dd
        } 

        if(mm<10) {
            mm='0'+mm
        } 

        today = yyyy+'-'+mm+'-'+dd;
        return today;
    }
    
    function beforeSetTaskDate() {
        if (<?php echo $_smarty_tpl->tpl_vars['user']->value->accessLevel;?>
 > 1) {
            return true;
        }
        if (<?php echo $_smarty_tpl->tpl_vars['project']->value->status;?>
 > 0) {
            if(<?php echo $_smarty_tpl->tpl_vars['project']->value->status;?>
 > 1) {
                alert("Harmonogram został już zaakceptowany.");
                return false;
            }
            alert("Harmonogram został już wysłany do zaakceptowania.");
            return false;
        }
        return true;
    }
    
    $(".link-set-begin").click(function(event) {
        event.preventDefault();
        if (!beforeSetTaskDate()) {
            return;
        }
        var newBegin = prompt("Data rozpoczęcia zadania:", dateToday());
        var newBeginTs = Date.parse(newBegin) / 1000;
        
        if (isNaN(newBeginTs) || newBeginTs < 1000) {
            return;
        }
        
        $.post( "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/setTaskBegin/"+event.target.id+"/",  { "new_begin" : newBeginTs }  )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $(".link-set-end").click(function(event) {
        event.preventDefault();
        if (!beforeSetTaskDate()) {
            return;
        }
        var newEnd = prompt("Data zakończenia zadania:", dateToday());
        var newEndTs = Date.parse(newEnd) / 1000;
        
        if (isNaN(newEndTs) || newEndTs < 1000) {
            return;
        }
        
        $.post( "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/setTaskEnd/"+event.target.id+"/",  { "new_end" : newEndTs }  )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $(".link-delete-begin").click(function(event) {
        event.preventDefault();
        if (!beforeSetTaskDate()) {
            return;
        }
        
        $.post( "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/setTaskBegin/"+event.target.id+"/",  { "new_begin" : 0 }  )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $(".link-delete-end").click(function(event) {
        event.preventDefault();
        if (!beforeSetTaskDate()) {
            return;
        }
        
        $.post( "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/setTaskEnd/"+event.target.id+"/",  { "new_end" : 0 }  )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $("#project-delete-link").click( function(event) {
        event.preventDefault();
        
        if (!confirm('Na pewno usunąć projekt?')) {
            return;
        };
        
        $.get('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/delete/<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
/')
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(){
                alert('Projekt został usunięty!');
                document.location.replace('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/');
            });
    });
    
    $( "#project_edit_form" ).submit( function( event ){
        event.preventDefault();
        
        $.post( "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/edit/<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
/", $("#project_edit_form").serialize() )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                alert(text);
                document.location.reload();
            });
    });
    
    $( "#form_add_task" ).submit( function( event ){
        event.preventDefault();
        
        if (!beforeSetTaskDate()) {
            return;
        }
        
        $.post( "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/addTask/<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
/", $("#form_add_task").serialize() )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                alert(text);
                document.location.reload();
            });
    });
    
    $( ".link_delete_task").click( function( event) {
        event.preventDefault();
        
        $.get( "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
ProjectAction/deleteTask/" + event.target.id + "/" )
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
