<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nicolas
 * Date: 12/09/13
 * Time: 21:55
 */

echo getHeader();
?>
<header class="phpinfo-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/" style="background-color:transparent; ">&laquo; retour à l'accueil</a>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php phpinfo(); ?>
        </div>
    </div>
</div>

<?php echo getFooter(); ?>