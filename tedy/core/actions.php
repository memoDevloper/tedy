<?php

$an = $dir3;
$at = $_POST['actionType'];

foreach ($_POST as $key => $value) {
    foreach ($a as $s => $h) {
        $_POST[$key] = addslashes($_POST[$key]);
    }
}

$itemId = 0;

$configure = [];

$dbs = [];

if (is_array($dbs[$an])) {
    $db = $dbs[$an][$at];
} else {
    $db = $dbs[$an];
}

if (is_array($configure[$an])) {
    $con = $wam->act->action($configure[$an][$at], $_POST);
} else {
    $con = $wam->act->action($configure[$an], $_POST);
}

if ($dir3 == 'addresses') {
    if ($wam->getUserData('id')) {
        if ($dir4 == 'new') {
            if ($wam->dbm->insert('client_addresses', [
                'client' => $wam->getUserData('id'),
                'name' => $_POST['name'],
                'country' => $_POST['country'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'date' => $wam->time,
            ])) {
                $json['status'] = 'success';
                $json['redirect'] = '/user/addresses';
            } else {
                $json['status'] = 'error';
            }
        } elseif ($dir4 == 'edit') {
            if ($wam->dbm->update('client_addresses', [
                'set' => [
                    'name' => $_POST['name'],
                    'country' => $_POST['country'],
                    'phone' => $_POST['phone'],
                    'address' => $_POST['address'],
                ],
                'eq' => [
                    'id' => $_POST['id'],
                    'client' => $wam->getUserData('id'),
                ]
            ])) {
                $json['status'] = 'success';
                $json['redirect'] = '/user/addresses';
            } else {
                $json['status'] = 'error';
            }
        } elseif ($dir4 == 'delete') {
            if ($wam->dbm->delete('client_addresses', [
                'eq' => [
                    'id' => $_POST['id'],
                    'client' => $wam->getUserData('id'),
                ]
            ])) {
                $json['status'] = 'success';
                $json['redirect'] = '/user/addresses';
            } else {
                $json['status'] = 'error';
            }
        }
    }
}

if ($dir3 == 'change-password') {
    if ($wam->getUserData('id')) {
        $client = $wam->dbm->getData('clients', '*', [
            'eq' => ['id' => $wam->getUserData('id')]
        ]);
        $client = $client[0];
        if ($wam->cls->check($client->email, $_POST['password'], 1, 1)) {
            if (md5($_POST['new_password']) == md5($_POST['confirm_password'])) {
                $password = $wam->poc->encrypt($_POST['new_password']);
                $salt = $wam->poc->getPasswordHash($password);
                if ($wam->dbm->update('clients', [
                    'set' => [
                        'password' => $password,
                        'salt' => $salt,
                    ],
                    'eq' => [
                        'id' => $wam->getUserData('id'),
                    ]
                ])) {
                    $json['status'] = 'success';
                    $json['redirect'] = '/';
                } else {
                    $json['status'] = 'error';
                    $json['message'] = 'حدث خطأ ما';
                }
            } else {
                $json['status'] = 'error';
                $json['message'] = 'كلمة المرور غير متطابقة';
            }
        } else {
            $json['status'] = 'error';
            $json['message'] = 'كلمة المرور الحالية غير صحيحة';
        }
    }
}

if ($dir3 == 'cart') {
    if ($wam->getUserData('id')) {
        if ($dir4 == 'quantity-plus') {
            $itemId = $_POST['id'];
            $product = $wam->dbm->getData('products A', [
                'A.id',
                'A.name',
                'A.price',
            ], [
                'eq' => ['A.id' => $itemId]
            ]);
            $product = $product[0];
            $cart = $_SESSION['cart'];
            $quantity = 0;
            $price = 0;
            $total = 0;
            $done = false;
            foreach ($cart as $key => $item) {
                $item = json_decode($item);
                $subProduct = $wam->dbm->getData('products A', [
                    'A.id',
                    'A.name',
                    'A.price',
                ], [
                    'eq' => ['A.id' => $item->product]
                ]);
                $subProduct = $subProduct[0];
                if ($item->product == $itemId) {
                    $item->quantity++;
                    $cart[$key] = json_encode($item);
                    $_SESSION['cart'] = $cart;
                    $quantity = $item->quantity;
                    $price = $product->price * $item->quantity;
                    $done = true;
                    $total += $price;
                } else {
                    $total += $subProduct->price * $item->quantity;
                }
            }
            if (!$done) {
                $cart[] = json_encode([
                    'product' => $itemId,
                    'quantity' => 1
                ]);
                $_SESSION['cart'] = $cart;
                $quantity = 1;
                $price = $product->price;
                $total += $price;
            }
            $json['status'] = 'success';
            $json['message'] = 'Quantity increased';
            $json['quantity'] = $quantity;
            $json['price'] = $price;
            $json['total'] = $total;
        } else if ($dir4 == 'quantity-minus') {
            $itemId = $_POST['id'];
            $product = $wam->dbm->getData('products A', [
                'A.id',
                'A.name',
                'A.price',
            ], [
                'eq' => ['A.id' => $itemId]
            ]);
            $product = $product[0];
            $cart = $_SESSION['cart'];
            $quantity = 0;
            $price = 0;
            $total = 0;
            foreach ($cart as $key => $item) {
                $item = json_decode($item);
                $subProduct = $wam->dbm->getData('products A', [
                    'A.id',
                    'A.name',
                    'A.price',
                ], [
                    'eq' => ['A.id' => $item->product]
                ]);
                $subProduct = $subProduct[0];
                if ($item->product == $itemId) {
                    $item->quantity--;
                    if ($item->quantity == 0) {
                        unset($cart[$key]);
                    } else {
                        $cart[$key] = json_encode($item);
                    }
                    $_SESSION['cart'] = $cart;
                    $quantity = $item->quantity;
                    $price = $product->price * $item->quantity;
                    $total += $price;
                } else {
                    $total += $subProduct->price * $item->quantity;
                }
            }
            $json['status'] = 'success';
            $json['message'] = 'Quantity increased';
            $json['quantity'] = $quantity;
            $json['price'] = $price;
            $json['total'] = $total;
        } elseif ($dir4 == 'continue-order') {
            $cart = $_SESSION['cart'];
            $total = 0;
            foreach ($cart as $key => $item) {
                $item = json_decode($item);
                $subProduct = $wam->dbm->getData('products A', [
                    'A.id',
                    'A.name',
                    'A.price',
                ], [
                    'eq' => ['A.id' => $item->product]
                ]);
                $subProduct = $subProduct[0];
                $total += $subProduct->price * $item->quantity;
            }
            if ($orderId = $wam->dbm->insert('orders', [
                'client' => $wam->getUserData('id'),
                'address' => $_POST['address'],
                'total' => $total,
                'status' => 1,
                'date' => $wam->time,
            ])) {
                foreach ($cart as $key => $item) {
                    $item = json_decode($item);
                    $subProduct = $wam->dbm->getData('products A', [
                        'A.id',
                        'A.name',
                        'A.price',
                    ], [
                        'eq' => ['A.id' => $item->product]
                    ]);
                    $subProduct = $subProduct[0];
                    if ($wam->dbm->insert('order_items', [
                        'order_id' => $orderId,
                        'product' => (int) ($subProduct->id),
                        'quantity' => $item->quantity,
                        'price' => $subProduct->price,
                        'total' => ($subProduct->price * $item->quantity),
                    ])) {
                        $json['status'] = 'success';
                    } else {
                        $json['errors'][] = $wam->dbm->errors;
                    }
                }
                // unset($_SESSION['cart']);
                $_SESSION['order_id'] = $orderId;
                $json['status'] = 'success';
                $json['message'] = 'Purchase';
                $json['redirect'] = '/new-site/cart/checkout';
            } else {
                $json['status'] = 'error';
                $json['message'] = $wam->dbm->errors;
            }
        } elseif ($dir4 == 'complete-order') {
            $orderId = $_SESSION['order_id'];
            if ($wam->dbm->update('orders', [
                'set' => [
                    'status' => 'pending',
                ],
                'eq' => ['id' => $orderId]
            ])) {
                unset($_SESSION['cart']);
                unset($_SESSION['order_id']);
                $json['status'] = 'success';
                $json['message'] = 'Purchase completed';
                $json['redirect'] = '/new-site/cart/order-completed';
            } else {
                $json['status'] = 'error';
                $json['message'] = 'Error';
            }
        } elseif ($dir4 == 'check') {
            $cart = $_SESSION['cart'];
            $total = 0;
            foreach ($cart as $key => $item) {
                $item = json_decode($item);
                $subProduct = $wam->dbm->getData('products A', [
                    'A.id',
                    'A.name',
                    'A.price',
                ], [
                    'eq' => ['A.id' => $item->product]
                ]);
                $subProduct = $subProduct[0];
                $total += $subProduct->price * $item->quantity;
            }
            $json['status'] = 'success';
            $json['total'] = $total;
        }
    } else {
        $json['status'] = "login";
    }
}

if ($dir3 == 'user') {
    if ($dir4 == 'signup') {
        if (md5($_POST['password']) == md5($_POST['password-confirmation'])) {
            if (!$wam->dbm->check('clients A', ['eq' => ['A.email' => $_POST['email']]])) {
                $password = $wam->poc->encrypt($_POST['password']);
                $salt = $wam->poc->getPasswordHash($password);
                if ($query = $wam->dbm->insert('clients', [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => $password,
                    'salt' => $salt,
                    'date' => $time,
                ])) {
                    $token = bin2hex(openssl_random_pseudo_bytes(16));
                    $ip_address = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
                    $ip_address = ip2long($ip_address);
                    $itemId = $query;
                    if ($wam->dbm->insert('access_tokens', [
                        'source' => 'website',
                        'user' => $query,
                        'token' => $token,
                        'remember' => 0,
                        'date' => $time,
                        'ip_address' => $ip_address
                    ])) {
                        setcookie("token", $token, 0, '/');
                        $json['status'] = 'success';
                        $json['redirect'] = '/';
                    }
                }
            } else {
                $json['status'] = 'error';
                $json['message'] = 'Email already exists';
            }
        } else {
            $json['status'] = 'error';
            $json['message'] = 'Password does not match';
        }
    }
    if ($dir4 == 'signin') {
        if ($wam->cls->check($_POST['email'], $_POST['password'], 1, 1)) {
            $token = bin2hex(openssl_random_pseudo_bytes(16));
            $ip_address = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
            $ip_address = ip2long($ip_address);
            $data = $wam->dbm->getData('clients', 'id', [
                'eq' => ['email' => $_POST['email']]
            ]);
            $data = $data[0];
            if ($wam->dbm->insert('access_tokens', [
                'source' => 'website',
                'user' => $data->id,
                'token' => $token,
                'remember' => 0,
                'date' => $time,
                'ip_address' => $ip_address
            ])) {
                setcookie("token", $token, 0, '/');
                $json['status'] = 'success';
                $json['redirect'] = '/';
            }
        } else {
            $json['status'] = 'error';
            $json['message'] = 'Invalid email or password';
        }
    }
}

if ($an == "DELETE_X001") {
    $id = $_POST['id'];
    $con = 0;
    if (is_array($dbs[$at])) {
        $db = $dbs[$at]['delete'];
    } else {
        $db = $dbs[$at];
    }
    if ($wam->dbm->delete($db, [
        'eq' => ['id' => $id]
    ])) {
        $itemId = $id;
        $x = [
            'id' => $id,
            'at' => $at
        ];
        $json[] = $wam->emr->success('Deleted');
        $json[] = $wam->emr->func('deleteCopmleted', $x);
    }
}

if ($itemId !== 0) {
    if ($an == 'DELETE_X001') {
        $at = '3';
    }
    $wam->dbm->insert("changelog", [
        "actionName" => $an,
        "actionType" => $at,
        "itemId" => $itemId,
        "user" => $_SESSION['userId'],
        "date" => $time
    ]);
}
