<!DOCTYPE html>
<html>
    <head>
        {block name=defines}{/block}
        <title>{block name=title}KPGeo - Rejestracja Czasu Pracy{/block}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src='{$SITE_URL}Includes/jquery.js'></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link rel='stylesheet' type='text/css' href='{$SITE_URL}Includes/base_style.css'>
        <link rel='stylesheet' type='text/css' href='{$SITE_URL}Includes/loading_indicator.css'>
        {block name=head}{/block}
    </head>
    <body>
        <div id='menu_div'>
            {block name=menu}
                <h3>{$user->firstName}<br>{$user->lastName}</h3>
                <a href='#' class='link_logout'>Wyloguj</a><br>
                <a href="{$SITE_URL}UserSettings/">Ustawienia</a>
                <br><br>
                <hr>
                <ul>
                    <li>
                        <a href='{$SITE_URL}UserMonth/'>Kalendarz użytkownika</a>
                    </li>
                    {if $user->isProjectManager() or $user->isCoordinator() or $user->accessLevel > 1}
                    <li>
                        <a href='{$SITE_URL}Projects/'>Projekty</a>
{if $user->accessLevel > 1}
                        <span class='badge' title='Do zamknięcia: {$projectsToSend}'>{$projectBadge}</span>
{/if}
{if $projectManagerBadges[$user->id]}
                        <span class='badge blue' title="{$projectsForManager[$user->id]}">{$projectManagerBadges[$user->id]}</span>
{/if}
{if $projectBadge2 && $user->accessLevel > 1}
                        <span class='badge green' title="Do zaakceptowania: {$projectsToAccept}">{$projectBadge2}</span>
{/if}
                    </li>
                    {/if}
                    {if $user->accessLevel > 1}
                        <ul>
                            <li>
                                <a href='{$SITE_URL}Projects/consReport/'>Raport zbiorczy</a>
                            </li>
                            <li>
                                <a href='{$SITE_URL}Projects/addForm/'>Dodaj projekt</a>
                            </li>
                            <li>
                            <a href='{$SITE_URL}ProjectTemplates/'>Szablony</a>
                            </li>
                        </ul>
                    <li>
                        <a href='{$SITE_URL}Users/'>Użytkownicy</a>
                    </li>
                    <ul>
                        <li>
                            <a href='{$SITE_URL}Users/report/'>Karta pracy</a>
                        </li>
                        <li>
                        <a href='{$SITE_URL}Users/report2/'>Nadgodziny</a>
                        </li>
                        <li>
                        <a href='{$SITE_URL}Users/leaves/'>Urlopy</a>
                        </li>
                        <li>
                            <a href='{$SITE_URL}Users/addUser/'>Dodaj użytkownika</a>
                        </li>
                    </ul>
                    {/if}
                </ul>
            {/block}
        </div>
        <div id='content_div' style="height: 100%;">
            {block name=content}{/block}
            <br><br><br><br><br><br>
            
        </div>
        <div class="spinner" hidden='hidden'>
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
        <script>
            $(document).bind("ajaxSend", function(){
                $(".spinner").show();
              }).bind("ajaxComplete", function(){
                $(".spinner").hide();
            });
            $(".link_logout").click( function(event) {
                event.preventDefault();
                $.get("{$SITE_URL}Login/logout/")
                    .done(function() {
                        alert('Wylogowano.');
                        document.location.replace("{$SITE_URL}");
                    });
            });

            $(".progress").click(function(){
                $(".progress_content").slideToggle();
            });
        </script>
    {block name='body_end'}{/block}
    </body>
</html>