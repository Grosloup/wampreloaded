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

$configs = [
    "wampConfigs"=>$wampManagerConfigs,
    "defaultPageName"=>"home",
    "allowedPages"=>[
        "home", "phpinfo"
    ],
    "pages"=>[
        "home"=>[
            "title"=>"Accueil",
        ],
    ],
];

require_once INCS . DS . "functions.php";

$request = \Core\Request::create();
?>

<!doctype html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title><?php _getPageTitle(); ?> | WampServer</title>
    <link rel="stylesheet" href="/wampreloaded/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/wampreloaded/css/master.css"/>

    <script type="text/javascript" src="/wampreloaded/js/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/wampreloaded/js/vendor/bootstrap/bootstrap.min.js"></script>
</head>
<body>

<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../" class="navbar-brand">WampServer <?php echo $configs["wampConfigs"]["main"]["wampserverVersion"]; ?></a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li><a href="/?page='phpinfo'">phpinfo</a></li>
            </ul>
            <!--<form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" placeholder="Rechercher" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Aller</button>
            </form>-->
        </nav>
    </div>
</header>
<header class="subheader">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-inline pull-left">
                    <li><strong>PHP</strong> <?php echo $configs["wampConfigs"]["php"]["phpVersion"]; ?></li>
                    <li><strong>Apache</strong> <?php echo $configs["wampConfigs"]["apache"]["apacheVersion"]; ?></li>
                    <li><strong>Mysql</strong> <?php echo $configs["wampConfigs"]["mysql"]["mysqlVersion"]; ?></li>
                </ul>
                <ul class="list-inline pull-right">
                    <li><strong>phpmyadmin</strong> <?php echo $configs["wampConfigs"]["apps"]["phpmyadminVersion"]; ?></li>
                    <li><strong>sqlbuddy</strong> <?php echo $configs["wampConfigs"]["apps"]["sqlbuddyVersion"]; ?></li>
                    <li><strong>webgrind</strong> <?php echo $configs["wampConfigs"]["apps"]["webgrindVersion"]; ?></li>
                </ul>
            </div>
        </div>
    </div>
</header>

</body>
</html>