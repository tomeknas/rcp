{extends 'Views/base_layout.tpl'}

{* Just before </head> *}
{block name="head"}
    
{/block}

{* Inside content div *}
{block name="content"}
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
 
{/block}

{* Just before </body> *}
{block name="body_end"}
    <script>
        
    $( "#user-add-form" ).submit( function( event ){
        event.preventDefault();
        
        $.post( "{$SITE_URL}Users/newUser/", $("#user-add-form").serialize() )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                alert(text);
                document.location.replace("{$SITE_URL}Users/addUser");
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
    </script>
{/block}