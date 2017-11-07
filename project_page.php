<?php
include("header.php");
$ua = user_access();
($ua > 1) or die("Brak uprawnień.</br><a href=\"index.php\">Wróć</a>");

$pid = $_GET['id'];
$alert = "";
if($_GET['a'] == 'u' && $pid)
{
	mysql_query("UPDATE projects
				SET nazwa='$_POST[nazwa]', opis='$_POST[opis]', nr_zlecenia='$_POST[nr_zlecenia]', klient='$_POST[klient]',
					data_roz='$_POST[data_roz]', data_zak='$_POST[data_zak]', kierownik_id='$_POST[kierownik_id]'
				WHERE id=$pid"); 
	$alert = "Zapisano zmiany";
}
if($_GET['a'] == 't' && $pid)
{
	if($_POST['delete'] == 'd')
	{
		mysql_query("DELETE FROM tasks WHERE id = $_POST[task_id] LIMIT 1");
		$alert = "Usunięto zadanie";
	} else
	{
		mysql_query("UPDATE tasks SET nazwa='$_POST[task_name]' WHERE id = $_POST[task_id] LIMIT 1");
		$alert = "Zmieniono nazwę";
	}
}
if($_GET['a'] == 'a' && $pid)
{
	mysql_query("INSERT INTO tasks (project_id, nazwa) VALUES ($pid, '$_POST[task_name]')");
	$alert = "Dodano zadanie";
}
		



echo "<a href=\"admin.php\">Wróć</a></br></br>";

//$q = mysql_query("SELECT nazwa, opis FROM projects WHERE id = $pid LIMIT 1");
$q = mysql_query("SELECT pr.nazwa, pr.opis, pr.nr_zlecenia, pr.klient, pr.data_roz, pr.data_zak, pr.kierownik_id, sum(timestampdiff(MINUTE, ut.start, ut.stop)/60) AS suma
					FROM projects pr, user_tasks ut, tasks ta
					WHERE pr.id = ta.project_id AND ut.task_id = ta.id AND pr.id = $pid");
$row = mysql_fetch_array($q);
//echo "<h1>$row[nazwa]</h1><h2>$row[opis]</h2><h3>Suma: ".(float)$row['suma']."h</h3></br>";

echo "<form method=post action=project_page.php?a=u&id=$pid><table>
	<tr><th>Nazwa projektu</th><td><input size=50 name=nazwa value=\"$row[nazwa]\" /></td></tr>
	<tr><th>Opis projektu</th><td><input size=50 name=opis value=\"$row[opis]\" /></td></tr>
	<tr><th>Numer zlecenia</th><td><input size=50 name=nr_zlecenia value=\"$row[nr_zlecenia]\" /></td></tr>
	<tr><th>Klient</th><td><input size=50 name=klient value=\"$row[klient]\" /></td></tr>
	<tr><th>Data rozpoczęcia</th><td><input name=data_roz type=date value=\"$row[data_roz]\" /></td></tr>
	<tr><th>Data zakończenia</th><td><input name=data_zak type=date value=\"$row[data_zak]\" /></td></tr>
	<tr><th>Kierownik projektu</th><td><select name=kierownik_id>";
	
$qq = mysql_query("SELECT id, imie, nazwisko FROM users ORDER BY nazwisko ASC");
while ($rr = mysql_fetch_array($qq))
{
	echo "<option value=$rr[id]";
	if ($rr['id'] == $row['kierownik_id']) echo " selected";
	echo ">$rr[imie] $rr[nazwisko]</option>";
}
echo "</select></td></tr></table><input type=submit value=\"Zapisz zmiany\" /></form>";
	

/*$q0 = mysql_query("SELECT us.id, us.imie, us.nazwisko
				FROM users us, user_tasks ut, tasks ta
				WHERE ta.project_id = $pid AND ut.task_id = ta.id AND ut.user_id = us.id
				GROUP BY ut.user_id");
while($r0 = mysql_fetch_array($q0))
	echo "$r0[imie] $r0[nazwisko], ";
	
$q1 = mysql_query("SELECT id, nazwa, opis FROM tasks WHERE project_id = $pid");
$q1 = mysql_query("SELECT ta.id, ta.nazwa, SUM(timestampdiff(MINUTE, ut.start, ut.stop)/60) AS suma
			FROM projects pr, user_tasks ut, tasks ta
			WHERE pr.id = ta.project_id AND ut.task_id = ta.id AND pr.id = $pid
			GROUP BY ta.id");

while($r1 = mysql_fetch_array($q1))
{
	echo "<h3>$r1[1] - $r1[2]</h3>";
	$q2 = mysql_query("SELECT us.imie, us.nazwisko, sum(timestampdiff(MINUTE, ut.start, ut.stop)/60) AS suma, us.id
		FROM user_tasks ut, users us
		WHERE ut.task_id = $r1[id] AND us.id = ut.user_id
		GROUP BY us.id");
	$counter = 0;
	while($r2 = mysql_fetch_array($q2))
	{
		echo " -- <a href=\"user.php?u=$r2[3]\">$r2[0] $r2[1]</a> - ".(float)$r2[2]."h</br>";
		$counter += $r2[2];
	}
	echo "suma: $counter"."h</br>";
}
*/


$tasks = array();
$users = array();

$qt = mysql_query("SELECT id, nazwa FROM tasks WHERE project_id = $pid");
while ($rt = mysql_fetch_array($qt))
	$tasks[] = array( 'id' => $rt['id'], 'nazwa' => $rt['nazwa']);

$qu = mysql_query("SELECT us.id, CONCAT_WS(' ', us.imie, us.nazwisko) AS nazwa
FROM users us, user_tasks ut, tasks ta
WHERE us.id = ut.user_id AND ut.task_id = ta.id AND ta.project_id = $pid
GROUP BY us.id");
while ($ru = mysql_fetch_array($qu))
	$users[] = array( 'id' => $ru['id'], 'nazwa' => $ru['nazwa']);

echo "<table><tr><th></th>";
foreach($users as $user)
	echo "<th><a href=\"user.php?u=$user[id]\">$user[nazwa]</a></th>";
echo "<th>SUMA</th></tr>";

foreach ($tasks as $task)
{
	if($_GET['e'] == 'e')
	{
		echo "<tr><td><form method=post action=project_page.php?id=$pid&a=t>
		<input name=task_name value=\"$task[nazwa]\" /></br>
		<input type=checkbox name=delete value=d> Usuń zadanie
		<input type=hidden name=task_id value=$task[id] /><input type=submit hidden /></form></td>";
	}
	else echo "<tr><th>$task[nazwa]</th>";
	foreach ($users as $user)
	{
		$qq = mysql_query("SELECT sum(timestampdiff(MINUTE, ut.start, ut.stop)/60) AS suma
							FROM user_tasks ut
							WHERE ut.task_id = $task[id] AND ut.user_id = $user[id]");
		$rr = mysql_fetch_array($qq);
		echo "<td align=center>".(float)$rr['suma']."h</td>";
	}
	$qq = mysql_query("SELECT sum(timestampdiff(MINUTE, ut.start, ut.stop)/60) AS suma
						FROM user_tasks ut
						WHERE ut.task_id = $task[id]");
	$rr = mysql_fetch_array($qq);
	echo "<th>".(float)$rr['suma']."h</th>";
}
echo "<tr><th>SUMA</th>";
foreach ($users as $user)
{
	$qq = mysql_query("SELECT sum(timestampdiff(MINUTE, ut.start, ut.stop)/60) AS suma
					FROM user_tasks ut, tasks ta
					WHERE ut.task_id = ta.id AND ta.project_id = $pid AND ut.user_id = $user[id]");
	$rr = mysql_fetch_array($qq);
	echo "<th>".(float)$rr['suma']."h</th>";
}
$qq = mysql_query("SELECT sum(timestampdiff(MINUTE, ut.start, ut.stop)/60) AS suma
				FROM user_tasks ut, tasks ta
				WHERE ut.task_id = ta.id AND ta.project_id = $pid");
$rr = mysql_fetch_array($qq);
echo "<th>".(float)$rr['suma']."h</th></tr></table>";
	

if ($_GET['e'] != 'e') echo "<a href=\"project_page.php?id=$pid&e=e\">Edytuj zadania</a>";
else
	echo "</br><form method=post action=project_page.php?id=$pid&a=a&e=e><input name=task_name /> <input type=submit value=\"Dodaj zadanie\" /></form></br>
	<a href=\"project_page.php?id=$pid\">Zakończ edycję</a>";







if ($alert) 
	echo "<script type=\"text/javascript\">alert('$alert');</script>";
include("footer.php");
?>