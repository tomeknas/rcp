<html>
    <head>
        <title>KPGeo - rejestracja czasu pracy</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link rel="stylesheet" type="text/css" href="Includes/style_login.css">
        <script src="Includes/jquery.js"></script>
        <script src="Includes/placeholder.js"></script>
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
        
        <script>
        $("#slick-login").submit(function(event) {
            event.preventDefault();
            $.post("{$SITE_URL}Login/login/", $("#slick-login").serialize())
                .done(function(data) {
                    alert(data);
                    document.location.reload();
                })
                .fail(function(v1, v2, data) {
                    var text = $.parseJSON(data);
                    alert(text);
                });
        });
        </script>
    </body>
</html>