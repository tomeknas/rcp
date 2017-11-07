<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-03 06:44:24
         compiled from "Views/over_hours.tpl" */ ?>
<?php /*%%SmartyHeaderCode:756822203552f0b0c9ee745-89930769%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c70053785cb0b6e8a60c37ed64645b3afd4d9e48' => 
    array (
      0 => 'Views/over_hours.tpl',
      1 => 1430355654,
      2 => 'file',
    ),
    'b6e50672c2c09029b21b01eda864187f23cf1d76' => 
    array (
      0 => 'Views/base_layout.tpl',
      1 => 1435897172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '756822203552f0b0c9ee745-89930769',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_552f0b0ca89a44_92766695',
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
<?php if ($_valid && !is_callable('content_552f0b0ca89a44_92766695')) {function content_552f0b0ca89a44_92766695($_smarty_tpl) {?><!DOCTYPE html>
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
            
 
    <h2 align='center'>Nadgodziny</h2>
    <table class='gridtable centre'>
        <tr>
            <th rowspan='2' style='min-width: 200px'>Imię i nazwisko</th>
            <th rowspan='2'>Stan</th>
            <th rowspan="2">Wypłacone</th>
            <th rowspan="2">Odebrane</th>
            
<?php $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['month']->step = 1;$_smarty_tpl->tpl_vars['month']->total = (int) ceil(($_smarty_tpl->tpl_vars['month']->step > 0 ? date('m')+1 - (1) : 1-(date('m'))+1)/abs($_smarty_tpl->tpl_vars['month']->step));
if ($_smarty_tpl->tpl_vars['month']->total > 0) {
for ($_smarty_tpl->tpl_vars['month']->value = 1, $_smarty_tpl->tpl_vars['month']->iteration = 1;$_smarty_tpl->tpl_vars['month']->iteration <= $_smarty_tpl->tpl_vars['month']->total;$_smarty_tpl->tpl_vars['month']->value += $_smarty_tpl->tpl_vars['month']->step, $_smarty_tpl->tpl_vars['month']->iteration++) {
$_smarty_tpl->tpl_vars['month']->first = $_smarty_tpl->tpl_vars['month']->iteration == 1;$_smarty_tpl->tpl_vars['month']->last = $_smarty_tpl->tpl_vars['month']->iteration == $_smarty_tpl->tpl_vars['month']->total;?>
            <th colspan='<?php echo cal_days_in_month(1,$_smarty_tpl->tpl_vars['month']->value,2015);?>
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
            <th><?php echo $_smarty_tpl->tpl_vars['day']->value;?>
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
        <th><?php echo $_smarty_tpl->tpl_vars['overHours']->value['total']-$_smarty_tpl->tpl_vars['overHours']->value['takenTotal']-$_smarty_tpl->tpl_vars['overHours']->value['modTotal'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['overHours']->value['modTotal'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['overHours']->value['takenTotal'];?>
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
        <td
            <?php if ($_smarty_tpl->tpl_vars['day']->value['isHoliday']) {?>style='background-color: #efefef'<?php }?>
            class='clickable_cell'
            id='<?php echo $_smarty_tpl->tpl_vars['dude']->value->id;?>
-2015-<?php echo $_smarty_tpl->tpl_vars['monthNum']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['dayNum']->value;?>
'
            <?php if ($_smarty_tpl->tpl_vars['day']->value['taken']) {?>style="background-color:red;"<?php }?>>
            <span class="hint--info hint--bottom"
                  style=""
data-hint="<?php echo $_smarty_tpl->tpl_vars['dude']->value->getFullName();?>
&#10;2015-<?php echo $_smarty_tpl->tpl_vars['monthNum']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['dayNum']->value;
if ($_smarty_tpl->tpl_vars['day']->value['mod']) {?>&#10;Wypłacone nadgodziny: <?php echo $_smarty_tpl->tpl_vars['day']->value['mod'];
}
if ($_smarty_tpl->tpl_vars['day']->value['taken']) {?>&#10;Odebrane nadgodziny: <?php echo $_smarty_tpl->tpl_vars['day']->value['taken'];
}?>">
            <?php if ($_smarty_tpl->tpl_vars['day']->value['mod']) {?>
                <b><?php echo $_smarty_tpl->tpl_vars['day']->value['count']-$_smarty_tpl->tpl_vars['day']->value['taken']-$_smarty_tpl->tpl_vars['day']->value['mod'];?>
 (<?php echo $_smarty_tpl->tpl_vars['day']->value['count'];?>
)</b>
            <?php } else { ?>
                <?php echo $_smarty_tpl->tpl_vars['day']->value['count']-$_smarty_tpl->tpl_vars['day']->value['taken'];?>

            <?php }?>
            </span>
        </td>
        <?php } ?>
        <?php } ?>
    </tr>
    
<?php } ?>
    </table>
     <h5 align='center'>* podwójne kliknięcie na konkretny dzień danej osoby aby zmienić status nadgodzin</h5>

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
$('.clickable_cell').dblclick( function(event) {
    event.preventDefault();
    newValue = prompt("Nadgodziny do wypłaty:", 0);
    if(null === newValue || isNaN(newValue))
    {
        return;
    }
    var dateArray = $(event.target).closest('td').attr('id').split("-");
    var userId = dateArray[0];
    var year = dateArray[1];
    var month = dateArray[2];
    var day = dateArray[3];
    $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/updateOverHours/' + userId + '/' + year + '/' + month + '/' + day + '/',
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
