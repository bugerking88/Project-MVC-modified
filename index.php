<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once('core/PDO_getdata.php');
require_once ('core/App.php');
require_once ('core/Controller.php');

$app = new App();



         
?>