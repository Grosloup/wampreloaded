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

require_once INCS . DS . "functions.php";

$directories = loadJsonConfigs(WR.DS."configs".DS."directories.json");

$configs = [
    "wampConfigs"=>$wampManagerConfigs,
    "viewsDir"=>INCS.DS."Views",
    "defaultPageName"=>"home",
    "allowedPages"=>[
        "home", "phpinfo", "404","info"
    ],
    "pages"=>[
        "home"=>[
            "title"=>"Accueil",
        ],
        "404" =>[
            "title"=>"Erreur 404 | Page introuvable",
        ],
        "phpinfo" => [
            "title"=>"PHP info",
        ],
        "info" => [
            "title" => "Projets",
        ]
    ],
    "projectsDir"=> $directories["default"],
    "projectsDirInfos" => $directories["dirs"][$directories["default"]],
    "directories"=>$directories,

];





$request = \Core\Request::create();

if($request->get("page") == "info" && $request->get("project") != null){
    $configs["projectsDir"] = $request->get("project");
}


_getView();
?>
