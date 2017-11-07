<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-17 14:18:24
         compiled from "Views/leaves.tpl" */ ?>
<?php /*%%SmartyHeaderCode:33122881655418e9cdc0fc3-06617874%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a031de58e6438196f6f04726b8893b3f638b3f7' => 
    array (
      0 => 'Views/leaves.tpl',
      1 => 1431336304,
      2 => 'file',
    ),
    'b6e50672c2c09029b21b01eda864187f23cf1d76' => 
    array (
      0 => 'Views/base_layout.tpl',
      1 => 1435897172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33122881655418e9cdc0fc3-06617874',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55418e9cf02d68_01030428',
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
<?php if ($_valid && !is_callable('content_55418e9cf02d68_01030428')) {function content_55418e9cf02d68_01030428($_smarty_tpl) {?><!DOCTYPE html>
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
            
 
    <h2 align='center'>Urlopy</h2>
    <div align="center">
        <select id="month-select">
            <option id="0">Wybierz miesiąc</option>
            <option id="1">Styczeń 2015</option>
            <option id="2">Luty 2015</option>
            <option id="3">Marzec 2015</option>
            <option id="4">Kwiecień 2015</option>
            <option id="5">Maj 2015</option>
        </select>
    </div>
    <br><br>
    <table class='gridtable centre'>
        <tr>
            <th rowspan='2' style='min-width: 200px'>Imię i nazwisko</th>
            <th rowspan='2'>Zaległy z 2014*</th>
            <th rowspan='2'>Pula na 2015*</th>
            <th rowspan='2'>Wykorzystany</th>
            <th rowspan='2'>Pozostały</th>
            
            
<?php $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['month']->step = 1;$_smarty_tpl->tpl_vars['month']->total = (int) ceil(($_smarty_tpl->tpl_vars['month']->step > 0 ? date('m')+1 - (1) : 1-(date('m'))+1)/abs($_smarty_tpl->tpl_vars['month']->step));
if ($_smarty_tpl->tpl_vars['month']->total > 0) {
for ($_smarty_tpl->tpl_vars['month']->value = 1, $_smarty_tpl->tpl_vars['month']->iteration = 1;$_smarty_tpl->tpl_vars['month']->iteration <= $_smarty_tpl->tpl_vars['month']->total;$_smarty_tpl->tpl_vars['month']->value += $_smarty_tpl->tpl_vars['month']->step, $_smarty_tpl->tpl_vars['month']->iteration++) {
$_smarty_tpl->tpl_vars['month']->first = $_smarty_tpl->tpl_vars['month']->iteration == 1;$_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration == $_smarty_tpl->tpl_vars['month']->total;?>
            <th class="month-<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
" colspan='<?php echo cal_days_in_month(1,$_smarty_tpl->tpl_vars['month']->value,2015);?>
'><?php echo $_smarty_tpl->tpl_vars['monthNames']->value[$_smarty_tpl->tpl_vars['month']->value];?>
</th>
<?php }} ?>
        </tr>
        <tr>
<?php $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['month']->step = 1;$_smarty_tpl->tpl_vars['month']->total = (int) ceil(($_smarty_tpl->tpl_vars['month']->step > 0 ? date('m')+1 - (1) : 1-(date('m'))+1)/abs($_smarty_tpl->tpl_vars['month']->step));
if ($_smarty_tpl->tpl_vars['month']->total > 0) {
for ($_smarty_tpl->tpl_vars['month']->value = 1, $_smarty_tpl->tpl_vars['month']->iteration = 1;$_smarty_tpl->tpl_vars['month']->iteration <= $_smarty_tpl->tpl_vars['month']->total;$_smarty_tpl->tpl_vars['month']->value += $_smarty_tpl->tpl_vars['month']->step, $_smarty_tpl->tpl_vars['month']->iteration++) {
$_smarty_tpl->tpl_vars['month']->first = $_smarty_tpl->tpl_vars['month']->iteration == 1;$_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration == $_smarty_tpl->tpl_vars['month']->total;?>
<?php $_smarty_tpl->tpl_vars['day'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['day']->step = 1;$_smarty_tpl->tpl_vars['day']->total = (int) ceil(($_smarty_tpl->tpl_vars['day']->step > 0 ? cal_days_in_month(1,$_smarty_tpl->tpl_vars['month']->value,2015)+1 - (1) : 1-(cal_days_in_month(1,$_smarty_tpl->tpl_vars['month']->value,2015))+1)/abs($_smarty_tpl->tpl_vars['day']->step));
if ($_smarty_tpl->tpl_vars['day']->total > 0) {
for ($_smarty_tpl->tpl_vars['day']->value = 1, $_smarty_tpl->tpl_vars['day']->iteration = 1;$_smarty_tpl->tpl_vars['day']->iteration <= $_smarty_tpl->tpl_vars['day']->total;$_smarty_tpl->tpl_vars['day']->value += $_smarty_tpl->tpl_vars['day']->step, $_smarty_tpl->tpl_vars['day']->iteration++) {
$_smarty_tpl->tpl_vars['day']->first = $_smarty_tpl->tpl_vars['day']->iteration == 1;$_smarty_tpl->tpl_vars['day']->last = $_smarty_tpl->tpl_vars['day']->iteration == $_smarty_tpl->tpl_vars['day']->total;?>
            <th class="month-<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['day']->value;?>
</th>
<?php }} ?>
<?php }} ?>  
        </tr>
<?php  $_smarty_tpl->tpl_vars['dude'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dude']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dude']->key => $_smarty_tpl->tpl_vars['dude']->value) {
$_smarty_tpl->tpl_vars['dude']->_loop = true;
?>
    <tr>
        <th><?php echo $_smarty_tpl->tpl_vars['dude']->value->getFullName();?>
</th>
        <?php $_smarty_tpl->tpl_vars['overHours'] = new Smarty_variable($_smarty_tpl->tpl_vars['dude']->value->getOverHours(2015), null, 0);?>
        <th class="clickable_cell2014" id="<?php echo $_smarty_tpl->tpl_vars['dude']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['dude']->value->leaves2014;?>
</th>
        <th class="clickable_cell" id="<?php echo $_smarty_tpl->tpl_vars['dude']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['dude']->value->leaves;?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['overHours']->value['leavesTotal'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['dude']->value->leaves+$_smarty_tpl->tpl_vars['dude']->value->leaves2014-$_smarty_tpl->tpl_vars['overHours']->value['leavesTotal'];?>
</th>
        <?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_smarty_tpl->tpl_vars['monthNum'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['overHours']->value['daily']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value) {
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['monthNum']->value = $_smarty_tpl->tpl_vars['month']->key;
?>
        <?php  $_smarty_tpl->tpl_vars['day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day']->_loop = false;
 $_smarty_tpl->tpl_vars['dayNum'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['month']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day']->key => $_smarty_tpl->tpl_vars['day']->value) {
$_smarty_tpl->tpl_vars['day']->_loop = true;
 $_smarty_tpl->tpl_vars['dayNum']->value = $_smarty_tpl->tpl_vars['day']->key;
?>
        <td class="month-<?php echo $_smarty_tpl->tpl_vars['monthNum']->value;?>
" style="<?php if ($_smarty_tpl->tpl_vars['day']->value['isHoliday']) {?>background-color: #efefef;<?php }
if ($_smarty_tpl->tpl_vars['day']->value['leaves']) {?>background-color: yellow;<?php }?>">
            <?php echo $_smarty_tpl->tpl_vars['day']->value['leaves'];?>

        </td>
        <?php } ?>
        <?php } ?>
    </tr>
    
<?php } ?>
    </table>
     <h5 align='center'>* podwójne kliknięcie aby zmienić</h5>

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

function monthFilter(monthNum) {
    if (monthNum === "0") {
        $("[class^=month-]").show();
        return;
    }
    $("[class^=month-]").hide();
    $(".month-"+monthNum).show();
}

$(document).ready(function() {
    if(<?php if ($_smarty_tpl->tpl_vars['monthFilter']->value) {
echo $_smarty_tpl->tpl_vars['monthFilter']->value;
} else { ?>0<?php }?> > 0) {
        monthFilter(<?php echo $_smarty_tpl->tpl_vars['monthFilter']->value;?>
);
    }
});

$("#month-select").change(function() {
    //document.location.replace("<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/leaves/" + $(this).children(":selected").attr("id") + "/");
    var id = $(this).children(":selected").attr("id");
    
    monthFilter(id);
});

$('.clickable_cell2014').dblclick( function(event) {
    event.preventDefault();
    newValue = prompt("Podaj nową wartość:", 0);
    if(null === newValue || isNaN(newValue))
    {
        return;
    }
    var userId = event.target.id;
    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/updateLeaves2014/' + userId + '/',
                                            { "new_value" : newValue })
        .fail(function(v1, v2, text) {
            alert(text);
        })
        .done(function(text){
            document.location.reload();
        });
});
    
$('.clickable_cell').dblclick( function(event) {
    event.preventDefault();
    newValue = prompt("Podaj nową wartość:", 0);
    if(null === newValue || isNaN(newValue))
    {
        return;
    }
    var userId = event.target.id;
    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/updateLeaves/' + userId + '/',
                                            { "new_value" : newValue })
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
