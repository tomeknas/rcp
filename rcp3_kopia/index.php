<?php
error_reporting(E_ALL);

\define ('DS', DIRECTORY_SEPARATOR);
$site_path = \realpath(\dirname(__FILE__));
\define ('SITE_PATH', $site_path);

 include 'Includes/init.php';
 /*
 $__res = $mysqli->query("SHOW SESSION STATUS LIKE 'Questions'");
$__row = $__res->fetch_array();
define('QUERIES_START', $__row['Value']);
*/


 $router->loader();
 
 
 
// $__res = $mysqli->query("SHOW SESSION STATUS LIKE 'Questions'");
//$__row = $__res->fetch_array();
//define('QUERIES_STOP', $__row['Value']);
//echo QUERIES_STOP - QUERIES_START;
