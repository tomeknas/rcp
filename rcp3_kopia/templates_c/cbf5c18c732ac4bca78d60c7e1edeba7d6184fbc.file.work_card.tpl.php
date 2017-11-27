<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-23 18:07:50
         compiled from "Views\work_card.tpl" */ ?>
<?php /*%%SmartyHeaderCode:219115a043572b7ccb9-08469895%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cbf5c18c732ac4bca78d60c7e1edeba7d6184fbc' => 
    array (
      0 => 'Views\\work_card.tpl',
      1 => 1509805531,
      2 => 'file',
    ),
    'cf5d031d7811abe143b2a675129cecdef724eadb' => 
    array (
      0 => 'Views\\base_layout.tpl',
      1 => 1511304998,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '219115a043572b7ccb9-08469895',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a04357317a8b6_91153275',
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
<?php if ($_valid && !is_callable('content_5a04357317a8b6_91153275')) {function content_5a04357317a8b6_91153275($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\rcp\\rcp3_kopia\\Application\\Smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_html_select_date')) include 'C:\\xampp\\htdocs\\rcp\\rcp3_kopia\\Application\\Smarty\\plugins\\function.html_select_date.php';
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
        
    
    <style>
        
     th.rotate {
  /* Something you can count on */
  height: 140px;
  white-space: nowrap;
}

th.rotate > div {
  transform: 
    /* Magic Numbers */
    translate(25px, 51px)
    /* 45 is really 360 - 45 */
    rotate(315deg);
  width: 30px;
}
th.rotate > div > span {
  border-bottom: 1px solid #ccc;
  padding: 5px 10px;
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
            <button type="button" class="progress">Postęp</button>
            <div class="progress_content">Tresc</div>
            
        <h2 align='center'>Karta pracy</h2>
        <h2 align='center'>
            <?php echo $_smarty_tpl->tpl_vars['report']->value->monthFrom;?>
/<?php echo $_smarty_tpl->tpl_vars['report']->value->yearFrom;?>

            <?php if (smarty_modifier_date_format($_smarty_tpl->tpl_vars['report']->value->fromDateTime,'Y-m')!=smarty_modifier_date_format($_smarty_tpl->tpl_vars['report']->value->toDateTime,'Y-m')) {?>
                - <?php echo $_smarty_tpl->tpl_vars['report']->value->monthTo;?>
/<?php echo $_smarty_tpl->tpl_vars['report']->value->yearTo;?>

            <?php }?>
        </h2>
        <h3 align='center'>
            <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Excel/workCard/<?php echo $_smarty_tpl->tpl_vars['report']->value->yearFrom;?>
/<?php echo $_smarty_tpl->tpl_vars['report']->value->monthFrom;?>
/<?php echo $_smarty_tpl->tpl_vars['report']->value->yearTo;?>
/<?php echo $_smarty_tpl->tpl_vars['report']->value->monthTo;?>
/'>
                - raport do pliku .xls -
            </a>
        </h3>

        <table class='gridtable centre' style='margin-top: 100px'>
            <tr>
                <td style='border: none'>&nbsp;</td>
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->projects; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value) {
$_smarty_tpl->tpl_vars['project']->_loop = true;
?>
                <th style='background: none; border: none' class="rotate"><div><span>
                    <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/report/<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
/'>
                        <?php echo $_smarty_tpl->tpl_vars['project']->value['name'];?>

                    </a>
                </span></div></th>
<?php } ?>
<?php  $_smarty_tpl->tpl_vars['project3Task'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project3Task']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->project3Tasks; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project3Task']->key => $_smarty_tpl->tpl_vars['project3Task']->value) {
$_smarty_tpl->tpl_vars['project3Task']->_loop = true;
?>
                <th style='background: none; border: none' class="rotate"><div><span>
                    <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/report/3/'>
                        <?php echo $_smarty_tpl->tpl_vars['project3Task']->value['name'];?>

                    </a>
                </span></div></th> 
<?php } ?>
            </tr>
<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->users; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['user']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
 $_smarty_tpl->tpl_vars['user']->index++;
?>
            <tr>
                <th>
                    <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserMonth/index/<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['report']->value->yearTo;?>
/<?php echo $_smarty_tpl->tpl_vars['report']->value->monthTo;?>
/'>
                        <?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>

                    </a>
                </th>
<?php  $_smarty_tpl->tpl_vars['dur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dur']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->leftTableContent[$_smarty_tpl->tpl_vars['user']->index]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dur']->key => $_smarty_tpl->tpl_vars['dur']->value) {
$_smarty_tpl->tpl_vars['dur']->_loop = true;
?>
                <td><?php if ($_smarty_tpl->tpl_vars['dur']->value) {
echo $_smarty_tpl->tpl_vars['dur']->value;?>
h<?php } else { ?>&nbsp;<?php }?></td>
<?php } ?>
<?php  $_smarty_tpl->tpl_vars['dur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dur']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->rightTableContent[$_smarty_tpl->tpl_vars['user']->index]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dur']->key => $_smarty_tpl->tpl_vars['dur']->value) {
$_smarty_tpl->tpl_vars['dur']->_loop = true;
?>
                <td><?php if ($_smarty_tpl->tpl_vars['dur']->value) {
echo $_smarty_tpl->tpl_vars['dur']->value;?>
h<?php } else { ?>&nbsp;<?php }?></td>
<?php } ?>
                <th><?php echo $_smarty_tpl->tpl_vars['report']->value->verticalTotals[$_smarty_tpl->tpl_vars['user']->index];?>
h</th>
            </tr>
<?php } ?>
            <tr>
                <td style='border: none'>&nbsp;</td>
<?php  $_smarty_tpl->tpl_vars['total'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['total']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->leftHorizontalTotals; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['total']->key => $_smarty_tpl->tpl_vars['total']->value) {
$_smarty_tpl->tpl_vars['total']->_loop = true;
?>
                <th><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
h</th>
<?php } ?>
<?php  $_smarty_tpl->tpl_vars['total'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['total']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['report']->value->rightHorizontalTotals; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['total']->key => $_smarty_tpl->tpl_vars['total']->value) {
$_smarty_tpl->tpl_vars['total']->_loop = true;
?>
                <th><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
h</th>
<?php } ?>
                <th><?php echo $_smarty_tpl->tpl_vars['report']->value->totalsTotals;?>
h</th>
            </tr>
        </table>
            <br><br>
                <div align='center'>
                    <h3>Wybierz okres:</h3>
<?php echo smarty_function_html_select_date(array('time'=>$_smarty_tpl->tpl_vars['report']->value->fromDateTime,'display_days'=>false,'start_year'=>'-5','end_year'=>'+5','month_format'=>'%m','year_extra'=>'id="fromYear"','month_extra'=>'id="fromMonth"'),$_smarty_tpl);?>
 - 
<?php echo smarty_function_html_select_date(array('time'=>$_smarty_tpl->tpl_vars['report']->value->toDateTime,'display_days'=>false,'start_year'=>'-5','end_year'=>'+5','month_format'=>'%m','year_extra'=>'id="toYear"','month_extra'=>'id="toMonth"'),$_smarty_tpl);?>

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
Users/report/"
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
