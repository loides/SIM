<?php 

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/backend/library/constants.php');

// UNCOMENT ONE OF THESE TWO LINES FOR SETTING THE APP_MODE 
//define("APP_MODE", MODE_DEVELOPMENT);
define("APP_MODE", MODE_PRODUCTION);

if (defined("APP_MODE")) {
    if (APP_MODE == MODE_DEVELOPMENT) {
        // use these settings for the development localhost
        define("DATABASE_HOST", "localhost");
        define("DATABASE_PORT", 3306);
        define("DATABASE_USER",  "root");
        define("DATABASE_PASSWORD",  "xpto");
        define("DATABASE_NAME",  "sim_webapp");
        
    } else if (APP_MODE == MODE_PRODUCTION) {
        // use these settings for the PRODUCTION server
        define("DATABASE_HOST", "fdb1032.awardspace.net");
        define("DATABASE_PORT", 3306);
        define("DATABASE_USER",  "4407114_webapp");
        define("DATABASE_PASSWORD",  "Xpto1234");
        define("DATABASE_NAME",  "4407114_webapp");
    } else {
        echo '<h2>App mode not set  to existing modes ...</h2>';
        die;
    }
} else {
    echo '<h2>App mode not set...</h2>';
    die;
}