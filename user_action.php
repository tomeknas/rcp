<?php
include("header.php");
$ua = user_access();
($ua > 1) or die("Brak uprawnień.</br><a href=\"index.php\">Wróć</a>");




include("footer.php");
?>