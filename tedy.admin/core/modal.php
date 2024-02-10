<?php

if ($user->type == 1 || in_array('account', $user->permissions)) {
    $determiner = [
        'SLIDER' => [
            'new' => 'sys/slider/new.php',
            'edit' => 'sys/slider/edit.php',
            'sort' => 'sys/slider/sort.php',
        ],
        'PRODUCTS' => [
            'new-category' => 'sys/products/new-category.php',
            'edit-category' => 'sys/products/edit-category.php',
            'new-product' => 'sys/products/new-product.php',
            'new-products' => 'sys/products/new-products.php',
            'edit-product' => 'sys/products/edit-product.php',
            'categories-sort' => 'sys/products/categories-sort.php',
            'products-sort' => 'sys/products/products-sort.php',
        ],
        // Home
        'HOME_SECREEN' => [
            'status' => 'sys/home/admin/status.php',
            'search' => 'sys/home/search.php',
        ],
        // ًWorks
        'WORKS' => [
            'new' => 'sys/works/new.php',
            'edit' => 'sys/works/edit.php',
            'new-photo' => 'sys/works/new-photo.php',
            'edit-photo' => 'sys/works/edit-photo.php',
            'new-video' => 'sys/works/new-video.php',
            'edit-video' => 'sys/works/edit-video.php',
        ],
        // Offices
        'OFFICES' => [
            'new' => 'sys/offices/new.php',
            'edit' => 'sys/offices/edit.php',
        ],
        // Videos
        'VIDEOS' => [
            'new' => 'sys/videos/new.php',
            'edit' => 'sys/videos/edit.php',
        ],
        // Videos
        'FAQ' => [
            'new' => 'sys/faq/new.php',
            'edit' => 'sys/faq/edit.php',
        ],
        // Features
        'FEATURES' => [
            'new' => 'sys/features/new.php',
            'edit' => 'sys/features/edit.php',
        ],
        // Currencies
        'CURRENCIES' => [
            'new' => 'sys/currencies/new.php',
            'edit' => 'sys/currencies/edit.php',
            'edit-all' => 'sys/currencies/edit-all.php',
        ],
        // Testimonials
        'TESTIMONIALS' => [
            'new' => 'sys/testimonials/new.php',
            'edit' => 'sys/testimonials/edit.php',
        ],
        // Partners
        'PARTNERS' => [
            'new' => 'sys/partners/new.php',
            'edit' => 'sys/partners/edit.php',
        ],
        // Employees
        'EMPLOYEES' => [
            'change-password' => 'sys/employees/change-password.php',
        ],
        // Complexes
        'COMPLEXES' => [
            'details' => 'sys/complexes/details.php',
            'vr' => 'sys/complexes/vr.php',
            'item-new' => 'sys/complexes/items/new.php',
            'item-edit' => 'sys/complexes/items/edit.php',
            'edit-photo' => 'sys/complexes/edit-photo.php',
            'new-photo' => 'sys/complexes/new-photo.php',
            'edit-photos-sort' => 'sys/complexes/edit-photos-sort.php',
            'new-photos' => 'sys/complexes/new-photos.php',
            'random-photos' => 'sys/random-photos/random-photos.php',
        ],
        // Cities
        'CITIES' => [
            'edit' => 'sys/cities/edit.php',
            'districts' => 'sys/cities/districts.php',
            'new-district' => 'sys/cities/new-district.php',
            'edit-district' => 'sys/cities/edit-district.php',
        ],
        // Administrative
        'ADMINISTRATIVE_FILES' => [
            'new-folder' => 'sys/administrative/new-folder.php',
            'new-file' => 'sys/administrative/new-file.php',
            'edit-folder' => 'sys/administrative/edit-folder.php',
            'edit-file' => 'sys/administrative/edit-file.php',
            'notes' => 'sys/administrative/notes/main.php',
            'notes-new' => 'sys/administrative/notes/new.php',
            'notes-edit' => 'sys/administrative/notes/edit.php',
        ],
        // Change log
        'CHANGELOG_DISPLAY_X218' => [
            'display' => 'sys/changeLog.php',
        ]
    ];
} elseif ($user->type == 2) {
    $determiner = [
        //
    ];
} elseif ($user->type == 3) {
    $determiner = [
        //
    ];
}

if ($determiner[$dir3][$dir4]) {
    include($determiner[$dir3][$dir4]);
}
