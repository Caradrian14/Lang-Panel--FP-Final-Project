<?php

$folderPath = dirname($_SERVER['SCRIPT_NAME']);
$urlPath = substr($urlPath,strlen($folderPath));
$extension = pathinfo($url, PATHINFO_EXTENSION);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('URL', $urlPath);