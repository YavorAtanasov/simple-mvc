<?php 
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';
require_once '../app/core/View.php';
require_once '../config/config.php';

define('DS', DIRECTORY_SEPARATOR); 
define('ROOT', dirname(dirname(__FILE__))); 
define('BASEURL', rtrim($_SERVER['PHP_SELF'],'www/index.php').'/');     

error_reporting(1);
session_start();
$app = new App();