<?php
if ($user->timezone !== 'Europe/Istanbul') {
    date_default_timezone_set('Europe/Istanbul');
}

$time = time();

$an = $_POST['actionName'];
$at = $_POST['actionType'];

foreach ($_POST as $key => $value) {
    if (is_array($_POST[$key])) {
        foreach ($_POST[$key] as $key2 => $h) {
            $_POST[$key][$key2] = addslashes($_POST[$key][$key2]);
        }
    } else {
        $_POST[$key] = addslashes($_POST[$key]);
    }
}

$itemId = 0;

function uploadFile($file, $allow = false, $upload_directory = '../tedy/files/')
{
    global $time;
    global $wam;
    $forbidden  = ['php', 'aspx', 'php5', 'html'];
    $fileName = pathinfo($file['name']);
    $ext = strtolower($fileName['extension']);
    $saveName = rand(1111, 9999) . '-' . rand(1111, 9999) . '-' . rand(1111, 9999) . '-' . rand(1111, 9999) . '.' . $ext;
    $dir = $upload_directory;
    if (!empty($file)) {
        if ((!in_array($ext, $forbidden) && !$allow) || (!in_array($ext, $forbidden) && in_array($ext, $allow))) {
            $year = date('Y', $time);
            $month = date('m', $time);
            $day = date('d', $time);
            if (!file_exists($dir . $ext)) {
                mkdir($dir . $ext);
                fopen($dir . $ext . '/index.html', 'w');
            }
            if (!file_exists($dir . $ext . '/' . $year)) {
                mkdir($dir . $ext . '/' . $year);
                fopen($dir . $ext . '/' . $year . '/index.html', 'w');
            }
            if (!file_exists($dir . $ext . '/' . $year . '/' . $month)) {
                mkdir($dir . $ext . '/' . $year . '/' . $month);
                fopen($dir . $ext . '/' . $year . '/' . $month . '/index.html', 'w');
            }
            if (!file_exists($dir . $ext . '/' . $year . '/' . $month . '/' . $day)) {
                mkdir($dir . $ext . '/' . $year . '/' . $month . '/' . $day);
                fopen($dir . $ext . '/' . $year . '/' . $month . '/' . $day . '/index.html', 'w');
            }
            if (move_uploaded_file($file['tmp_name'], $dir . $ext . '/' . $year . '/' . $month . '/' . $day . '/' . $saveName)) {
                return 'files/' . $ext . '/' . $year . '/' . $month . '/' . $day . '/' . $saveName;
            } else {
                $json[] = $wam->emr->error('Icon Upload Error');
            }
        } else {
            $json[] = $wam->emr->error('File Extension is not allowed');
        }
    }
    return false;
}

function png2jpg($data)
{
    $tmp_file_name = rand(11111111, 99999999);
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    file_put_contents('files/' . $tmp_file_name . '.png', $data);
    $image = imagecreatefrompng('files/' . $tmp_file_name . '.png');
    $width  = imagesx($image);
    $height = imagesy($image);
    $background = imagecreatetruecolor($width, $height);
    $color = imagecolorallocate($background, 255, 255, 255);
    imagefill($background, 0, 0, $color);
    imagecopy($background, $image, 0, 0, 0, 0, $width, $height);
    if (imagejpeg($image, 'files/' . $tmp_file_name . '.jpg', 80)) {
        imagedestroy($image);
        return $tmp_file_name;
    }
    return false;
}

if ($an == 'EDIT_SLIDER_SORT') {
    $i = 1;
    foreach ($_POST['sort'] as $key => $value) {
        $wam->dbm->update("slider", [
            'set' => [
                'sort' => $key,
            ],
            'eq' => ['id' => $value]
        ]);
        $i++;
    }
    $json[] = $wam->emr->success('تم تعديل الترتيب بنجاح');
    $json[] = $wam->emr->func('closeModals', false);
    $json[] = $wam->emr->func('checkURL', false);
}

if ($an == 'EDIT_SLIDE') {
    if (!empty($_FILES['image'])) {
        $fileDir = uploadFile($_FILES['image']);
        if ($fileDir) {
            $photo = $wam->website . '/' . $fileDir;
            $wam->dbm->update("slider", [
                'set' => [
                    'image' => $photo,
                ],
                'eq' => ['id' => $_POST['id']]
            ]);
        }
    }
    if ($query = $wam->dbm->update("slider", [
        'set' => [
            'name_ar' => $_POST['name_ar'],
            'desc_ar' => $_POST['desc_ar'],
            'name_en' => $_POST['name_en'],
            'desc_en' => $_POST['desc_en'],
            'name_tr' => $_POST['name_tr'],
            'desc_tr' => $_POST['desc_tr'],
            'link' => $_POST['link'],
        ],
        'eq' => ['id' => $_POST['id']]
    ])) {
        $itemId = $_POST['id'];
        $json[] = $wam->emr->func('checkURL', false);
        $json[] = $wam->emr->func('closeModals', false);
        $json[] = $wam->emr->success('تم تعديل السلايد بنجاح');
    } else {
        $json[] = $wam->emr->error('Error');
    }
}

if ($an == 'NEW_SLIDE') {
    if (!empty($_FILES['image'])) {
        $fileDir = uploadFile($_FILES['image']);
        if ($fileDir) {
            $image = $wam->website . '/' . $fileDir;
        }
    }
    $sort = $wam->dbm->rows('slider', []);
    $sort = $sort + 1;
    if ($query = $wam->dbm->insert("slider", [
        'category' => $_POST['category'],
        'name_ar' => $_POST['name_ar'],
        'desc_ar' => $_POST['desc_ar'],
        'name_en' => $_POST['name_en'],
        'desc_en' => $_POST['desc_en'],
        'name_tr' => $_POST['name_tr'],
        'desc_tr' => $_POST['desc_tr'],
        'link' => $_POST['link'],
        'image' => $image,
        'sort' => $sort,
        'date' => $wam->time,
    ])) {
        $itemId = $_POST['id'];
        $json[] = $wam->emr->func('checkURL', false);
        $json[] = $wam->emr->func('closeModals', false);
        $json[] = $wam->emr->success('The slide was added successfully');
    } else {
        $json[] = $wam->emr->error('Error');
    }
}

if ($an == 'EDIT_PRODUCTS_SORT') {
    $i = 1;
    foreach ($_POST['sort'] as $key => $value) {
        $wam->dbm->update("products", [
            'set' => [
                'sort' => $key,
            ],
            'eq' => ['id' => $value, 'category' => $_POST['category']]
        ]);
        $i++;
    }
    $json[] = $wam->emr->success('تم تعديل الترتيب بنجاح');
    $json[] = $wam->emr->func('closeModals', false);
    $json[] = $wam->emr->func('checkURL', false);
}

if ($an == 'EDIT_PRODUCT') {
    if (!empty($_FILES['icon'])) {
        $fileDir = uploadFile($_FILES['icon']);
        if ($fileDir) {
            $photo = $wam->website . '/' . $fileDir;
            $wam->dbm->update("products", [
                'set' => [
                    'icon' => $photo,
                ],
                'eq' => ['id' => $_POST['id']]
            ]);
        }
    }
    if ($query = $wam->dbm->update("products", [
        'set' => [
            'category' => $_POST['category'],
            'name_ar' => $_POST['name_ar'],
            'desc_ar' => $_POST['desc_ar'],
            'name_en' => $_POST['name_en'],
            'desc_en' => $_POST['desc_en'],
            'name_tr' => $_POST['name_tr'],
            'desc_tr' => $_POST['desc_tr'],
            'price' => $_POST['price'],
        ],
        'eq' => ['id' => $_POST['id']]
    ])) {
        $itemId = $_POST['id'];
        $json[] = $wam->emr->func('checkURL', false);
        $json[] = $wam->emr->func('closeModals', false);
        $json[] = $wam->emr->success('تم تعديل القسم بنجاح');
    } else {
        $json[] = $wam->emr->error('Error');
    }
}

if ($an == 'NEW_PRODUCTS') {
    $names_tr = $_POST['names_tr'];
    // explode names_tr by new line to get array of names
    $names_tr = explode("\n", $names_tr);
    $prices = $_POST['prices'];
    // explode prices by new line to get array of prices
    $prices = explode("\n", $prices);
    foreach ($names_tr as $key => $name_tr) {
        $name_tr = trim($name_tr);
        $price = $prices[$key];
        $price = str_replace('TL', '', $price);
        $price = trim($price);
        $query = $wam->dbm->insert("products", [
            'icon' => $icon,
            'category' => $_POST['category'],
            'name_tr' => $name_tr,
            'price' => $price,
            'date' => $wam->time,
        ]);
    }
    $json[] = $wam->emr->func('checkURL', false);
    $json[] = $wam->emr->func('closeModals', false);
    $json[] = $wam->emr->success('تم اضافة المنتجات بنجاح');
}

if ($an == 'NEW_PRODUCT') {
    if (!empty($_FILES['icon'])) {
        $fileDir = uploadFile($_FILES['icon']);
        if ($fileDir) {
            $icon = $wam->website . '/' . $fileDir;
        }
    }
    if ($query = $wam->dbm->insert("products", [
        'icon' => $icon,
        'category' => $_POST['category'],
        'name_ar' => $_POST['name_ar'],
        'desc_ar' => $_POST['desc_ar'],
        'name_en' => $_POST['name_en'],
        'desc_en' => $_POST['desc_en'],
        'name_tr' => $_POST['name_tr'],
        'desc_tr' => $_POST['desc_tr'],
        'price' => $_POST['price'],
        'date' => $wam->time,
    ])) {
        $itemId = $_POST['id'];
        $json[] = $wam->emr->func('checkURL', false);
        $json[] = $wam->emr->func('closeModals', false);
        $json[] = $wam->emr->success('The category was added successfully');
    } else {
        $json[] = $wam->emr->error('Error');
    }
}

if ($an == 'EDIT_CATEGORIES_SORT') {
    $i = 1;
    foreach ($_POST['sort'] as $key => $value) {
        $wam->dbm->update("categories", [
            'set' => [
                'sort' => $i,
            ],
            'eq' => ['id' => $value]
        ]);
        $i++;
    }
    $json[] = $wam->emr->success('تم تعديل الترتيب بنجاح');
    $json[] = $wam->emr->func('closeModals', false);
    $json[] = $wam->emr->func('checkURL', false);
}

if ($an == 'EDIT_CATEGORY') {
    if (!empty($_FILES['icon'])) {
        $fileDir = uploadFile($_FILES['icon']);
        if ($fileDir) {
            $photo = $wam->website . '/' . $fileDir;
            $wam->dbm->update("categories", [
                'set' => [
                    'icon' => $photo,
                ],
                'eq' => ['id' => $_POST['id']]
            ]);
        }
    }
    if (!empty($_FILES['cover'])) {
        $fileDir = uploadFile($_FILES['cover']);
        if ($fileDir) {
            $photo = $wam->website . '/' . $fileDir;
            $wam->dbm->update("categories", [
                'set' => [
                    'cover' => $photo,
                ],
                'eq' => ['id' => $_POST['id']]
            ]);
        }
    }
    if ($query = $wam->dbm->update("categories", [
        'set' => [
            'name_ar' => $_POST['name_ar'],
            'name_en' => $_POST['name_en'],
            'name_tr' => $_POST['name_tr'],
            'slug' => $_POST['slug'],
        ],
        'eq' => ['id' => $_POST['id']]
    ])) {
        $itemId = $_POST['id'];
        $json[] = $wam->emr->func('checkURL', false);
        $json[] = $wam->emr->func('closeModals', false);
        $json[] = $wam->emr->success('تم تعديل القسم بنجاح');
    } else {
        $json[] = $wam->emr->error('Error');
    }
}

if ($an == 'NEW_CATEGORY') {
    $icon = '';
    if (!empty($_FILES['icon'])) {
        $fileDir = uploadFile($_FILES['icon']);
        if ($fileDir) {
            $icon = $wam->website . '/' . $fileDir;
        }
    }
    $cover = '';
    if (!empty($_FILES['cover'])) {
        $fileDir = uploadFile($_FILES['cover']);
        if ($fileDir) {
            $cover = $wam->website . '/' . $fileDir;
        }
    }
    if ($query = $wam->dbm->insert("categories", [
        'icon' => $icon,
        'cover' => $cover,
        'name_ar' => $_POST['name_ar'],
        'name_en' => $_POST['name_en'],
        'name_tr' => $_POST['name_tr'],
        'slug' => $_POST['slug'],
        'date' => $wam->time,
    ])) {
        $itemId = $_POST['id'];
        $json[] = $wam->emr->func('checkURL', false);
        $json[] = $wam->emr->func('closeModals', false);
        $json[] = $wam->emr->success('The category was added successfully');
    } else {
        $json[] = $wam->emr->error('Error');
    }
}

if ($an == 'EDIT_BLOG') {
    $namelen = strlen(utf8_decode($_POST['name']));
    // if($namelen <= 40){
    if (!empty($_FILES['photo'])) {
        $fileDir = uploadFile($_FILES['photo']);
        if ($fileDir) {
            $photo = 'https://admin.axismediapro.com/' . $fileDir;
            $wam->dbm->update("blogs", [
                'set' => [
                    'photo' => $photo,
                ],
                'eq' => ['id' => $_POST['id']]
            ]);
        }
    }
    if ($query = $wam->dbm->update("blogs", [
        'set' => [
            'lang' => $_POST['lang'],
            'name' => $_POST['name'],
            'blog' => $_POST['blog'],
            'slug' => $_POST['slug'],
            'keywords' => $_POST['keywords'],
            'date' => $time,
        ],
        'eq' => ['id' => $_POST['id']]
    ])) {
        $itemId = $_POST['id'];
        $json[] = $wam->emr->func('backButton', false);
        $json[] = $wam->emr->success('The blog was edited successfully');
    } else {
        $json[] = $wam->emr->error('Error');
    }
    // }else{
    //     $json[] = $wam->emr->error($namelen);
    //     $json[] = $wam->emr->error('عدد أحرف عنوان التدوينة تجاوز 40 حرف');
    // }
}

if ($an == 'NEW_BLOG') {
    $namelen = strlen($_POST['name']);
    // if($namelen <= 40){
    if (!empty($_FILES['photo'])) {
        $fileDir = uploadFile($_FILES['photo']);
        if ($fileDir) {
            $photo = 'https://admin.axismediapro.com/' . $fileDir;
        }
    }
    if ($query = $wam->dbm->insert("blogs", [
        'lang' => $_POST['lang'],
        'name' => $_POST['name'],
        'photo' => $photo,
        'blog' => $_POST['blog'],
        'slug' => $_POST['slug'],
        'keywords' => $_POST['keywords'],
        'date' => $time,
    ])) {
        $itemId = $query;
        $json[] = $wam->emr->func('backButton', false);
        $json[] = $wam->emr->success('The blog was added successfully');
    } else {
        $json[] = $wam->emr->error('Error');
    }
    // }else{
    //     $json[] = $wam->emr->error('عدد أحرف عنوان التدوينة تجاوز 40 حرف');
    // }
}

if ($an == 'EDIT_EMPLOYEE_REGULAR') {
    if ($user->type == 1 || in_array('account', $user->permissions)) {
        $id = $_POST['user'];
        if ($wam->dbm->update('users', [
            'set' => [
                'name' => $_POST['name'],
                'lastname' => $_POST['lastname'],
                'gender' => $_POST['gender'],
                'birthdate' => $wam->act->makeTimeSD($_POST['birthdate']),
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'permissions' => implode('[//]', $_POST['permissions']),
                'salary' => $_POST['salary'],
                'rph' => number_format($_POST['salary'] / 240, 2),
            ],
            'eq' => ['id' => $id]
        ])) {
            $json[] = $wam->emr->success('Employee details has been edited successfully');
            $json[] = $wam->emr->func('backButton');
        } else {
            $json[] = $wam->emr->error('Error');
        }
    } else {
        $json[] = $wam->emr->error('You don\'t have the permission to do this process');
    }
}

if ($an == 'NEW_EMPLOYEE_REGULAR') {
    if ($user->type == 1 || in_array('account', $user->permissions)) {
        if (!$wam->dbm->check('users', ['eq' => ['email' => $_POST['email']]])) {
            if (md5($_POST['password']) == md5($_POST['repassword'])) {
                $password = $wam->poc->encrypt($_POST['password']);
                $salt = $wam->poc->getPasswordHash($password);
                $query = $wam->dbm->insert('users', [
                    'type' => $_POST['type'],
                    'name' => $_POST['name'],
                    'lastname' => $_POST['lastname'],
                    'gender' => $_POST['gender'],
                    'birthdate' => $wam->act->makeTimeSD($_POST['birthdate']),
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'password' => $password,
                    'salt' => $salt,
                    'permissions' => implode('[//]', $_POST['permissions']),
                    'active' => 1,
                    'salary' => $_POST['salary'],
                    'rph' => number_format($_POST['salary'] / 240, 2),
                ]);
                $itemId = $query;
                if ($itemId !== 0) {
                    $code = md5($_POST['email'] . $_POST['name'] . $wam->time);
                    $wam->dbm->insert("user_setup", [
                        'user' => $query,
                        'code' => $code,
                        'date' => $wam->time,
                    ]);
                    $json[] = $wam->emr->success('تمت اضافة الموظف الجديد');
                    $json[] = $wam->emr->func('backButton', false);
                } else {
                    $json[] = $wam->emr->error('يوجد خطأ، يرجى المحاولة لاحقاً');
                }
            } else {
                $json[] = $wam->emr->error('كلمتا المرور غير متطابقتان');
            }
        } else {
            $json[] = $wam->emr->error('الايميل الذي أدخلته مستخدم من قبل موظف آخر');
        }
    } else {
        $json[] = $wam->emr->error('لا تملك صلاحيات اتمام العملية');
    }
}

if ($an == 'UPDATE_PROFILE_PICTURE') {
    $file = $_FILES['profile_pic'];
    if (!empty($file['name'])) {
        $forbidden  = ['php', 'aspx', 'php5'];
        $images = ['jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'];
        $fileName = pathinfo($file['name']);
        $name = str_ireplace(' ', '-', $fileName['filename']);
        $ext = $fileName['extension'];
        $saveName = $user->id . '-' . rand(1111, 9999) . '-' . rand(1111, 9999) . '-' . rand(1111, 9999) . '.' . $ext;
        $dir = 'files/avatars';
        if (!in_array($ext, $forbidden) && in_array($ext, $images)) {
            if (move_uploaded_file($file['tmp_name'], $dir . '/' . $saveName) && $wam->dbm->update('users', ['set' => ['avatar' => $saveName], 'eq' => ['id' => $user->id]])) {
                unlink($dir . '/' . $user->avatar);
                $json[] = $wam->emr->func('reload');
            } else {
                $json[] = $wam->emr->error('Error uploading the file');
            }
        } else {
            $json[] = $wam->emr->error('Invalid file type');
        }
    } else {
        $json[] = $wam->emr->error('Please select a picture to upload');
    }
}

if ($an == 'CHANGE_EMPLOYEE_PASSWORD') {
    if ($user->type == 1 || in_array('account', $user->permissions)) {
        if (md5($_POST['psw1']) == md5($_POST['psw2'])) {
            $password = $wam->poc->encrypt($_POST['psw1']);
            $salt = $wam->poc->getPasswordHash($password);
            if ($wam->dbm->update('users', [
                'set' => [
                    'password' => $password,
                    'salt' => $salt,
                ],
                'eq' => ['id' => $_POST['employee']]
            ])) {
                if (isset($_POST['sign_out']) && $_POST['sign_out'] == 1) {
                    $wam->dbm->delete('access_tokens', [
                        'eq' => ['user' => $_POST['employee']]
                    ]);
                }
                $json[] = $wam->emr->func('closeModals', false);
                $json[] = $wam->emr->success('Old password has been changed successfully');
            }
        } else {
            $json[] = $wam->emr->error('The passwords you have entered must be similar to each other');
        }
    } else {
        $json[] = $wam->emr->error('You don\'t have the permission to do this process');
    }
}

if ($an == 'UPDATE_PROFILE_PASSWORD') {
    $old_password = $_POST['old_password'];
    if ($wam->cls->check($user->email, $old_password, 1)) {
        if (md5($_POST['new_password']) == md5($_POST['confirm_password'])) {
            $password = $wam->poc->encrypt($_POST['new_password']);
            $salt = $wam->poc->getPasswordHash($password);
            if ($wam->dbm->update('users', [
                'set' => [
                    'password' => $password,
                    'salt' => $salt,
                ],
                'eq' => ['id' => $user->id]
            ])) {
                if (isset($_POST['sign_out']) && $_POST['sign_out'] == 1) {
                    $wam->dbm->delete('access_tokens', [
                        'eq' => ['user' => $user->id],
                        'not' => ['token' => $_SESSION['token']]
                    ]);
                }
                $json[] = $wam->emr->success('Your old password has been changed successfully');
            }
        } else {
            $json[] = $wam->emr->error('The passwords you have entered must be similar to each other');
        }
    } else {
        $json[] = $wam->emr->error('Old password you have entered is wrong');
    }
}

if ($an == 'UPDATE_PROFILE') {
    if ($wam->dbm->update('users', [
        'set' => [
            'name' => $_POST['name'],
            'lastname' => $_POST['lastname'],
            'gender' => $_POST['gender'],
            'birthdate' => $wam->act->makeTimeSD($_POST['birthdate']),
            'email' => $_POST['email'],
            'username' => $_POST['username'],
            'phone' => $_POST['phone'],
        ],
        'eq' => ['id' => $user->id]
    ])) {
        $json[] = $wam->emr->success('Done');
        $json[] = $wam->emr->func('reload');
    }
}

if ($an == 'CONF_X001') {
    $id = $_POST['id'];
}

if ($an == "REQUEST") {
    $id = $_POST['id'];
}

if ($an == 'CHANGE_STATUS_X001') {
    $id = $_POST['id'];
    $value = $_POST['value'];
}

if ($an == "DELETE_X001") {
    $id = $_POST['id'];
    if ($at == 'DELETE_EMPLOYEE') {
        if ($wam->dbm->update('users', [
            'set' => [
                'active' => 0
            ],
            'eq' => ['id' => $id]
        ])) {
            $x = [
                'id' => $id,
                'at' => $at
            ];
            $json[] = $wam->emr->func('deleteCompleted', $x);
        } else {
            $json[] = $wam->emr->func('deleteFailed', false);
        }
    }
    if ($at == 'RECOVER_EMPLOYEE') {
        if ($wam->dbm->update('users', [
            'set' => [
                'active' => 1
            ],
            'eq' => ['id' => $id]
        ])) {
            $x = [
                'id' => $id,
                'at' => $at
            ];
            $json[] = $wam->emr->func('deleteCompleted', $x);
        } else {
            $json[] = $wam->emr->func('deleteFailed', false);
        }
    }
    if ($at == 'DELETE_BLOG') {
        if ($wam->dbm->delete('blogs', ['eq' => ['id' => $id]])) {
            $itemId = $id;
            $x = [
                'id' => $id,
                'at' => $at
            ];
            $json[] = $wam->emr->func('deleteCompleted', $x);
        } else {
            $json[] = $wam->emr->error('Error occurred, please try again later');
        }
    }
    if ($at == 'DELETE_CATEGORY') {
        if ($wam->dbm->delete('categories', ['eq' => ['id' => $id]])) {
            $wam->dbm->delete('products', ['eq' => ['category' => $id]]);
            $itemId = $id;
            $x = [
                'id' => $id,
                'at' => $at
            ];
            $json[] = $wam->emr->func('deleteCompleted', $x);
        } else {
            $json[] = $wam->emr->error('Error occurred, please try again later');
        }
    }
    if ($at == 'DELETE_PRODUCT') {
        if ($wam->dbm->delete('products', ['eq' => ['id' => $id]])) {
            $itemId = $id;
            $x = [
                'id' => $id,
                'at' => $at
            ];
            $json[] = $wam->emr->func('deleteCompleted', $x);
        } else {
            $json[] = $wam->emr->error('Error occurred, please try again later');
        }
    }
    if ($at == 'DELETE_SLIDE') {
        if ($wam->dbm->delete('slider', ['eq' => ['id' => $id]])) {
            $itemId = $id;
            $x = [
                'id' => $id,
                'at' => $at
            ];
            $json[] = $wam->emr->func('deleteCompleted', $x);
        } else {
            $json[] = $wam->emr->error('Error occurred, please try again later');
        }
    }
}

$con = false;

if ($con) {
    $wam->emr->send($con);
    exit();
}
