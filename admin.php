<?php
include("header.php");
$ua = user_access();
($ua > 1) or die("Brak uprawnień.</br><a href=\"index.php\">Wróć</a>");
$alert = "";


///////////////////////////////////////

if($_GET['a'] == 'a')
{
	if($_GET['x'] == 'p')
	{
		mysql_query("INSERT INTO projects (nazwa, opis) VALUES ('" . $_POST['nazwa'] . "', '" . $_POST['opis'] . "')");
		$ql = mysql_query("SELECT LAST_INSERT_ID() as lastid");
		$rl = mysql_fetch_array($ql);
		$qq = mysql_query("SELECT nazwa FROM project_templates_data WHERE template_id = $_POST[szablon]");
		while ($rr = mysql_fetch_array($qq))
		{
			mysql_query("INSERT INTO tasks (project_id, nazwa) VALUES ($rl[lastid], '$rr[nazwa]')");
		}
		$alert =  "Projekt \"" . $_POST['nazwa'] . "\" dodany.";
	}

	if($_GET['x'] == 'u')
	{
		mysql_query("INSERT INTO users (nazwa, imie, nazwisko, haslo, perm)
				VALUES ('" . $_POST['login'] . "', '" . $_POST['imie'] . "', '" . $_POST['nazwisko'] . "', '" . $_POST['haslo'] . "', '" . $_POST['perm'] . "')");
		$alert = "Użytkownik \"" . $_POST['imie'] . " " . $_POST['nazwisko'] . "\" dodany.";
	}
}

if($_GET['a'] == 'd')
{
	if($_GET['x'] == 'p')
	{
		mysql_query("DELETE FROM projects WHERE id = " . $_GET['id'] . " LIMIT 1");
		mysql_query("DELETE FROM tasks WHERE project_id = $_GET[id]");
		$alert = "Projekt usunięto.";
	}
	
	if(($_GET['x'] == 'u') && ($ua > 2))
	{
		mysql_query("DELETE FROM users WHERE id = " . $_GET['id'] . " LIMIT 1");
		$alert = "Użytkownik skasowany.";
	}
}





///////////////////////////////////////


echo "<a href=\"login.php?l=o\">Wyloguj</a></br>";
echo "<h3>Pracownicy:</h3>";

$q = mysql_query("SELECT * FROM users ORDER BY nazwisko ASC, imie ASC");
while($row = mysql_fetch_array($q))
{
	echo "<a href=\"user.php?u=".$row['id']."\">".$row['nazwisko']." ".$row['imie']."</a>";
	
	if($row['perm'] < 3) echo "&nbsp&nbsp&nbsp<a href=\"admin.php?x=u&a=d&id=".$row['id']."\">x</a>";
	
	echo "</br>";
}
echo "</br>Dodaj pracownika:</br>";
echo "<form action=\"admin.php?x=u&a=a\" method=\"post\">";
echo "Imię: <input type=\"text\" name=\"imie\"> Nazwisko: <input type=\"text\" name=\"nazwisko\"></br>
	Login: <input type=\"text\" name=\"login\"> Hasło: <input type=\"text\" name=\"haslo\"></br>
	<select name=\"perm\"><option value=\"1\">Użytkownik</option>";
if($ua > 2) echo "<option value=\"2\">Administrator</option>";
echo "</select><input type=\"submit\" value=\"Dodaj\"></form></br>";


echo "<h3>Projekty:</h3>";

$projs = array();
$proj_q = mysql_query("SELECT * FROM projects");
while($proj_row = mysql_fetch_array($proj_q))
{
	$projs[$proj_row['id']]['id'] = $proj_row['id'];
	$projs[$proj_row['id']]['name'] = $proj_row['nazwa'];
	$projs[$proj_row['id']]['tasks'] = array();
}

$task_q = mysql_query("SELECT * FROM tasks");
while($task_row = mysql_fetch_array($task_q))
{
	$projs[$task_row['project_id']]['tasks'][$task_row['id']]['id'] = $task_row['id'];
	$projs[$task_row['project_id']]['tasks'][$task_row['id']]['name'] = $task_row['nazwa'];
}

foreach($projs as $proj)
{
	echo "<a href=\"project_page.php?id=$proj[id]\">$proj[name]</a>" . "&nbsp&nbsp&nbsp <a href=\"admin.php?x=p&a=d&id=" . $proj['id'] . "\">x</a></br>";
	foreach($proj['tasks'] as $task)
	{
		//echo "..... " . $task['name'] . "</br>";
	}
	//echo "</br>";
}

echo "</br>Dodaj projekt:</br>
	<form action=\"admin.php?x=p&a=a\" method=\"post\">
	Nazwa projektu: <input type=\"text\" name=\"nazwa\">
	Opis projektu: <input type=\"text\" name=\"opis\">
	Szablon: <select name=\"szablon\">";

$qq = mysql_query("SELECT id, nazwa FROM project_templates");
while($rr = mysql_fetch_array($qq))
	echo "<option value=$rr[id]>$rr[nazwa]</option>";
	
echo "</select> <input type=\"Submit\" value=\"Dodaj projekt\"></form>";



if ($alert) 
	echo "<script type=\"text/javascript\">alert('$alert');</script>";

include("footer.php");
?>















