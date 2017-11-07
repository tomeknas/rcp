<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-03 06:32:42
         compiled from "Views/users_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7485625355595f540e5c1d3-86751734%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68a2bd69a23871444f7e305457eb363a1b4edffb' => 
    array (
      0 => 'Views/users_add.tpl',
      1 => 1435894023,
      2 => 'file',
    ),
    'b6e50672c2c09029b21b01eda864187f23cf1d76' => 
    array (
      0 => 'Views/base_layout.tpl',
      1 => 1435897172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7485625355595f540e5c1d3-86751734',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5595f540f0bf65_74815497',
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
<?php if ($_valid && !is_callable('content_5595f540f0bf65_74815497')) {function content_5595f540f0bf65_74815497($_smarty_tpl) {?><!DOCTYPE html>
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
            
    <h2 align='center'>Nowy użytkownik</h2>
    <br><br>
    
    <form id='user-add-form' align='center'>
        <table class='gridtable centre'>
            <tr>
                <th>Imię</th>
                <td><input id="first-name-input" name='first_name' required></td>
            </tr>
            <tr>
                <th>Nazwisko</th>
                <td><input id="last-name-input" name='last_name'></td>
            </tr> 
            <tr>
                <th>Nazwa użytkownika</th>
                <td><input id="username-input" name='username'></td>
            </tr> 
            <tr>
                <th>Hasło</th>
                <td><input id="password-input" name='password'></td>
            </tr>    
            <tr>
                <th>Godzin dziennie</th>
                <td><input type="number" name='hours_daily' value="8"></td>
            </tr>
            <tr>
                <td style='border: none'>&nbsp;</td>
                <td><input type='submit' value='Dodaj użytkownika'></td>
            </tr>
        </table>
        
    </form>
 

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
        
    $( "#user-add-form" ).submit( function( event ){
        event.preventDefault();
        
        $.post( "<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/newUser/", $("#user-add-form").serialize() )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                alert(text);
                document.location.replace("<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Users/addUser");
            })
            ;
    });
    
        String.prototype.escapeDiacritics = function()
        {
            return this.replace(/ą/g, 'a').replace(/Ą/g, 'A')
                .replace(/ć/g, 'c').replace(/Ć/g, 'C')
                .replace(/ę/g, 'e').replace(/Ę/g, 'E')
                .replace(/ł/g, 'l').replace(/Ł/g, 'L')
                .replace(/ń/g, 'n').replace(/Ń/g, 'N')
                .replace(/ó/g, 'o').replace(/Ó/g, 'O')
                .replace(/ś/g, 's').replace(/Ś/g, 'S')
                .replace(/ż/g, 'z').replace(/Ż/g, 'Z')
                .replace(/ź/g, 'z').replace(/Ź/g, 'Z');
        };
        
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
        
        $(document).ready(function(){
            $("#password-input").val(generatePassword());
        });
        
        
        var firstName = "", lastName = "";
        
        $("#first-name-input, #last-name-input").keyup(function() {
            firstName = $("#first-name-input").val();
            lastName = $("#last-name-input").val();
            $("#username-input").val((firstName.substr(0, 1) + lastName).toLowerCase().escapeDiacritics());
        });
    <?php echo '</script'; ?>
>

    </body>
</html><?php }} ?>
