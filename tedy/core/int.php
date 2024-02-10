<?php

//exit();

// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

include('dir.php');

require_once 'WAM.php';

$time = time();

date_default_timezone_set('Europe/Istanbul');

session_start();

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 2;
}

if (!isset($_SESSION['currency'])) {
    $_SESSION['currency'] = 'usd';
}

$wam = new WAM(
    'http://165.227.211.94:901',
    "",
    "",
    "localhost",
    "alrawi",
    "Alrawi@123",
    "tedy",
    [],
    $_SESSION['lang'],
    true
);
