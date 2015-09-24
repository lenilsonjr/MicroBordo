<?php
//This file cannot be directly accessed
if (array_search(__FILE__, get_included_files()) === 0) {
    die;
}
/*
This file is the main system file. Here we'll call the classes, set default settings and more.
*/

//Let's set the time zone and the default charset
header('Content-type: text/html; charset=utf-8');
date_default_timezone_set("Brazil/East");

//Open session
session_start();

/*
Here we'll call the system classes
*/

//Configuration class
require_once('config.php');

//Data-base Class
require_once('classes/database.class.php');

//Main Class
require_once('classes/microbordo.class.php');

//Front-end Class
require_once('classes/frontend.class.php');

//Pagination Class
require_once('classes/pagination.class.php');

//Search Class
require_once('classes/search.class.php');

//Load all modules
MicroBordo::loadModules();
?>
