<?php
include("header.php");
$ua = user_access();
($ua > 1) or die("Brak uprawnień.</br><a href=\"index.php\">Wróć</a>");

if($_GET['a'] == 'a')
{
	if($_GET['x'] == 'p')
	{
		mysql_query("INSERT INTO projects (nazwa, opis) VALUES ('" . $_POST['nazwa'] . "', '" . $_POST['opis'] . "')");
		echo "Projekt \"" . $_POST['nazwa'] . "\" dodany.</br>";
	}
	if($_GET['x'] == 't')
	{
		mysql_query("INSERT INTO tasks (project_id, nazwa, opis) VALUES ('" . $_POST['project_id'] . "', '" . $_POST['nazwa'] . "', '" . $_POST['opis'] . "')");
		echo "Zadanie \"" . $_POST['nazwa'] . "\" dodane.</br>";
	}
	if($_GET['x'] == 'u')
	{
		mysql_query("INSERT INTO users (nazwa, imie, nazwisko, haslo, perm)
				VALUES ('" . $_POST['login'] . "', '" . $_POST['imie'] . "', '" . $_POST['nazwisko'] . "', '" . $_POST['haslo'] . "', '" . $_POST['perm'] . "')");
		echo "Użytkownik \"" . $_POST['imie'] . " " . $_POST['nazwisko'] . "\" dodany.</br>";
	}
}

if($_GET['a'] == 'd')
{
	if($_GET['x'] == 'p')
	{
		mysql_query("DELETE FROM projects WHERE id = " . $_GET['id'] . " LIMIT 1");
		echo "Projekt usunięto.</br>";
	}
	if($_GET['x'] == 't')
	{
		mysql_query("DELETE FROM tasks WHERE id = " . $_GET['id'] . " LIMIT 1");
		echo "Zadanie usunięto.</br>";
	}
	if(($_GET['x'] == 'u') && ($ua > 2))
	{
		mysql_query("DELETE FROM users WHERE id = " . $_GET['id'] . " LIMIT 1");
		echo "Użytkownik skasowany.</br>";
	}
}


echo "<a href=\"admin.php\">Wróć</a></br>";
include("footer.php");
?>