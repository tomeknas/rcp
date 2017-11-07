<?php

include 'Application' . DS . 'ControllerBase.php';
include 'Application' . DS . 'Router.php';
include 'Application' . DS . 'Auth.php';
include 'Application' . DS . 'Smarty' . DS . 'Smarty.class.php';


\define('DATE_FORMAT_MYSQL', 'Y-m-d H:i:s');

function rcpAutoload($className) {
    $file = SITE_PATH . DS . 'Model' . DS . $className . '.php';
    if (file_exists($file) == false)
    {
        return false;
    }
  include ($file);
}

define( 'SITE_URL', '//localhost/rcp/rcp3_kopia/' );

\spl_autoload_register('rcpAutoload');

$mysqli = new \mysqli('localhost', 'root', '', 'rcp');
// $mysqli = new \mysqli('localhost', 'rcp', '4pec29y5', 'rcp');
$mysqli->query('SET NAMES utf8');
ActiveRecord::setMysqli($mysqli);

$view = new Smarty;
$view->assign('SITE_URL', SITE_URL);
ControllerBase::setView($view);

$auth = new Auth;
ControllerBase::setAuth($auth);
Router::setAuth($auth);

$router = new Router;
$router->setPath(SITE_PATH . DS . 'Controller');

$settingObject = new Setting;
$settings = $settingObject->getWhere();
foreach ($settings as $setting) {
    $class = $setting->class;
    $method = 'set' . ucfirst($setting->property);
    $class::$method($setting->value);
}

\define('DEFAULT_CONTROLLER', 'UserMonth');
