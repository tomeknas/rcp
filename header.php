<?php
include("definicje.php");
mysql_connect($baza['host'], $baza['user'], $baza['pass']) or die("nie ok");
mysql_select_db($baza['db']);
mysql_query("SET NAMES utf8");
session_start();
function user_access()
{
		if(isset($_SESSION['id']))
		{
			$row = mysql_fetch_array(mysql_query("SELECT perm FROM users WHERE id = ".$_SESSION['id']." LIMIT 1"));
			return $row['perm'];
		}
		return 0;
}
function user_get($user_id)
{
	$q = mysql_query("SELECT * FROM users WHERE id = ".$user_id." LIMIT 1");
	return mysql_fetch_array($q);
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<style type="text/css">
table, th, td {
	border: 1px solid black;
	border-collapse: collapse;}
th, td {
	padding: 4px }
	
	
tr.border_all {
  border: 3px solid;
}
	
tr.border_top {
  border-top: 3px solid;
  border-left: 3px solid;
  border-right: 3px solid;
}
	
tr.border_middle {
  border-left: 3px solid;
  border-right: 3px solid;
}	
	
tr.border_bottom {
  border-bottom: 3px solid;
  border-left: 3px solid;
  border-right: 3px solid;
}
</style>
</head>
<body>