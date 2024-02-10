<?php

include('int.php');
include('dir.php');

include('WAM.php');
include('LNG.php');

$wam = new WAM(
    'https://tedycompany.com/',
    "",
    "localhost",
    "alrawi",
    "Alrawi@123",
    "tedy",
    $_SESSION['lang'],
    true
);

$time = time();

$website = 'https://tedycompany.com/';

$CPP = [];
