{extends 'Views/base_layout.tpl'}
{block name='content'}
    <h2 align='center'>Nowy projekt</h2>
    <br><br>
    
    <form id='project_add_form' align='center'>
        <table class='gridtable centre'>
            <tr>
                <th>Nazwa projektu</th>
                <td><input name='name' required></td>
            </tr>
            <tr>
                <th>Opis</th>
                <td><input name='description'></td>
            </tr>
            <tr>
                <th>Grupa</th>
                <td>
                    <select name='group'>
{foreach $groupList as $group}
                        <option value='{$group->id}'>{$group->name}</option>
{/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <th>Numer zlecenia</th>
                <td><input name='order_number'></td>
            </tr>
            <tr>
                <th>Klient</th>
                <td><input name='client'></td>
            </tr>
            <tr>
                <th>Data rozpoczęcia</th>
                <td><input name='begin' type='date'></td>
            </tr>
            <tr>
                <th>Data zakończenia</th>
                <td><input name='end' type='date'></td>
            </tr>
            <tr>
                <th>Kierownik projektu</th>
                <td>
                    <select name='project_manager'>
{foreach $userList as $user}
                        <option value='{$user->id}'>{$user->getFullName()}</option>
{/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <th>Koordynator projektu</th>
                <td>
                    <select name='project_coordinator'>
{foreach $userList as $user}
                        <option value='{$user->id}'>{$user->getFullName()}</option>
{/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <th>Budżet (dni robocze)</th>
                <td><input name='budget' type='number' min='0'></td>
            </tr>
            <tr>
                <th>Budżet (zł)</th>
                <td><input name='budgetPLN' type='number' min='0'></td>
            </tr>
            <tr>
                <th>Budżet PM</th>
                <td><input name='budgetPM' type='number' min='0'></td>
            </tr>
            <tr>
                <th>Szablon</th>
                <td>
                    <select name='project_template'>
{foreach $templates as $template}
                        <option value='{$template->id}'>{$template->name}</option>
{/foreach}
                    </select>
                </td>
            </tr>        
            <tr>
                <td style='border: none'>&nbsp;</td>
                <td><input type='submit' value='Dodaj projekt'></td>
            </tr>
        </table>
        
    </form>
    
{/block}

{block name='body_end'}
<script>
    
    $( "#project_add_form" ).submit( function( event ){
        event.preventDefault();
        
        $.post( "{$SITE_URL}ProjectAction/add/", $("#project_add_form").serialize() )
            .fail(function(v1, v2, text) {
                alert(text);
            })
            .done(function(text){
                alert(text);
                document.location.replace("{$SITE_URL}Projects");
            })
            ;
    });
    
</script>
{/block}