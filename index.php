<?php

require './curl/Curl.php';
require "./vendor/tracy/tracy/src/tracy.php";

use Tracy\Debugger;

Debugger::enable();


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
        
    </head>
    <body>
        
        <div class="header">
            <h1>WEBSUPPORT ♥</h1>
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
                        include "$action.php";
                    ?>
                </div>
            </div>
            <br class="clear">
        </div>
        
    </body>
</html>
