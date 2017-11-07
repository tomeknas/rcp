<?php
include("header.php");
$ua = user_access();
$ua or die("Brak uprawnień.</br><a href=\"index.php\">Wróć</a>");


if( ($_GET['u'] != $_SESSION['id']) && ($ua > 1) )
{
	$admin_mode = 1;
	$user = user_get($_GET['u']);
}
else
{
	$admin_mode = 0;
	$user = user_get($_SESSION['id']);
}

if($_GET['a'] == 'a')
{
	$task_day = $_POST['dzien'];
	$task_start = $_POST['start'];
	$task_stop = $_POST['stop'];
	if ($task_day && $task_start && $task_stop )
	{
		mysql_query("
			INSERT INTO user_tasks
			(user_id, task_id, start, stop, komentarz)
			VALUES (
				'".$user['id']."',
				'".$_POST['task_id']."',
				FROM_UNIXTIME('".strtotime($task_day.'T'.$task_start)."'),
				FROM_UNIXTIME('".strtotime($task_day.'T'.$task_stop)."'),
				'".$_POST['komentarz']."'
				)
		");
		echo "Wpis dodano.</br>";
	} else echo "Błąd.</br>";
}

if($_GET['a'] == 'd' && ctype_digit($_GET['id']))
{
	mysql_query("
		DELETE FROM user_tasks WHERE id = " . $_GET['id'] . " AND user_id = " . $user['id'] . " LIMIT 1 ");
	echo "Wpis usunięto.</br>";
}

if($admin_mode)
	echo "</br><a href=\"user.php?u=".$user['id']."\">Wróć</a></br>";
else
	echo "</br><a href=\"user.php\">Wróć</a></br>";

include("footer.php");
?>