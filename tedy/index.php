<?php

include("core/core.php");

global $wam, $wam2, $dir1, $dir2, $dir3, $json;

$includeHome = true;
$isHome = false;
$sideBarShow = false;
$emptyCart = true;

if (!empty($_SESSION['cart'])) {
    $emptyCart = false;
}

$login = false;

if ($dir1 == '') {
    $isHome = true;
    $wam->lng->setTitle('Tedy');
    $wam->seo->setDescription($wam->lng->language['_DESCRIPTION_']);
    $include = 'sys/home/main.php';
} elseif ($dir1 == 'category') {
    $category = $wam->dbm->getData('categories A', [
        'A.id',
        'A.name_tr as name',
        'A.cover',
    ], [
        'eq' => ['A.id' => $dir2]
    ]);
    $category = $category[0];
    $wam->lng->setTitle($category->name);
    $wam->seo->setDescription($wam->lng->language['_DESCRIPTION_']);
    $include = 'sys/category/main.php';
} else if ($dir1 == 'contact-us') {
    $isHome = true;
    $wam->lng->setTitle($wam->lng->language['_CONTACT_US_']);
    $wam->seo->setDescription($wam->lng->language['_DESCRIPTION_']);
    $include = 'sys/contact-us/main.php';
} else if ($dir1 == 'menu') {
    $isHome = true;
    $wam->lng->setTitle($wam->lng->language['_MENU_']);
    $wam->seo->setDescription($wam->lng->language['_DESCRIPTION_']);
    $include = 'sys/menu/main.php';
} else if ($dir1 == 'about-us') {
    $isHome = true;
    $wam->lng->setTitle($wam->lng->language['_ABOUT_US_']);
    $wam->seo->setDescription($wam->lng->language['_DESCRIPTION_']);
    if ($wam->lng->langCode == 'en') {
        $include = 'sys/about-us/en.php';
    } elseif ($wam->lng->langCode == 'ar') {
        $include = 'sys/about-us/ar.php';
    } else {
        $include = 'sys/about-us/tr.php';
    }
} elseif ($dir1 == 'ajax') {
    $includeHome = false;
    if ($dir2 == 'actions') {
        include('core/actions.php');
    } elseif ($dir2 == 'load-cart') {
        include('sys/load-cart.php');
    } elseif ($dir2 == 'change-language') {
        switch ($dir3) {
            case 'ar':
                $_SESSION['lang'] = 0;
                break;
            case 'en':
                $_SESSION['lang'] = 1;
                break;
            case 'tr':
                $_SESSION['lang'] = 2;
                break;
            default:
                if (!isset($_SESSION['lang'])) {
                    $_SESSION['lang'] = 0;
                }
                break;
        }
        header('Location: /');
    }
} elseif ($dir1 == 'logout') {
    $includeHome = false;
    setcookie('token', '', time() - 3600, '/');
}

if ($includeHome) {
    include('site.home.php');
}

if (!empty($json)) {
    $wam->emr->send($json);
}
