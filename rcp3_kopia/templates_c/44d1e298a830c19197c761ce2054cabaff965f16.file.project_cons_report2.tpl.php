<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-01-15 20:00:09
         compiled from "Views/project_cons_report2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:95599013454b80d75039b43-35181026%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44d1e298a830c19197c761ce2054cabaff965f16' => 
    array (
      0 => 'Views/project_cons_report2.tpl',
      1 => 1421348406,
      2 => 'file',
    ),
    'b6e50672c2c09029b21b01eda864187f23cf1d76' => 
    array (
      0 => 'Views/base_layout.tpl',
      1 => 1421327954,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '95599013454b80d75039b43-35181026',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54b80d750febc0_89055518',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'user' => 0,
    'projectBadge' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b80d750febc0_89055518')) {function content_54b80d750febc0_89055518($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_select_date')) include '/var/www/rcp/rcp3/Application/Smarty/plugins/function.html_select_date.php';
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
<?php if ($_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                        <span class='badge'><?php echo $_smarty_tpl->tpl_vars['projectBadge']->value;?>
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
            
    

    <h2 align='center'>Raport zbiorczy</h2>
    <h2 align='center'>Rok: <?php echo $_smarty_tpl->tpl_vars['report']->value['period']['to']['year'];?>
</h2>
    
<table class='gridtable centre'>
    <tr>
        <td style='border: none'>&nbsp;</td>
<?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->months; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value) {
$_smarty_tpl->tpl_vars['month']->_loop = true;
?>
        <th width='50'><?php echo $_smarty_tpl->tpl_vars['month']->value;?>
</th>
<?php } ?>
    </tr>
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->projects; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value) {
$_smarty_tpl->tpl_vars['project']->_loop = true;
?>
    <tr>
        <th><?php echo $_smarty_tpl->tpl_vars['project']->value->name;?>
</th>
<?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->months; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value) {
$_smarty_tpl->tpl_vars['month']->_loop = true;
?>
<?php $_smarty_tpl->tpl_vars['value'] = new Smarty_variable($_smarty_tpl->tpl_vars['report']->value->data[$_smarty_tpl->tpl_vars['project']->value->id][$_smarty_tpl->tpl_vars['month']->value], null, 0);?>
        <td><?php if ($_smarty_tpl->tpl_vars['value']->value>0) {
echo sprintf("%.1f",$_smarty_tpl->tpl_vars['value']->value);?>
d<?php }?></td>
<?php } ?>
    </tr>
<?php } ?>
    <tr>
        <td style='border: none'>&nbsp;</td>
<?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->months; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value) {
$_smarty_tpl->tpl_vars['month']->_loop = true;
?>
        <th width='50'><?php echo sprintf("%.1f",$_smarty_tpl->tpl_vars['report']->value->totals['month'][$_smarty_tpl->tpl_vars['month']->value]);?>
d</th>
<?php } ?>
    </tr>
</table>
<br><br>
<div align='center'>
    <h3>Wybierz okres:</h3>
<?php echo smarty_function_html_select_date(array('display_days'=>false,'display_months'=>false,'start_year'=>'-5','end_year'=>'+5','year_extra'=>'id="selectYear"'),$_smarty_tpl);?>

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
    
    $("#selectYear").change( function(event) {
        event.preventDefault();
        document.location.replace(
            "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/consReport/"
            +$("#selectYear").val()+"/"
            );
    });
    
<?php echo '</script'; ?>
>


    </body>
</html><?php }} ?>
