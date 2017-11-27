<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-27 21:41:47
         compiled from "Views\projects_cons_report2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:253245a04352d55c338-34066031%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a85c1fb101f1672532bd37fab2a14d1b4bed8d16' => 
    array (
      0 => 'Views\\projects_cons_report2.tpl',
      1 => 1509805532,
      2 => 'file',
    ),
    'cf5d031d7811abe143b2a675129cecdef724eadb' => 
    array (
      0 => 'Views\\base_layout.tpl',
      1 => 1511813279,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '253245a04352d55c338-34066031',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a04352e286340_22410687',
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
<?php if ($_valid && !is_callable('content_5a04352e286340_22410687')) {function content_5a04352e286340_22410687($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_select_date')) include 'C:\\xampp\\htdocs\\rcp\\rcp3_kopia\\Application\\Smarty\\plugins\\function.html_select_date.php';
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
            
    
<?php $_smarty_tpl->tpl_vars['excelReportArgs'] = new Smarty_variable('', null, 0);?>
    <h2 align='center'>Raport zbiorczy</h2>
    <h3 align='center'>
<?php if ($_smarty_tpl->tpl_vars['report']->value->allTime) {?>
        * cały czas *
<?php } else { ?>
<?php $_smarty_tpl->tpl_vars['excelReportArgs'] = new Smarty_variable(((((((($_smarty_tpl->tpl_vars['report']->value->period['from']['year']).('/')).($_smarty_tpl->tpl_vars['report']->value->period['from']['month'])).('/')).($_smarty_tpl->tpl_vars['report']->value->period['to']['year'])).('/')).($_smarty_tpl->tpl_vars['report']->value->period['to']['month'])).('/'), null, 0);?>
        <?php echo $_smarty_tpl->tpl_vars['report']->value->period['from']['month'];?>
/<?php echo $_smarty_tpl->tpl_vars['report']->value->period['from']['year'];?>

<?php if ($_smarty_tpl->tpl_vars['report']->value->period['to']!=$_smarty_tpl->tpl_vars['report']->value->period['from']) {?>
        - <?php echo $_smarty_tpl->tpl_vars['report']->value->period['to']['month'];?>
/<?php echo $_smarty_tpl->tpl_vars['report']->value->period['to']['year'];?>

<?php }?>
<?php }?>
    </h3>
    <h3 align='center'> - raport do pliku:
        <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Excel/consReport/<?php echo $_smarty_tpl->tpl_vars['excelReportArgs']->value;?>
'>
            .xls
        </a>
            |
        <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Excel/consReportPdf/<?php echo $_smarty_tpl->tpl_vars['excelReportArgs']->value;?>
'>
            .pdf
        </a>    
            -
    </h3>
    
<table class='gridtable centre'>
    <tr>
        <td style='border: none'>&nbsp;</td>
<?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->months; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value) {
$_smarty_tpl->tpl_vars['month']->_loop = true;
?>
<?php $_smarty_tpl->tpl_vars['monthArray'] = new Smarty_variable(explode('-',$_smarty_tpl->tpl_vars['month']->value), null, 0);?>
        <th width='70'>
            <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/report/<?php echo $_smarty_tpl->tpl_vars['monthArray']->value[0];?>
/<?php echo $_smarty_tpl->tpl_vars['monthArray']->value[1];?>
/<?php echo $_smarty_tpl->tpl_vars['monthArray']->value[0];?>
/<?php echo $_smarty_tpl->tpl_vars['monthArray']->value[1];?>
/'>
                <?php echo $_smarty_tpl->tpl_vars['month']->value;?>

            </a>
        </th>
<?php } ?>
    </tr>
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->projects; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value) {
$_smarty_tpl->tpl_vars['project']->_loop = true;
?>
    <tr>
        <th>
            <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/report/<?php echo $_smarty_tpl->tpl_vars['project']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['excelReportArgs']->value;?>
'>
                <?php echo $_smarty_tpl->tpl_vars['project']->value->name;?>

            </a>
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
        <th><?php echo sprintf("%.1f",$_smarty_tpl->tpl_vars['report']->value->totals['project'][$_smarty_tpl->tpl_vars['project']->value->id]);?>
d</th>
    </tr>
<?php } ?>
    <tr>
        <td style='border: none'>&nbsp;</td>
<?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->months; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value) {
$_smarty_tpl->tpl_vars['month']->_loop = true;
?>
        <th><?php echo sprintf("%.1f",$_smarty_tpl->tpl_vars['report']->value->totals['month'][$_smarty_tpl->tpl_vars['month']->value]);?>
d</th>
<?php } ?>
    </tr>
</table>
<br><br>
<div align='center'>
<h3>Wybierz okres:</h3>
<?php if (!$_smarty_tpl->tpl_vars['report']->value->allTime) {?>
<?php $_smarty_tpl->tpl_vars['fromDateTime'] = new Smarty_variable($_smarty_tpl->tpl_vars['report']->value->period['from']['dateTime'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['toDateTime'] = new Smarty_variable($_smarty_tpl->tpl_vars['report']->value->period['to']['dateTime'], null, 0);?>
<?php } else { ?>
<?php $_smarty_tpl->tpl_vars['fromDateTime'] = new Smarty_variable('', null, 0);?>
<?php $_smarty_tpl->tpl_vars['toDateTime'] = new Smarty_variable('', null, 0);?>
<?php }?>
<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['fromDateTime']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo smarty_function_html_select_date(array('time'=>$_tmp1,'display_days'=>false,'month_format'=>'%m','start_year'=>'-5','end_year'=>'+5','year_extra'=>'id="fromYear"','month_extra'=>'id="fromMonth"'),$_smarty_tpl);?>
 - 
<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['toDateTime']->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo smarty_function_html_select_date(array('time'=>$_tmp2,'display_days'=>false,'month_format'=>'%m','start_year'=>'-5','end_year'=>'+5','year_extra'=>'id="toYear"','month_extra'=>'id="toMonth"'),$_smarty_tpl);?>

<br><br>
<button id='selectPeriodButton'>Pokaż</button>
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

            $(".progress").click(function(){
                $(".progress_content").slideToggle();
            });
        <?php echo '</script'; ?>
>
    
    
<?php echo '<script'; ?>
>
    
    $("#fromMonth").change( function() {
        $("#toMonth").val( $(this).val() );
    });
    
    $("#fromYear").change( function() {
        $("#toYear").val( $(this).val() );
    });
    
    
    $("#selectPeriodButton").click( function(event) {
        event.preventDefault();
        document.location.replace(
            "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/consReport/"
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
