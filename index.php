<?php

include './curl/Curl.php';
require "./vendor/tracy/tracy/src/tracy.php";

use Tracy\Debugger;

Debugger::enable();

// we init curl
$curl = new Curl();

dump($curl);
?>

<html>
    <head>
        
        <title>WEBSUPPORT ♥</title>
        
    </head>
    <body>
        
        <div class="container">
            
        </div>
        
    </body>
</html>
