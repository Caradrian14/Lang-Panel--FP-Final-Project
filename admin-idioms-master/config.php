<?php

$folderPath = dirname($_SERVER['SCRIPT_NAME']);
$urlPath = $_SERVER['REQUEST_URI'];
$url = substr($urlPath,strlen($folderPath));
$extension = pathinfo($url, PATHINFO_EXTENSION);
/**Dev */
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
/**Fin Dev */
define('URL', $urlPath);