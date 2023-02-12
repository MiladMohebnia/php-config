<?php

require __DIR__ . "/../vendor/autoload.php";


use miladm\Config;


$config = new Config(__DIR__ . "/config.json");

die(var_dump(
    $config->app
));
