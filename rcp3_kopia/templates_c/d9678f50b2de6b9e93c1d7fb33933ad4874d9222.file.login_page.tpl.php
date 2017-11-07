<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-01-08 14:34:43
         compiled from "Views/login_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:770985025499d57b837a67-65575150%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9678f50b2de6b9e93c1d7fb33933ad4874d9222' => 
    array (
      0 => 'Views/login_page.tpl',
      1 => 1420710811,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '770985025499d57b837a67-65575150',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5499d57b8514b8_74064918',
  'variables' => 
  array (
    'SITE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5499d57b8514b8_74064918')) {function content_5499d57b8514b8_74064918($_smarty_tpl) {?><html>
    <head>
        <title>KPGeo - rejestracja czasu pracy</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/style_login.css">
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/jquery.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Includes/placeholder.js"><?php echo '</script'; ?>
>
    </head>
    <body>
        
        <form id="slick-login">
            <label for="user_name">
                Nazwa użytkownika:
            </label>
            <input type="text" name="user_name" class="placeholder" placeholder="Nazwa użytkownika" />
            <label for="password">
                Hasło:
            </label>
            <input type="password" name="password" class="placeholder" placeholder="Hasło" />
            <input type="submit" value="Zaloguj" />
        </form>
        
        <?php echo '<script'; ?>
>
        $("#slick-login").submit(function(event) {
            event.preventDefault();
            $.post("<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
Login/login/", $("#slick-login").serialize())
                .done(function(data) {
                    alert(data);
                    document.location.reload();
                })
                .fail(function(v1, v2, data) {
                    var text = $.parseJSON(data);
                    alert(text);
                });
        });
        <?php echo '</script'; ?>
>
    </body>
</html><?php }} ?>
