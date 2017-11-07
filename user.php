<?php
include("header.php");
$ua = user_access();
$ua or die("Brak uprawnień.</br><a href=\"index.php\">Wróć</a>");
$alert = "";
function dzien_wolny($dzi, $mie, $rok)
{
	$hol=array('01-01', '01-06', '05-01','05-03','08-15','11-01','11-11','12-25','12-26'); 
	$dodatkowo_wolne = array('2014-11-10');
	
	$data = new DateTime();
	$data->setDate($rok, $mie, $dzi);
	
	if( in_array($data->format('Y-m-d'), $dodatkowo_wolne ) )
		return 2;
	
	$easter = date('m-d', easter_date($rok));  
	$date = strtotime($rok . '-' . $easter);  
	$easterSec = date('m-d', strtotime('+1 day', $date));  
	$cc = date('m-d', strtotime('+60 days', $date));  
	$hol[] = $easter;  
	$hol[] = $easterSec;  
	$hol[] = $cc; 
	$md = $data->format('m-d');
	$dw = $data->format('w');
	if ( ($dw == 0) || ($dw == 6) || in_array($md, $hol) )
		return 1;
	return 0;
}

if(($ua > 1) && isset($_GET['u']))
{
	$admin_mode = 1;
	$user = user_get($_GET['u']);
}
else
{
	$admin_mode = 0;
	$user = user_get($_SESSION['id']);
}


/////////////////////////

if($_GET['a'] == 'a')
{
	$task_day = $_POST['dzien'];
	$task_start = $_POST['start'];
	$task_stop = $_POST['stop'];
	$task_id = $_POST['task_id'];
	if ($task_day && $task_start && $task_stop && ($task_id > 0) )
	{
		$datetime_start = strtotime($task_day.'T'.$task_start);
		if(strtotime($task_start) >= strtotime($task_stop))
			$datetime_stop = strtotime($task_day.'T'.$task_stop.' +1 day');
		else
			$datetime_stop = strtotime($task_day.'T'.$task_stop);
		
		//echo "$datetime_start | $datetime_stop</br>";
		
		$collision_check = mysql_query("
			SELECT id
			FROM user_tasks
			WHERE
				user_id = $user[id]
				AND stop > FROM_UNIXTIME($datetime_start)
				AND start < FROM_UNIXTIME($datetime_stop)
			LIMIT 1");
			
		if (mysql_num_rows($collision_check))
		{
			$alert = "Błąd: kolizja wpisów";
		}
		else /* no collision : dodaj wpis*/
		{
			mysql_query("
				INSERT INTO user_tasks
				(user_id, task_id, start, stop, komentarz)
				VALUES (
					'".$user['id']."',
					'".$task_id."',
					FROM_UNIXTIME('".$datetime_start."'),
					FROM_UNIXTIME('".$datetime_stop."'),
					'".$_POST['komentarz']."'
					)
			");
			$alert = "Wpis dodano";
		}
	} else $alert = "Błąd";
}

if($_GET['a'] == 'u' && ctype_digit($_GET['id']))
{
	$task_day = substr($_POST['start'], 0, 10);
	$task_start = substr($_POST['start'], 11, 5);
	$task_stop = $_POST['stop'];
	if ($task_day && $task_start && $task_stop)
	{
		$datetime_start = date('Y-m-d H:i:s', strtotime($task_day.'T'.$task_start));
		if(strtotime($task_start) >= strtotime($task_stop))
			$datetime_stop = date('Y-m-d H:i:s', strtotime($task_day.'T'.$task_stop.' +1 day'));
		else
			$datetime_stop = date('Y-m-d H:i:s', strtotime($task_day.'T'.$task_stop));
		mysql_query("
			UPDATE	user_tasks
			SET
				start		= '$datetime_start',
				stop		= '$datetime_stop',
				komentarz	= '$_POST[komentarz]'
			WHERE	id = $_GET[id]
			LIMIT 1
		");
		$alert = "Zmieniono wpis";
	} else $alert = "Błąd";
}


if($_GET['a'] == 'd' && ctype_digit($_GET['id']))
{
	mysql_query("
		DELETE FROM user_tasks WHERE id = " . $_GET['id'] . " AND user_id = " . $user['id'] . " LIMIT 1 ");
	$alert = "Wpis usunięto";
}



/////////////////////////


if($admin_mode)
	echo "<a href=\"admin.php\">Wróć</a></br>";
else
	echo "<a href=\"login.php?l=o\">Wyloguj</a></br>";


echo "<h1>".$user['imie'] . " " . $user['nazwisko'] . "</h1>"; // TODO: zrobić z tego <select> z linkami do innych profili

//nowy wpis
$projs = array();
$proj_q = mysql_query("SELECT * FROM projects");
while($proj_row = mysql_fetch_array($proj_q))
{
	$projs[$proj_row['id']]['name'] = $proj_row['nazwa'];
	$projs[$proj_row['id']]['desc'] = $proj_row['opis'];
	$projs[$proj_row['id']]['count'] = 0;
	$projs[$proj_row['id']]['tasks'] = array();
}

$task_q = mysql_query("SELECT * FROM tasks");
while($task_row = mysql_fetch_array($task_q))
{
	$projs[$task_row['project_id']]['tasks'][$task_row['id']]['id'] = $task_row['id'];
	$projs[$task_row['project_id']]['tasks'][$task_row['id']]['name'] = $task_row['nazwa'];
	$projs[$task_row['project_id']]['tasks'][$task_row['id']]['desc'] = $task_row['opis'];
	$projs[$task_row['project_id']]['tasks'][$task_row['id']]['count'] = 0;
}




//kalendarz
($miesiac = $_GET['m']) or ($miesiac = date("n"));
($rok = $_GET['y']) or ($rok = date("Y"));
$next_m = (($miesiac + 1) % 12); $next_m or ($next_m=12);
$prev_m = (($miesiac - 1) % 12); $prev_m or ($prev_m=12);
$next_y = $rok; ($next_m == 1) and $next_y++;
$prev_y = $rok; ($prev_m == 12) and $prev_y--;

$nazwy_miesiecy = array(0, 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień' );

echo "<h3><a href=\"user.php?y=$prev_y&m=$prev_m&u=$user[id]\"><<</a> $nazwy_miesiecy[$miesiac] $rok <a href=\"user.php?y=$next_y&m=$next_m&u=$user[id]\">>></a></h3>";


$q = mysql_query("SELECT pr.nazwa, ta.nazwa, ut.task_id, ut.start, ut.stop, ut.komentarz, ut.id, TIMESTAMPDIFF(MINUTE, ut.start, ut.stop)/60 AS diff,
					DAY(ut.start) AS dzien, DATE_FORMAT(ut.start, '%H:%i') AS starttime, DATE_FORMAT(ut.stop, '%H:%i') AS stoptime
	FROM projects pr, tasks ta, user_tasks ut
	WHERE pr.id = ta.project_id AND ut.task_id = ta.id AND ut.user_id = ". $user['id']. " AND MONTH(ut.start) = $miesiac AND YEAR(ut.start) = $rok
	ORDER BY ut.start ASC");

$dni = cal_days_in_month(1, $miesiac, $rok);

$kal = array();
for($i = 1; $i <= $dni; $i++)
{
	$kal[$i]['tasks'] = array();
	$kal[$i]['count'] = 0;
	$kal[$i]['rows'] = 0;
	$kal[$i]['suma_sofar'] = 0;
}
$suma_w_miesiacu = 0;
while($row = mysql_fetch_array($q))
{
	$kal[$row['dzien']]['tasks'][$row[6]]['nazwa'] = $row[0] ." - ". $row[1];
	$kal[$row['dzien']]['tasks'][$row[6]]['start_full'] = $row[3];
	$kal[$row['dzien']]['tasks'][$row[6]]['start_full'][10] = 'T';
	$kal[$row['dzien']]['tasks'][$row[6]]['start'] = $row['starttime'];
	$kal[$row['dzien']]['tasks'][$row[6]]['stop'] = $row['stoptime'];
	$kal[$row['dzien']]['tasks'][$row[6]]['ile'] = $row[7];
	$kal[$row['dzien']]['tasks'][$row[6]]['komentarz'] = $row['komentarz'];
	$kal[$row['dzien']]['count'] += $row[7];
	$suma_w_miesiacu += $row[7];
	$kal[$row['dzien']]['suma_sofar'] = $suma_w_miesiacu;
	$kal[$row['dzien']]['rows']++;
}

////////////////////////////// first row - form
?>
<script language="JavaScript" type="text/javascript">
<!--

<?php
$i1=0;
foreach($projs as $proj)
{
	$i1++;
	$i2 = 0;
	echo "data_$i1 = new Option(\"$proj[name]\", \"0\");\n";
	foreach($proj['tasks'] as $task)
	{
		$i2++;
		echo "data_$i1"."_$i2 = new Option(\"$task[name]\", \"$task[id]\");\n";
	}
}
?>
    displaywhenempty=""
    valuewhenempty=0

    displaywhennotempty="-wybierz zadanie-"
    valuewhennotempty=0

function change(currentbox) {
	numb = currentbox.id.split("_");
	currentbox = numb[1];

    i=parseInt(currentbox)+1

    while ((eval("typeof(document.getElementById(\"combo_"+i+"\"))!='undefined'")) &&
           (document.getElementById("combo_"+i)!=null)) {
         son = document.getElementById("combo_"+i);
	     // I empty all options except the first one (it isn't allowed)
	     for (m=son.options.length-1;m>0;m--) son.options[m]=null;
	     // I reset the first option
	     son.options[0]=new Option(displaywhenempty,valuewhenempty)
	     i=i+1
    }
	
    stringa='data'
    i=0
    while ((eval("typeof(document.getElementById(\"combo_"+i+"\"))!='undefined'")) &&
           (document.getElementById("combo_"+i)!=null)) {
           eval("stringa=stringa+'_'+document.getElementById(\"combo_"+i+"\").selectedIndex")
           if (i==currentbox) break;
           i=i+1
    }

	following=parseInt(currentbox)+1

    if ((eval("typeof(document.getElementById(\"combo_"+following+"\"))!='undefined'")) &&
       (document.getElementById("combo_"+following)!=null)) {
       son = document.getElementById("combo_"+following);
       stringa=stringa+"_"
       i=0
       while ((eval("typeof("+stringa+i+")!='undefined'")) || (i==0)) {
	   	  if ((i==0) && eval("typeof("+stringa+"0)=='undefined'"))
	   	      if (eval("typeof("+stringa+"1)=='undefined'"))
	   	         eval("son.options[0]=new Option(displaywhenempty,valuewhenempty)")
	   	      else
	             eval("son.options[0]=new Option(displaywhennotempty,valuewhennotempty)")
	      else
              eval("son.options["+i+"]=new Option("+stringa+i+".text,"+stringa+i+".value)")
	      i=i+1
	   }
       //son.focus()
       i=1
       combostatus=''
       cstatus=stringa.split("_")
       while (cstatus[i]!=null) {
          combostatus=combostatus+cstatus[i]
          i=i+1
          }
       return combostatus;
    }
}

//-->
</script>
<?php

echo "<table>";
echo "<form action=\"user.php?u=".$user['id']."&a=a&m=$miesiac&y=$rok\" method=\"post\">";
echo "<tr align=center><td  rowspan=2 border=0><input".($_GET['a'] == 'e' ? " disabled" : "")." type=submit value=\"Dodaj&#13;&#10;wpis\"></td>
	<td colspan=2><input type=\"date\" name=\"dzien\" value=\"".date("Y-m-d")."\"></td></tr>";
echo "<tr align=center><td><input type=\"time\" name=\"start\" step=1800></td>";
echo "<td><input type=\"time\" name=\"stop\" step=1800></td><td colspan=2></td>";
/*echo "<td><select name=\"task_id\">";
foreach($projs as $proj)
{
	echo "<option disabled>" . $proj['name'] . "</option>";
	foreach($proj['tasks'] as $task)
	{
		echo "<option value=\"" . $task['id'] . "\"> - " . $task['name'] . "</option>";
	}
}
echo "</td>";*/
echo "<td>
<select id=\"combo_0\" onChange=\"change(this)\" style=\"width:200px;\"><option>-wybierz projekt-</option>";
foreach ($projs as $proj)
	echo "<option>$proj[name]</option>";
echo "</select>
<select name=\"task_id\" id=\"combo_1\" onChange=\"change(this)\" style=\"width:200px;\">
	<option value=\"value1\">  </option>
</select>";

echo "<td><input size=40 type=\"text\" name=\"komentarz\"></td>";
echo "</tr></form>";




/////////////////////////

echo "<tr><th width=70>Dzień</th><th width=100>Rozpoczęcie</th><th width=100>Koniec</th>
<th width = 100>Czas</th><th width = 100>Nadgodziny</th><th width=300>Zadanie</th>
<th width=300>Komentarz</th><th width=50>Edytuj</th></tr>";
$debug="";
function row_style($_dzien, $_miesiac, $_rok, $_row_num = 1, $_rows_all = 1)
{
	$style = "";
	if ($dw = dzien_wolny($_dzien, $_miesiac, $_rok))
	{
		$style .= " bgcolor=" . ($dw == 1 ? "red" : "orange");
	}
	if( date('Y-n-j') == ( $_rok.'-'.$_miesiac.'-'. $_dzien ) )
	{
		if ( $_rows_all < 2 )
		{
			$style .= " class=border_all";
		}
		elseif ( $_rows_all == 2 )
		{
			if ( $_row_num == 1 )
			{
				$style .= " class=border_top";
			}
			elseif ( $_row_num == 2 )
			{
				$style .= " class=border_bottom";
			}
		}
		else
		{
			if ( $_row_num == 1 )
			{
				$style .= " class=border_top";
			}
			elseif ( $_row_num == $_rows_all )
			{
				$style .= " class=border_bottom";
			}
			else
			{
				$style .= " class=border_middle";
			}
		}
	}
	return $style;
}


$godzin_w_miesiacu = 0;
$nadgodziny_sofar = 0;

foreach($kal as $k => $dzien)
{
	$r = $dzien['rows'];
	
	
	$plan_h = (dzien_wolny($k, $miesiac, $rok) ? 0 : 8);
	$godzin_w_miesiacu += $plan_h;
	
	$nadgodziny_sofar = $dzien['suma_sofar'] - $godzin_w_miesiacu;
	
	//$dzien['count'] and $nadgodziny_sofar += $dzien['count'] - $plan_h; 
	
	
	echo "<tr" . row_style($k, $miesiac, $rok, 1, $r) . ">";
	
	
	/*echo "<tr";
	if ($dw = dzien_wolny($k, $miesiac, $rok))
	{
		$plan_h = 0;
		echo " bgcolor=" . ($dw == 1 ? "red" : "orange");
	} else 
	{
		$plan_h = 8;
	}
	if( date('Y-n-j') == ( $rok.'-'.$miesiac.'-'.$k ) )
		echo " style=\"outline: 3px solid\"";
	echo ">";*/
	
	
	echo "<td valign=top rowspan=".max($r, 1).">$k</td>";
	if($r==0)
		echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>\n";
	$tallrow = 0;
	foreach($dzien['tasks'] as $id => $zad)
	{
		if($_GET['a'] != 'e' || $_GET['id'] != $id)
		{
			if($tallrow) echo "<tr" . row_style($k, $miesiac, $rok, $tallrow + 1, $r) . ">";
			echo "<td>$zad[start]</td><td>$zad[stop]</td><td>".(float)($zad['ile'])."h</td>";
			if(!$tallrow++) echo "<td valign=bottom rowspan=$r>".(float)(-$plan_h + $dzien['count'])."h</td>";
			echo "<td>$zad[nazwa]</td><td>$zad[komentarz]</td><td><a href=\"user.php?u=".$user['id']."&a=e&id=$id&m=$miesiac&y=$rok\">o</a></td></tr>\n";
		}
		else
		{
			if($tallrow) echo "<tr" . row_style($k, $miesiac, $rok, $tallrow + 1, $r) . ">";
			echo "<form method=post action=user.php?u=$user[id]&a=u&id=$id&y=$rok&m=$miesiac>
				<td><input name=start type=datetime-local value=\"$zad[start_full]\" /></td>
				<td><input name=stop type=time value=$zad[stop] /></td>
				<td></td>";
				if(!$tallrow++) echo "<td valign=bottom rowspan=$r>".(float)(-$plan_h + $dzien['count'])."h</td>";
			echo "<td>$zad[nazwa]</td>
				<td><input name=komentarz value=\"$zad[komentarz]\" /></td>
				<td><input type=submit value=\"Zapisz\" />
				<a href=\"user.php?u=$user[id]&a=d&id=$id&y=$rok&m=$miesiac\">Usuń wpis</a></td></form></tr>\n";
		}
	}
}
//echo "<tr><th colspan=8>Podsumowanie miesiąca:</th></tr>";
//echo "<tr><td colspan=3></td><th>Czas</th><th>Nadgodziny</th><th colspan=3></th></tr>";
echo "<tr><th style=\"border: 0\" colspan=3 align=right>Suma:</th><th>"
		.(float)$suma_w_miesiacu."h</th><th>".(float)($suma_w_miesiacu-$godzin_w_miesiacu).
		"h</th><td style=\"border: 0\" colspan=3></td></tr>";
//echo "</table>";


//tablica projektów



$count_total = 0;
$q = mysql_query("SELECT * FROM user_tasks WHERE user_id = " . $user['id'] . " AND MONTH(start) = $miesiac AND YEAR(START) = $rok ORDER BY stop DESC");
$c = 0;
while($row = mysql_fetch_array($q))
{
	$ile_godzin = (strtotime($row['stop']) - strtotime($row['start'])) / 3600;
	$task_q = mysql_query("SELECT * FROM tasks WHERE id = ". $row['task_id'] . " LIMIT 1");
	$task_row = mysql_fetch_array($task_q);
	$proj_q = mysql_query("SELECT * FROM projects WHERE id = ". $task_row['project_id'] . " LIMIT 1");
	$proj_row = mysql_fetch_array($proj_q);
	$projs[$proj_row['id']]['count'] += $ile_godzin;
	$count_total += $ile_godzin;
	$projs[$proj_row['id']]['tasks'][$task_row['id']]['count'] += $ile_godzin;
	if($c++ < 0)
	{	
		echo "<tr><td>" . $proj_row['nazwa'] . "</td><td>" . $task_row['nazwa'];
		echo "</td><td>" . $row['start'] . "</td><td>" . $row['stop'];
		echo "</td><td>" . $row['komentarz'] . "</td><td>" . strval($ile_godzin) . "h</td><td><a href=\"user.php?u=".$user['id']."&a=d&id=" . $row['id'] . "\">Usuń</a></td></tr>";
	}
}



//echo "<h3>Podsumowanie:</h3>";
foreach($projs as $proj)
{
	if ($proj['count'])
	{
		echo "<tr><td style=\"border: 0\" colspan=3></td><td align=center>$proj[count]h</td><th colspan=2>$proj[name]:</th><td style=\"border: 0\" colspan=2></td></tr>";
		foreach($proj['tasks'] as $task)
		{
			if ($task['count'])
			{
				echo "<tr><td style=\"border: 0\" colspan=3></td><td align=center>$task[count]h</td><td colspan=2 align=center>- $task[name]</td><td style=\"border: 0\" colspan=2></td></tr>";
			}
		}
	}
}
echo "</table></br></br></br></br></br></br></br></br></br></br>";
//echo "Suma: " . $count_total . "h</br></br>";

//var_dump($projs);

if ($alert) 
	echo "<script type=\"text/javascript\">alert('$alert');</script>";

include("footer.php");
?>