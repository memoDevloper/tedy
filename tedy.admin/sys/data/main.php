<?php

use PHPMailer\PHPMailer\PHPMailer;

if ($dir3 == 'blog') {
    if ($dir4 == '') {
        $data = [];
        $blogs = $wam->dbm->getData('blogs A', [
            'A.id',
            'A.name',
            'A.blog',
            'A.date',
            'A.photo',
            'A.slug'
        ], [
            'order' => ['A.date DESC']
        ]);
        $blogsArray = [];
        foreach ($blogs as $blog) {
            $blogsArray[] = [
                'id' => $blog->id,
                'name' => $blog->name,
                'photo' => $blog->photo,
                'date' => date('d/m/Y', $blog->date),
                'slug' => $blog->slug ? $blog->slug : $blog->id
            ];
        }
        $json['blogs'] = $blogsArray;
    } elseif ($blog = $wam->dbm->getData('blogs', '*', ['eqo' => ['id' => $dir4, 'slug' => $dir4]])) {
        $blog = $blog[0];
        $json['blog'] = [
            'id' => $blog->id,
            'name' => $blog->name,
            'photo' => $blog->photo,
            'date' => date('d/m/Y', $blog->date),
            'slug' => $blog->slug ? $blog->slug : $blog->id,
            'blog' => $blog->blog,
            'keywords' => $blog->keywords,
        ];
    }
} elseif ($dir3 == 'partners') {
    $partners = $wam->dbm->getData('partners A', [
        'A.name_ar as name',
        'A.logo',
        'A.url'
    ], [
        'order' => ['A.date DESC']
    ]);
    foreach ($partners as $partner) {
        $json['partners'][] = [
            'name' => $partner->name,
            'logo' => 'https://admin.axismediapro.com/' . $partner->logo,
            'url' => $partner->url
        ];
    }
} elseif ($dir3 == 'home') {
    $partners = $wam->dbm->getData('partners A', [
        'A.name_ar as name',
        'A.logo',
        'A.url'
    ], [
        'order' => ['A.date DESC']
    ]);
    foreach ($partners as $partner) {
        $json['partners'][] = [
            'name' => $partner->name,
            'logo' => 'https://admin.axismediapro.com/' . $partner->logo,
            'url' => $partner->url
        ];
    }
    $works = $wam->dbm->getData('works A', [
        'A.id',
        'A.name',
        'A.photo',
        'A.section',
        'A.description',
    ], [
        'order' => ['A.date DESC'],
        'limit' => ['12'],
    ]);
    foreach ($works as $work) {
        $items = $wam->dbm->getData('work_items', ['*'], [
            'eq' => ['work' => $work->id]
        ]);
        $work->url = $url[0]->url;
        $json['works'][] = [
            'title' => $work->name,
            'background' => $work->photo,
            'section' => $work->section,
            'items' => $items,
            'id' => $work->id,
            'description' => $work->description
        ];
    }
    $blogs = $wam->dbm->getData('blogs A', [
        'A.id',
        'A.name',
        'A.blog',
        'A.date',
        'A.photo',
        'A.slug'
    ], [
        'order' => ['A.date DESC'],
        'limit' => ['5'],
    ]);
    $blogsArray = [];
    foreach ($blogs as $blog) {
        $blogsArray[] = [
            'id' => $blog->id,
            'name' => $blog->name,
            'photo' => $blog->photo,
            'date' => date('d/m/Y', $blog->date),
            'slug' => $blog->slug ? $blog->slug : $blog->id
        ];
    }
    $json['blogs'] = $blogsArray;
    $statisticsData = $wam->dbm->getData('statistics A', [
        'A.id',
        'A.name',
        'A.value',
    ]);
    $statistics = [];
    foreach ($statisticsData as $statistic) {
        $statistics[$statistic->name] = $statistic->value;
    }
    $json['statistics'] = $statistics;
} elseif ($dir3 == 'works') {
    $works = $wam->dbm->getData('works A', [
        'A.id',
        'A.name',
        'A.photo',
        'A.section',
        'A.description',
    ], [
        'eq' => ['A.section' => $dir4],
        'order' => ['A.date DESC']
    ]);
    foreach ($works as $work) {
        $items = $wam->dbm->getData('work_items', ['*'], [
            'eq' => ['work' => $work->id]
        ]);
        $work->url = $url[0]->url;
        $json['works'][] = [
            'title' => $work->name,
            'background' => $work->photo,
            'section' => $work->section,
            'items' => $items,
            'id' => $work->id,
            'description' => $work->description
        ];
    }
} elseif ($dir3 == 'get-work') {
    $work = $wam->dbm->getData('works A', [
        'A.id',
        'A.name',
        'A.photo',
        'A.section',
        'A.description',
    ], [
        'eq' => ['A.id' => $dir4],
        'order' => ['A.date DESC']
    ]);
    $work = $work[0];
    $items = $wam->dbm->getData('work_items', ['*'], [
        'eq' => ['work' => $work->id]
    ]);
    $work->url = $url[0]->url;
    $json['work'] = [
        'title' => $work->name,
        'background' => $work->photo,
        'section' => $work->section,
        'items' => $items,
        'id' => $work->id,
        'description' => $work->description
    ];
} elseif ($dir3 == 'sitemap') {
    $blogsData = $wam->dbm->getData('blogs A', [
        'A.id',
        'A.slug',
        'A.date',
    ], [
        'order' => ['A.date DESC'],
    ]);
    $blogs = [];
    foreach ($blogsData as $blog) {
        $blogs[] = [
            'id' => $blog->slug ? $blog->slug : $blog->id,
            'date' => date('d/m/Y', $blog->date),
        ];
    }
    $works = $wam->dbm->getData('works A', [
        'A.id',
        'A.section',
    ], []);
    $json['blogs'] = $blogs;
    $json['works'] = $works;
} elseif ($dir3 == 'contact') {
    // send email
    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $phone = $_POST['phone'];
    // $message = $_POST['message'];
    // $to = 'walid.ajam.95@gmail.com';
    // $subject = 'Contact Us';
    // $body = "Name: $name <br> Email: $email <br> Phone: $phone <br> Message: $message";
    // $headers = array(
    //     "From: $name <$email>",
    //     "Reply-To: $email",
    //     "X-Mailer: PHP/" . PHP_VERSION,
    //     "Content-type: text/html"
    // );
    // $headers = implode("\r\n", $headers);
    // $send = mail($to, $subject, $body, $headers);
    // if ($send) {
    //     $json['status'] = 'success';
    // } else {
    //     $json['status'] = 'error';
    // }

    $_POST['message'] = nl2br($_POST['message']);
    $contents = "
        <table width='100%' dir='rtl'>
            <tr>
                <td>المصدر:</td>
                <td>Landing Page 1</td>
            </tr>
            <tr>
                <td>الاسم:</td>
                <td>[name]</td>
            </tr>
            <tr>
                <td>رقم الهاتف:</td>
                <td><a href='tel:[phone]' dir='ltr'>[phone]</a></td>
            </tr>
            <tr>
                <td>واتسآب:</td>
                <td><a href='https://wa.me/[whatsapp]' dir='ltr'>فتح واتسآب</a></td>
            </tr>
            <tr>
                <td>البريد الإلكتروني:</td>
                <td>[email]</td>
            </tr>
        </table>
    ";
    $whatsapp = str_ireplace('+', '', $_POST['phone']);
    $whatsapp = (int) $whatsapp;
    $contents = str_ireplace([
        '[name]', '[phone]', '[whatsapp]', '[email]',
    ], [
        $_POST['name'], $_POST['phone'], $whatsapp, $_POST['email'],
    ], $contents);

    $mail = new PHPMailer;
    // $mail->isSendmail();
    $mail->isSMTP();
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    // $mail->SMTPDebug  = 1; 
    $mail->Host = 'smtp.zoho.eu';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = 'info@axismediapro.com';
    $mail->Password = 'AxisMedia@112233';
    $mail->SMTPSecure = 'ssl';
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->setFrom('info@axismediapro.com', $_POST['name']);
    $mail->addAddress('oways.alshami1@gmail.com', $_POST['name']);
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'رسالة من: ' . $_POST['name'];
    $mail->AltBody = $_POST['message'];
    // $mail->Body    = $contents;
    $mail->msgHTML($contents, __DIR__);
    // $mail->SMTPOptions = [
    //     'ssl' => [
    //         'verify_peer' => false,
    //         'verify_peer_name' => false,
    //         'allow_self_signed' => true
    //     ]
    // ];
    if ($mail->send()) {
        $json['status'] = 'success';
    } else {
        $json['status'] = 'error';
        $json['message'] =  $mail->ErrorInfo;
    }
}
