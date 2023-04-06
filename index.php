<?php
/**
 * Author: Bobby Ezenwelu
 * Date: 4/5/23
 * File: index.php
 * Description:
 */

//load application settings
require_once ("application/config.php");
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
//load autoloader
require_once ("vendor/autoload.php");

//load the dispatcher that dissects a request URL
new Dispatcher();