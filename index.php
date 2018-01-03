<?php

require "./curl/Curl.php";
require "./vendor/tracy/tracy/src/tracy.php";

Tracy\Debugger::enable();

// we always have to have action set
if (isset($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = "default";
}
?>

<html>
    <head>
        
        <title>WEBSUPPORT ♥</title>
        
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="icon" type="image/png" href="https://www.websupport.sk/assets/8c4877dd/img/icons/favicon.png">
        
    </head>
    <body>
        
        <div class="header">
            <h1>
                <a href="index.php">WEBSUPPORT</a>
                <span class="right">♥</span>
                <br class="clear">
            </h1>
        </div>
        <div class="container">
            <div class="left-side-menu">
                <nav>
                    <ul>
                        <li><a href="index.php?action=get" class="<?php if ($action == "get") {echo "active";} ?>">VÝPIS ZÁZNAMOV</a></li>
                        <li><a href="index.php?action=add" class="<?php if ($action == "add") {echo "active";} ?>">PRIDAŤ ZÁZNAM</a></li>
                        <li><a href="index.php?action=delete" class="<?php if ($action == "delete") {echo "active";} ?>">ZMAZAŤ ZÁZNAM</a></li>
                    </ul>
                </nav>
                <h3 class="signature text-center">VLADIMÍR VRÁB</h3>
            </div>
            <div class="right-side-menu">
                <div class="content">
                    <?php
                        include "blocks/$action.php";
                    ?>
                </div>
            </div>
            <br class="clear">
        </div>
        
    </body>
</html>
