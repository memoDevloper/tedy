<?php

include('int.php');

// Styles
$wam->scr->css("/css/bootstrap.css");
if ($wam->lng->langCode == 'ar') {
    $wam->scr->css("/css/style.ar.css");
} else {
    $wam->scr->css("/css/style.css");
}
$wam->scr->css("/css/responsive.css");


// Scripts
$wam->scr->js("/js/jquery.js");
$wam->scr->js("/js/popper.min.js");
$wam->scr->js("/js/bootstrap.min.js");
$wam->scr->js("/js/jquery-ui.js");
$wam->scr->js("/js/jquery.fancybox.js");
$wam->scr->js("/js/swiper.js");
$wam->scr->js("/js/owl.js");
$wam->scr->js("/js/appear.js");
$wam->scr->js("/js/wow.js");
$wam->scr->js("/js/parallax.min.js");
$wam->scr->js("/js/custom-script.js");
