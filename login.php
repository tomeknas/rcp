<?php
include("header.php");

if(($_GET['l'] == 'i'))
{
	$q = mysql_query("SELECT * FROM users");
	$a = 0;
	$login = $_POST['login'];
	$haslo = $_POST['haslo'];
	while(!$a && $row = mysql_fetch_array($q))
		($row['nazwa'] == $login) && ($haslo == $row['haslo']) && $a++;
	if($a)
	{
		$_SESSION['id'] = $row['id'];
	}
	else
	{
		$_SESSION = array();
		session_destroy();
	}
}

if($_GET['l'] == 'o')
{
	$_SESSION = array();
	session_destroy();
}

if($ua = user_access())
{	
	$user = user_get($_SESSION['id']);
	echo $user['imie'] . " " . $user['nazwisko'];
	echo " zalogowan";
	if(substr($user['imie'], -1) == 'a')
		echo "a";
	else
		echo "y";
	echo ".</br>";
	echo "<a href=\"user.php\">Konto</a></br>";
	if($ua > 1)
		echo "<a href=\"admin.php\">Panel Administratora</a></br>";
}
else
{
	echo "Niezalogowany<br><a href=\"index.php\">Wróć</a>";
}



include("footer.php");
?>