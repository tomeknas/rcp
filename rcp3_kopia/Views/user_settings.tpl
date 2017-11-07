{extends 'Views/base_layout.tpl'}

{* Just before </head> *}
{block name="head"}
    
{/block}

{* Inside content div *}
{block name="content"}
<div style="padding: 50px">
    <h2>Ustawienia użytkownika</h2>
    <button id="password-change-button">Zmiana hasła</button>
</div>
{/block}

{* Just before </body> *}
{block name="body_end"}
<script>
    
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
        $.post('{$SITE_URL}UserSettings/passwordChange/', { "new_password" : newPassword })
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text) {
                alert("Hasło zostało zmienione. Zaloguj się ponownie.");
                $(".link_logout").click();
            });
    });
</script>
{/block}