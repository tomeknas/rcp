<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-27 21:08:02
         compiled from "Views\user_month.tpl" */ ?>
<?php /*%%SmartyHeaderCode:267875a020c2d6edbd3-81111419%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a79a8ec36ff8d960e9165f2174f79f25fe07e782' => 
    array (
      0 => 'Views\\user_month.tpl',
      1 => 1510863382,
      2 => 'file',
    ),
    'cf5d031d7811abe143b2a675129cecdef724eadb' => 
    array (
      0 => 'Views\\base_layout.tpl',
      1 => 1511813279,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '267875a020c2d6edbd3-81111419',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a020c2f6ff0f3_49259722',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'user' => 0,
    'projectsToSend' => 0,
    'projectBadge' => 0,
    'projectManagerBadges' => 0,
    'projectsForManager' => 0,
    'projectBadge2' => 0,
    'projectsToAccept' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a020c2f6ff0f3_49259722')) {function content_5a020c2f6ff0f3_49259722($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'C:\\xampp\\htdocs\\rcp\\rcp3_kopia\\Application\\Smarty\\plugins\\function.math.php';
if (!is_callable('smarty_function_html_select_time')) include 'C:\\xampp\\htdocs\\rcp\\rcp3_kopia\\Application\\Smarty\\plugins\\function.html_select_time.php';
?><!DOCTYPE html>
<html>
    <head>
        
        <title>KPGeo - Rejestracja Czasu Pracy</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <?php echo '<script'; ?>
 src='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/jquery.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
        
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/base_style.css'>
        <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/loading_indicator.css'>
        
<?php if ($_smarty_tpl->tpl_vars['showMediabox']->value) {?>
        <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/mediabox.css'>
        <?php echo '<script'; ?>
>var baseUrl = '<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
';<?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/mediabox.js'><?php echo '</script'; ?>
> 
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
                        <span class='badge' title='<?php echo $_smarty_tpl->tpl_vars['projectsToSend']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['projectBadge']->value;?>
</span>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['projectManagerBadges']->value[$_smarty_tpl->tpl_vars['user']->value->id]) {?>
                        <span class='badge blue' title="<?php echo $_smarty_tpl->tpl_vars['projectsForManager']->value[$_smarty_tpl->tpl_vars['user']->value->id];?>
"><?php echo $_smarty_tpl->tpl_vars['projectManagerBadges']->value[$_smarty_tpl->tpl_vars['user']->value->id];?>
</span>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['projectBadge2']->value&&$_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                        <span class='badge green' title="<?php echo $_smarty_tpl->tpl_vars['projectsToAccept']->value;?>
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
            <button type="button" class="progress">Postęp</button>
            <div class="progress_content">Tresc</div>
            
    <h2 align='center'><?php echo $_smarty_tpl->tpl_vars['cal']->value->user->getFullName();?>
</h2>
    <h2 align='center'><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserMonth/index/<?php echo $_smarty_tpl->tpl_vars['cal']->value->user->id;?>
/<?php echo $_smarty_tpl->tpl_vars['cal']->value->prevMonthYear;?>
/<?php echo $_smarty_tpl->tpl_vars['cal']->value->prevMonth;?>
/"><<</a>
    <?php echo $_smarty_tpl->tpl_vars['cal']->value->monthName;?>
 <?php echo $_smarty_tpl->tpl_vars['cal']->value->yearNum;?>

    <a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserMonth/index/<?php echo $_smarty_tpl->tpl_vars['cal']->value->user->id;?>
/<?php echo $_smarty_tpl->tpl_vars['cal']->value->nextMonthYear;?>
/<?php echo $_smarty_tpl->tpl_vars['cal']->value->nextMonth;?>
/">>></a></h2>

<table id='calendar' class='gridtable centre'>
    <colgroup>
       <col span="1" style="width: 50px;">
       <col span="1" style="width: 110px;">
       <col span="1" style="width: 110px;">
       <col span="1" style="width: 40px;">
       <col span="1" style="width: 80px;">
       <col span="1" style="width: 300px;">
       <col span="1" style="width: 300px;">
       <col span="1" style="width: 50px;">
    </colgroup>
<thead>
    
<tr><th>Dzień</th><th>Początek</th><th>Koniec</th>
<th>Czas</th><th>Nadgodziny</th><th>Zadanie</th>
<th>Komentarz</th><th>Edycja</th></tr>
</thead>
<?php  $_smarty_tpl->tpl_vars['day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cal']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day']->key => $_smarty_tpl->tpl_vars['day']->value) {
$_smarty_tpl->tpl_vars['day']->_loop = true;
?>
<tbody id='<?php echo $_smarty_tpl->tpl_vars['day']->value->dayNum;?>
' class='holiday<?php echo $_smarty_tpl->tpl_vars['day']->value->isHoliday;
if ($_smarty_tpl->tpl_vars['day']->value->isToday) {?> today<?php }?>'>
    <tr>
    <td rowspan='<?php echo smarty_function_math(array('equation'=>'max(a,b)','a'=>1,'b'=>count($_smarty_tpl->tpl_vars['day']->value)),$_smarty_tpl);?>
' valign='bottom'>
        <a class='add_link' href='#' id='<?php echo $_smarty_tpl->tpl_vars['day']->value->dayNum;?>
'<?php if ($_smarty_tpl->tpl_vars['day']->value->isToday&&$_smarty_tpl->tpl_vars['showMediabox']->value) {?> data-mediabox="<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
" data-direction="top" data-title="Nowe zadanie" data-content="Aby dodać nowy wpis, kliknij +"<?php }?>>
            +
        </a> <?php echo $_smarty_tpl->tpl_vars['day']->value->dayNum;?>

    </td>
<?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['task']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['day']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['task']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value) {
$_smarty_tpl->tpl_vars['task']->_loop = true;
 $_smarty_tpl->tpl_vars['task']->iteration++;
?>
<?php if ($_smarty_tpl->tpl_vars['task']->iteration>1) {?>
    <tr>
<?php }?>
        <td id="cellBegin<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['task']->value->beginTime;?>
</td>
        <td id="cellEnd<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['task']->value->endTime;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['task']->value->duration;?>
h</td>
<?php if ($_smarty_tpl->tpl_vars['task']->iteration==1) {?>
        <td rowspan='<?php echo smarty_function_math(array('equation'=>'max(a,b)','a'=>1,'b'=>count($_smarty_tpl->tpl_vars['day']->value)),$_smarty_tpl);?>
' valign='bottom'><?php echo $_smarty_tpl->tpl_vars['day']->value->overHoursDaily;?>
h<?php if ($_smarty_tpl->tpl_vars['day']->value->isToday) {?> (<?php echo $_smarty_tpl->tpl_vars['cal']->value->overHoursSoFar($_smarty_tpl->tpl_vars['day']->value->dayNum);?>
h)<?php }?></td>
<?php }?>  
        <td id="cellTask<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['task']->value->getTask()->getProject()->name;?>
 - <?php echo $_smarty_tpl->tpl_vars['task']->value->getTask()->name;?>
</td>
        <td id="cellComment<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['task']->value->comment;?>
</td>
        <td id="cellSubmit<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
">
            <a class='edit_link' href='#' id='<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
'>E</a>&nbsp;&nbsp;
            <a class='delete_link' href='#' id='<?php echo $_smarty_tpl->tpl_vars['task']->value->id;?>
'>X</a>
        </td>
    </tr>
<?php } ?>
<?php if (count($_smarty_tpl->tpl_vars['day']->value)==0) {?>
        <td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td><?php if ($_smarty_tpl->tpl_vars['day']->value->isToday) {?> (<?php echo $_smarty_tpl->tpl_vars['cal']->value->overHoursSoFar($_smarty_tpl->tpl_vars['day']->value->dayNum);?>
h)<?php }?></td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>
    </tr>
<?php }?>
</tbody>
<?php } ?>
<tfoot>
    <tr>
        <th rowspan='<?php echo $_smarty_tpl->tpl_vars['cal']->value->summary['totalsCount'];?>
' colspan='3' style='background: none; border: none; text-align: right; vertical-align: text-top;'>
            Suma:
        </th>
        <th><?php echo $_smarty_tpl->tpl_vars['cal']->value->summary['total'];?>
h</th>
        <th><?php echo $_smarty_tpl->tpl_vars['cal']->value->summary['overHours'];?>
h</th>
    </tr>
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project']->_loop = false;
 $_smarty_tpl->tpl_vars['projectName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cal']->value->summary['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value) {
$_smarty_tpl->tpl_vars['project']->_loop = true;
 $_smarty_tpl->tpl_vars['projectName']->value = $_smarty_tpl->tpl_vars['project']->key;
?>
    <tr>
        <th><?php echo $_smarty_tpl->tpl_vars['project']->value['total'];?>
h</th>
        <th colspan='2'><?php echo $_smarty_tpl->tpl_vars['projectName']->value;?>
</th>
    </tr>
<?php  $_smarty_tpl->tpl_vars['taskTotal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['taskTotal']->_loop = false;
 $_smarty_tpl->tpl_vars['taskName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['project']->value['tasks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['taskTotal']->key => $_smarty_tpl->tpl_vars['taskTotal']->value) {
$_smarty_tpl->tpl_vars['taskTotal']->_loop = true;
 $_smarty_tpl->tpl_vars['taskName']->value = $_smarty_tpl->tpl_vars['taskTotal']->key;
?>
    <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['taskTotal']->value;?>
h</td>
        <td colspan='2'> - <?php echo $_smarty_tpl->tpl_vars['taskName']->value;?>
</td>
    </tr>
<?php } ?>
<?php } ?>
</tfoot>


</table>



    <table id="hidden_table" hidden="hidden">
    <tr id='form_row'>
    <form id='add_form'>
        <td><?php echo smarty_function_html_select_time(array('display_seconds'=>false,'minute_interval'=>15,'field_separator'=>' : ','prefix'=>'begin_','hour_extra'=>'id="beginHourEdit"','minute_extra'=>'id="beginMinuteEdit"'),$_smarty_tpl);?>
</td>
        <td><?php echo smarty_function_html_select_time(array('display_seconds'=>false,'minute_interval'=>15,'field_separator'=>' : ','prefix'=>'end_','hour_extra'=>'id="endHourEdit"','minute_extra'=>'id="endMinuteEdit"'),$_smarty_tpl);?>
</td>
        <td></td>
        <td>
            <select id='group_select' style='width: 280px'>
                <option value="-1">Wybierz grupę</option>
<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
                <option id="<?php echo $_smarty_tpl->tpl_vars['group']->value->id;?>
" value="<?php echo $_smarty_tpl->tpl_vars['group']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['group']->value->name;?>
</option>
<?php } ?>
            </select><br>
            <select id="project_select" style="width: 280px">
                <option value="-1"> --- </option>
            </select><br>
            <select id="task_select" name="task_id" style="width: 280px">
                <option value='-1'> --- </option>
            </select>
        </td>
        <td><input id="commentEdit" name="comment" style="width: 280px"></td>
        <td><input type="submit" value="Dodaj"/></td>
    </form> 
    </tr>
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

            $(".progress").click(function(){
                $(".progress_content").slideToggle();
            });
        <?php echo '</script'; ?>
>
    
<?php echo '<script'; ?>
>
    var formSelectedDay = 0;
    var editedUserTask = 0;
    var editMode = false;
    
    var defaultRowBackground;
 
    
    $( ".delete_link").click( function(event) {
        event.preventDefault();
        
        if (!confirm("Na pewno usunąć wpis?")) {
            return;
        }
        
        $.get("<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserTask/delete/"+ event.target.id +"/")
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            });
    });
    
    $( ".edit_link ").click( function(event) {
        event.preventDefault();
        
        if(editMode && editedUserTask == event.target.id) {
            editMode = false;
            $( "*" ).css("text-decoration", "none");
            $("#hidden_table").append( $("#form_row") );
            return;
        }
        
        editedUserTask = event.target.id;
        
        $( ".add_link").html('+');
        formSelectedDay = 0;
        
        $.get("<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
TaskPickup/getUserTask/"+ event.target.id +"/")
            .done( function(data){
                var userTask = $.parseJSON(data);
                
                var dayNumberCell = $( "#cellBegin" + event.target.id).parent().parent().children("tr:first-child").children("td:first");
                var overHoursCell = $( "#cellBegin" + event.target.id).parent().parent().children("tr:first-child").children("td:nth-child(5)");
                dayNumberCell.prop("rowspan", dayNumberCell.prop("rowspan") + 1);
                overHoursCell.prop("rowspan", overHoursCell.prop("rowspan") + 1);
                
                
                $("#cellBegin" + event.target.id).parent().after($("#form_row"));
                $("#beginHourEdit").val(userTask.beginHour);
                $("#beginMinuteEdit").val(userTask.beginMinute);
                $("#endHourEdit").val(userTask.endHour);
                $("#endMinuteEdit").val(userTask.endMinute);
                $("#commentEdit").val(userTask.comment);
                $("#group_select").val(userTask.groupId);
                
                $("#project_select > option").remove();
                $.each(userTask.projects, function(id, name) {
                    $( "#project_select" ).append("<option id='"+ id +"' value='"+ id +"'>" + name + "</option>");
                });
                
                $("#project_select").val(userTask.projectId);
                
                $("#task_select > option").remove();
                $.each(userTask.tasks, function(id, name) {
                    $( "#task_select" ).append("<option value='"+ id +"'>" + name + "</option>");
                });
                
                $("#task_select").val(userTask.taskId);
                
                editMode = true;
                $( "*" ).css("text-decoration", "none");
                $( event.target ).parent().parent().children().css("text-decoration", "line-through");
                $(":submit").val("Zapisz");
            });
    });
    
    $(".add_link").click( function(event) {
        event.preventDefault();


        editedUserTask = 0;
        editMode = false;
        $( "*" ).css("text-decoration", "none");
        $(":submit").val("Dodaj");
        
        $( ".add_link").html('+');
        
        if (formSelectedDay == event.target.id) {
            $("#hidden_table").append( $("#form_row") );
            formSelectedDay = 0;
            return;
        }
        
        formSelectedDay = event.target.id;
        $( event.target ).html('-');
        
        var dayNumberCell = $( "#calendar > tbody#" + event.target.id + " > tr:first > td:first");
        var overHoursCell = $( "#calendar > tbody#" + event.target.id + " > tr:first > td:nth-child(5)");
        dayNumberCell.prop("rowspan", dayNumberCell.prop("rowspan") + 1);
        overHoursCell.prop("rowspan", overHoursCell.prop("rowspan") + 1);
        
        $( "#calendar > tbody#" + event.target.id )
                .append( $("#form_row") );
        
    });
    
    $( "#add_form" ).submit( function( event ){
        event.preventDefault();
        if ( $("#task_select > option:selected").val() < 0 ) {
            alert("Wybierz zadanie");
            return;
        }
        var url;
        if (!editMode) {
            url = "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserTask/add/<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['cal']->value->yearNum;?>
/<?php echo $_smarty_tpl->tpl_vars['cal']->value->monthNum;?>
/"+formSelectedDay+"/";
        } else {
            url = "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserTask/update/"+editedUserTask+"/<?php echo $_smarty_tpl->tpl_vars['cal']->value->yearNum;?>
/<?php echo $_smarty_tpl->tpl_vars['cal']->value->monthNum;?>
/"
            + $("#cellBegin"+editedUserTask).parent().parent().prop("id");
        }
        $.post( url, $("#add_form").serialize() )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                document.location.reload();
            })
            ;
    });
            
     $( "#group_select").change( function( event ){
        if ($("#group_select").val() < 0) {
            $( "#project_select > option" ).remove();
            $( "#project_select" ).append("<option value='-1'> --- </option>");
            
            $( "#task_select > option" ).remove();
            $( "#task_select" ).append("<option value='-1'> --- </option>");
            return;
        }
        $.get("<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
TaskPickup/getProjects/"+ $( "#group_select > option:selected" ).prop("id") +"/")
            .done( function(data){
                $( "#project_select > option" ).remove();
                $( "#project_select" ).append("<option> --- </option>");
                
                $( "#task_select > option" ).remove();
                $( "#task_select" ).append("<option> --- </option>");
                
                
                var projectList = $.parseJSON(data);
                $.each(projectList, function(key, project) {
                    $( "#project_select" ).append("<option id='" + project.id + "' value='"+ project.id +"'>" + project.name + "</option>");
                });
                $( "#project_select" ).show();
            });
    });
            
    $( "#project_select").change( function( event ){
        if ($("#project_select").val() < 0) {
            $( "#task_select > option" ).remove();
            $( "#task_select" ).append("<option value='-1'> --- </option>");
            return;
        }
        $.get("<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
TaskPickup/getTasks/"+ $( "#project_select > option:selected" ).prop("id") +"/")
            .done( function(data){
                $( "#task_select > option" ).remove();
                $( "#task_select" ).append("<option> --- </option>");
                var taskList = $.parseJSON(data);
                $.each(taskList, function(id, name) {
                    $( "#task_select" ).append("<option value='"+ id +"'>" + name + "</option>");
                });
                $( "#task_select" ).show();
            });
    });
    
<?php echo '</script'; ?>
>
    

    </body>
</html><?php }} ?>
