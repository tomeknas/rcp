<?php

  $conn = mysqli_connect('localhost', 'rcp', '4pec29y5', 'rcp');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";



error_reporting(E_ALL);

\define ('DS', DIRECTORY_SEPARATOR);
$site_path = \realpath(\dirname(__FILE__));
\define ('SITE_PATH', $site_path);

echo SITE_PATH;

 /*
 $__res = $mysqli->query("SHOW SESSION STATUS LIKE 'Questions'");
$__row = $__res->fetch_array();
define('QUERIES_START', $__row['Value']);
*/



 
 
 
// $__res = $mysqli->query("SHOW SESSION STATUS LIKE 'Questions'");
//$__row = $__res->fetch_array();
//define('QUERIES_STOP', $__row['Value']);
//echo QUERIES_STOP - QUERIES_START;



$conn->close();
?>