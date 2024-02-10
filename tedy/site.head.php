<title><?php echo $wam->lng->title; ?></title>
<meta name="description" content="<?php echo $wam->seo->description; ?>">
<meta name="keywords" content="<?php echo $wam->seo->keywords; ?>">
<meta name="author" content="<?php echo $wam->seo->author; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<link rel="icon" href="/images/favicon.png" type="image/png">
<script src="https://kit.fontawesome.com/239a370c1f.js" crossorigin="anonymous"></script>
<?php

$wam->seo->seo();
$wam->scr->head();
