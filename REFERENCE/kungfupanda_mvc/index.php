<?php
/*
 * Author: Louie Zhu
 * Date: 3/28/2022
 * Name: index.php
 * Description: The homepage
 */
//load application settings
require_once ("application/config.php");

//load autoloader
require_once ("vendor/autoload.php");

//load the dispatcher that dissects a request URL
new Dispatcher();