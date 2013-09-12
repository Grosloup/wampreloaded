<?php
session_start();
/**
 * Created by JetBrains PhpStorm.
 * User: Nicolas
 * Date: 12/09/13
 * Time: 20:12
 */
defined("DS")   || define("DS", DIRECTORY_SEPARATOR);
defined("BASE") || define("BASE", realpath(__DIR__));
defined("WR")   || define("WR", BASE . DS . "wampreloaded");
defined("INCS") || define("INCS", WR . DS . "incs");
defined("APP")  || define("APP", WR . DS . "app");

set_include_path(implode(PATH_SEPARATOR, [get_include_path(), INCS, APP]));

$debug = true;
$wampManagerConfigs = [];

if(is_file(BASE.DS."..".DS."wampmanager.conf")){
    $wampManagerConfigs = parse_ini_file(BASE.DS."..".DS."wampmanager.conf", true);
}

$configs = ["wampConfigs"=>$wampManagerConfigs];

require_once INCS . DS . "functions.php";

$request = \Core\Request::create();



echo "hello !";

