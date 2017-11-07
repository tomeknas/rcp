<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-04 22:59:27
         compiled from "Views\login_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3174359fe2f573fb5b1-48909616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9acfc539e75258162ae44eb17a1c0f71a435dab2' => 
    array (
      0 => 'Views\\login_page.tpl',
      1 => 1509832760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3174359fe2f573fb5b1-48909616',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59fe2f5872ae85_81626447',
  'variables' => 
  array (
    'SITE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59fe2f5872ae85_81626447')) {function content_59fe2f5872ae85_81626447($_smarty_tpl) {?><html>
    <head>
        <title>KPGeo - rejestracja czasu pracy</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link rel="stylesheet" type="text/css" href="Includes/style_login.css">
        <?php echo '<script'; ?>
 src="Includes/jquery.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="Includes/placeholder.js"><?php echo '</script'; ?>
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
