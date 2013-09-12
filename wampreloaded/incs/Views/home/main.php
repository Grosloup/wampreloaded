<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nicolas
 * Date: 12/09/13
 * Time: 21:39
 */
 echo getHeader();
?>
<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/"
               class="navbar-brand">WampServer <?php echo $configs["wampConfigs"]["main"]["wampserverVersion"]; ?></a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li><a href="index.php?page=phpinfo">phpinfo</a></li>
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
                    <li><strong>Apache</strong> <?php echo $configs["wampConfigs"]["apache"]["apacheVersion"]; ?>
                    </li>
                    <li><strong>Mysql</strong> <?php echo $configs["wampConfigs"]["mysql"]["mysqlVersion"]; ?></li>
                </ul>
                <ul class="list-inline pull-right">
                    <li>
                        <strong>phpmyadmin</strong> <?php echo $configs["wampConfigs"]["apps"]["phpmyadminVersion"]; ?>
                    </li>
                    <li><strong>sqlbuddy</strong> <?php echo $configs["wampConfigs"]["apps"]["sqlbuddyVersion"]; ?>
                    </li>
                    <li><strong>webgrind</strong> <?php echo $configs["wampConfigs"]["apps"]["webgrindVersion"]; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>


    <div class="container">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>

<?php echo getFooter(); ?>