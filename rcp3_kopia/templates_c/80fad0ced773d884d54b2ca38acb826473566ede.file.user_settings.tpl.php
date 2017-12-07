<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-12-06 15:20:39
         compiled from "Views\user_settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24215a27fcb77f1717-82390810%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80fad0ced773d884d54b2ca38acb826473566ede' => 
    array (
      0 => 'Views\\user_settings.tpl',
      1 => 1509805532,
      2 => 'file',
    ),
    'cf5d031d7811abe143b2a675129cecdef724eadb' => 
    array (
      0 => 'Views\\base_layout.tpl',
      1 => 1512570030,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24215a27fcb77f1717-82390810',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SITE_URL' => 0,
    'user' => 0,
    'projectsToSend' => 0,
    'projectBadge' => 0,
    'projectManagerBadges' => 0,
    'projectsForManager' => 0,
    'projectCoordinator' => 0,
    'projectsForCoordinator' => 0,
    'projectBadge2' => 0,
    'projectsToAccept' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a27fcb7a97677_19850644',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a27fcb7a97677_19850644')) {function content_5a27fcb7a97677_19850644($_smarty_tpl) {?><!DOCTYPE html>
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
                    <?php if ($_smarty_tpl->tpl_vars['user']->value->isProjectManager()||$_smarty_tpl->tpl_vars['user']->value->isCoordinator()||$_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                    <li>
                        <a href='<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Projects/'>Projekty</a>
<?php if ($_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                        <span class='badge' title='Do zamknięcia: <?php echo $_smarty_tpl->tpl_vars['projectsToSend']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['projectBadge']->value;?>
</span>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['projectManagerBadges']->value[$_smarty_tpl->tpl_vars['user']->value->id]) {?>
                        <span class='badge blue' title="<?php echo $_smarty_tpl->tpl_vars['projectsForManager']->value[$_smarty_tpl->tpl_vars['user']->value->id];?>
"><?php echo $_smarty_tpl->tpl_vars['projectManagerBadges']->value[$_smarty_tpl->tpl_vars['user']->value->id];?>
</span>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['projectCoordinator']->value[$_smarty_tpl->tpl_vars['user']->value->id]) {?>
                        <span class='badge blue' title="<?php echo $_smarty_tpl->tpl_vars['projectsForCoordinator']->value[$_smarty_tpl->tpl_vars['user']->value->id];?>
"><?php echo $_smarty_tpl->tpl_vars['projectCoordinator']->value[$_smarty_tpl->tpl_vars['user']->value->id];?>
</span>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['projectBadge2']->value&&$_smarty_tpl->tpl_vars['user']->value->accessLevel>1) {?>
                        <span class='badge green' title="Do zaakceptowania: <?php echo $_smarty_tpl->tpl_vars['projectsToAccept']->value;?>
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
            
<div style="padding: 50px">
    <h2>Ustawienia użytkownika</h2>
    <button id="password-change-button">Zmiana hasła</button>
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
    
    function generatePassword() {
        var vov = "aeiouy";
        var con = "rwtpsdfghjklzcbnm";
        var result = "";
        for (var i = 0; i < 3; ++i) {
            result += con[Math.floor((Math.random() * 17))];
            result += vov[Math.floor((Math.random() * 6))];
        }
        result += con[Math.floor((Math.random() * 17))];
        return result;
    }
    
    $("#password-change-button").click(function() {
        var newPassword, newPasswordOk = false, newPasswordAgain;
        
        do {
            newPassword = prompt("Podaj nowe hasło", generatePassword());
            if (newPassword === null) {
                return;
            }
            if (newPassword.length < 5) {
                alert("Haslo jest za krótkie");
                continue;
            }
            newPasswordOk = true;
        } while (!newPasswordOk);
        newPasswordAgain = prompt("Powtórz nowe hasło");
        if (newPasswordAgain === null) {
            return;
        }
        if (newPassword !== newPasswordAgain) {
            alert("Podane hasła różnią się od siebie. Spróbuj ponownie.");
            return;
        }
        $.post('<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
UserSettings/passwordChange/', { "new_password" : newPassword })
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text) {
                alert("Hasło zostało zmienione. Zaloguj się ponownie.");
                $(".link_logout").click();
            });
    });
<?php echo '</script'; ?>
>

    </body>
</html><?php }} ?>
