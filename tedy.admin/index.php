<?php

include("core/core.php");

require_once 'core/Mobile_Detect.php';
require_once 'core/phpqrcode/qrlib.php';
$detect = new Mobile_Detect;

$login = false;

$_SESSION['token'] = $_COOKIE['token'];

if (isset($_SESSION['token'])) {
    if ($token = $wam->dbm->getData('access_tokens', ['user', 'remember', 'date', 'ip_address'], ['eq' => ['token' => $_SESSION['token']]])) {
        $token = $token[0];
        if ($token->remember) {
            $ip_address = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
            $ip_address = ip2long($ip_address);
            $login = ($token->ip_address == $ip_address) ? true : false;
            $user = $wam->dbm->getData('users', ['id', 'type', 'name', 'lastname', 'email', 'username', 'avatar', 'permissions'], ['eq' => ['id' => $token->user]]);
            $user = $user[0];
        } else {
            $login = true;
            $user = $wam->dbm->getData('users', ['id', 'type', 'name', 'lastname', 'email', 'username', 'avatar', 'permissions'], ['eq' => ['id' => $token->user]]);
            $user = $user[0];
        }
        $user->permissions = explode('[//]', $user->permissions);
    }
}

if ($login) {
    if ($user->type == 2) {
        if ($detect->isMobile() || $detect->isTablet()) {
            echo 'Use Desktop';
            exit();
        }
    }
    $home = true;
    if ($dir1 == '') {
        $include = 'sys/user/profile.php';
    } elseif ($dir1 == '360') {
        $home = false;
        include('sys/360/main.php');
    } elseif ($dir1 == 'ajax') {
        $home = false;
        if ($dir2 == '') {
            if ($user->type == 1) {
                include('sys/home/admin/main.php');
            } elseif ($user->type == 2) {
                //
            } elseif ($user->type == 3) {
                include('sys/files/freelance/main.php');
            }
        } elseif ($dir2 == 'data') {
            $home = false;
            include('sys/data/main.php');
        } elseif ($dir2 == 'get-360-single') {
            $photos = $wam->dbm->getData('realestate_media', 'id, url, thumbnail', ['eq' => ['type' => 'panorama']]);
            foreach ($photos as $photo) {
                $json[] = [
                    'desc' => 'Realestate',
                    'url' => $photo->url,
                    'thumbnail_url' => $photo->thumbnail
                ];
            }
        } elseif ($dir2 == 'home') {
            if ($user->type == 1 || in_array('files_full_control', $user->permissions)) {
                if ($dir3 == "") {
                    include('sys/home/admin/main.php');
                } elseif ($dir3 == "card") {
                    include('sys/home/admin/card.php');
                }
            } elseif ($user->type == 2) {
                //
            } elseif ($user->type == 3) {
                include('sys/files/freelance/main.php');
            }
        } elseif ($dir2 == 'currencies') {
            if ($dir3 == '') {
                include('sys/currencies/main.php');
            }
        } elseif ($dir2 == 'statistics') {
            if ($dir3 == '') {
                include('sys/statistics/main.php');
            }
        } elseif ($dir2 == 'offices') {
            if ($dir3 == '') {
                include('sys/offices/main.php');
            }
        } elseif ($dir2 == 'features') {
            if ($dir3 == '') {
                include('sys/features/main.php');
            }
        } elseif ($dir2 == 'videos') {
            if ($dir3 == 'turkish-citizenship') {
                include('sys/videos/turkish-citizenship.php');
            }
        } elseif ($dir2 == 'blog') {
            if ($dir3 == '') {
                include('sys/blog/main.php');
            } elseif ($dir3 == 'ar') {
                include('sys/blog/main.php');
            } elseif ($dir3 == 'en') {
                include('sys/blog/main.php');
            } elseif ($dir3 == 'tr') {
                include('sys/blog/main.php');
            } elseif ($dir3 == 'new') {
                include('sys/blog/new.php');
            } elseif ($dir3 == 'edit') {
                include('sys/blog/edit.php');
            }
        } elseif ($dir2 == 'products') {
            if ($dir3 == "") {
                include('sys/products/main.php');
            } elseif ($dir3 == 'category') {
                include('sys/products/category.php');
            }
        } elseif ($dir2 == 'testimonials') {
            include('sys/testimonials/main.php');
        } elseif ($dir2 == 'partners') {
            include('sys/partners/main.php');
        } elseif ($dir2 == 'works') {
            if ($dir3 == '') {
                include('sys/works/main.php');
            } elseif ($dir3 == 'work') {
                include('sys/works/work.php');
            }
        } elseif ($dir2 == 'actions') {
            if ($dir3 == '') {
                include('core/actions.php');
            }
        } elseif ($dir2 == 'modal') {
            include('core/modal.php');
        } elseif ($dir2 == 'profile') {
            include('sys/user/profile.php');
        } elseif ($dir2 == 'set-media') {
            //            $complexes = $wam->dbm->getData('realestate_complexes', 'id, photos, photos_types');
            //            foreach ($complexes as $key => $complex){
            //                $photos = explode('[//]', $complex->photos);
            //                $types = explode('[//]', $complex->photos_types);
            //                foreach ($photos as $i => $photo){
            //                    switch ($types[$i]){
            //                        case 'external':
            //                            $type = 'outdoor';
            //                            break;
            //                        case 'plan':
            //                            $type = 'plan';
            //                            break;
            //                        default:
            //                            $type = 'indoor';
            //                    }
            //                    $wam->dbm->insert('realestate_media', [
            //                        'type' => $type,
            //                        'section' => 'complexes',
            //                        'item' => $complex->id,
            //                        'url' => $photo,
            //                        'sort' => ($i + 1),
            //                        'date' => $time
            //                    ]);
            //                }
            //            }
            //            $media = $wam->dbm->getData('realestate_media', ['id', 'url']);
            //            foreach ($media as $item){
            //                $url = str_ireplace('https://www.alrawi.co/', 'https://cdn.alrawiemlak.com/', $item->url);
            //                $wam->dbm->update('realestate_media', [
            //                    'set' => [
            //                        'url' => $url,
            //                    ],
            //                    'eq' => ['id' => $item->id]
            //                ]);
            //            }
        } elseif ($dir2 == 'complexes') {
            if ($dir3 == '') {
                include('sys/complexes/main.php');
            } elseif ($dir3 == 'city' && $city = $wam->dbm->getData('cities', 'id, name_ar', ['eq' => ['id' => $dir4]])) {
                $city = $city[0];
                include('sys/complexes/city.php');
            } elseif ($dir3 == 'edit' && $complex = $wam->dbm->getData('realestate_complexes', '*', ['eq' => ['id' => $dir4]])) {
                $complex = $complex[0];
                $city = $wam->dbm->getData('cities', 'id, name_ar', ['eq' => ['id' => $complex->city]]);
                $city = $city[0];
                include('sys/complexes/edit.php');
            } elseif ($dir3 == 'items' && $complex = $wam->dbm->getData('realestate_complexes', '*', ['eq' => ['id' => $dir4]])) {
                $complex = $complex[0];
                $city = $wam->dbm->getData('cities', 'id, name_ar', ['eq' => ['id' => $complex->city]]);
                $city = $city[0];
                include('sys/complexes/items.php');
            } elseif ($dir3 == 'new' && $city = $wam->dbm->getData('cities', 'id, name_ar', ['eq' => ['id' => $dir4]])) {
                $city = $city[0];
                include('sys/complexes/new.php');
            }
        } elseif ($dir2 == 'random-photos') {
            if ($dir3 == '') {
                include('sys/random-photos/main.php');
            }
        } elseif ($dir2 == 'cities') {
            if ($dir3 == '') {
                include('sys/cities/main.php');
            }
        } elseif ($dir2 == 'slider') {
            if ($dir3 == '') {
                include('sys/slider/main.php');
            }
        } elseif ($dir2 == 'faq') {
            if ($dir3 == '') {
                include('sys/faq/main.php');
            }
        } elseif ($dir2 == 'employees' && ($user->type == 1)) {
            if ($dir3 == '') {
                include('sys/employees/regular/main.php');
            } elseif ($dir3 == 'new' && ($user->type == 1 || in_array('account', $user->permissions))) {
                include('sys/employees/regular/new.php');
            } elseif ($dir3 == 'edit' && ($user->type == 1 || in_array('account', $user->permissions))) {
                include('sys/employees/regular/edit.php');
            } elseif ($dir3 == 'deleted') {
                include('sys/employees/deleted.php');
            }
        } elseif ($dir2 == 'sendmail') {
            include('sys/sendmail.php');
        }
    } elseif ($dir1 == 'logout') {
        $home = false;
        if ($session = $wam->dbm->getData('work_schedule', 'id', [
            'eq' => ['user' => $user->id, 'year' => $year, 'month' => (int) $month, 'day' => (int) $day, 'status' => 1],
            //'eog' => ['end' => ($time - 1800)],
            'brackets'
        ])) {
            $session = $session[0];
            $wam->dbm->update('work_schedule', [
                'set' => ['end' => $time],
                'eq' => ['id' => $session->id]
            ]);
        }
        $wam->dbm->update('work_schedule', [
            'set' => [
                'status' => 0
            ],
            'eq' => ['user' => $user->id, 'status' => 1]
        ]);
        $token = $_COOKIE['token'];
        if ($wam->dbm->delete('access_tokens', ['eq' => ['token' => $token]])) {
            setcookie('token', '', $time - (60 * 60 * 24));
            header('Location: /');
        }
    } elseif ($dir1 == 'send-employees-email') {
        // $home = false;
        // $users = $wam->dbm->getData("user_setup A", [
        //     'A.user as id',
        //     'A.code',
        //     '(SELECT CONCAT(name, " ", lastname) FROM users WHERE id = A.user) as name',
        //     '(SELECT email FROM users WHERE id = A.user) as email'
        // ]);
        // echo "<pre>";
        // foreach ($users as $user) {
        //     $json['mail'][$user->id]['name'] = $user->name;
        //     $json['mail'][$user->id] = sendMail("sys/new-employee-template.html", "إعدادات حسابك في شركة الراوي العقارية", [$user->email], ['[employee_name]', '[code]'], [$user->name, $user->code]);
        // }
        // echo "</pre>";
    }
    if ($home) {
        include('site.home.php');
    }
} elseif (!$login) {
    if ($dir1 == 'ajax') {
        if ($dir2 == 'login') {
            include('core/login.php');
        } elseif ($dir2 == 'data') {
            include('sys/data/main.php');
        }
    } else {
        include('sys/user/login.php');
    }
}


if (!empty($json)) {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $wam->emr->send($json);
}
