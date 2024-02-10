<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">الصور العشوائية</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active">الصور العشوائية</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">الصور العشوائية</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table" data-table id="randomPhotosTables">
                        <thead>
                        <tr>
                            <th>رقم المجمع</th>
                            <th>اسم المجمع</th>
                            <th>الصور</th>
                            <th>الخيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
//                        $complexes = $wam->dbm->getData(['realestate_complexes A', 'realestate_media B'], [
//                            'A.id',
//                            'A.photo',
//                            '(SELECT name FROM realestate_complexes_details WHERE complex = A.id AND lang = "ar") as name_ar',
//                            '(SELECT name FROM realestate_complexes_details WHERE complex = A.id AND lang = "tr") as name_tr',
//                            '(SELECT name_tr FROM districts WHERE id = A.district) as district',
//                        ], [
//                            'join' => [
//                                'on' => ['A.id', 'B.item'],
//                                'type' => ['right']
//                            ],
//                            'eq' => ['B.on_gallery' => 1],
//                            'order' => ['A.id'],
//                        ]);
                        $complexes = $wam->dbm->query("
                            SELECT
                                A.id,
                                A.photo,
                                (SELECT name FROM realestate_complexes_details WHERE complex = A.id AND lang = 'ar') as name_ar,
                                (SELECT name FROM realestate_complexes_details WHERE complex = A.id AND lang = 'tr') as name_tr,
                                (SELECT name_tr FROM districts WHERE id = A.district) as district
                            FROM realestate_complexes A
                            RIGHT JOIN realestate_media B
                            ON A.id = B.item
                            WHERE B.on_gallery = 1
                            GROUP BY B.item
                        ");
                        $r = 1;
                        foreach ($complexes as $key => $complex) {
                            $complex->photo = str_ireplace('www.alrawi.co', 'cdn.alrawiemlak.com', $complex->photo);
                            $photos = $wam->dbm->getData('realestate_media', 'url', [
                                    'eq' => ['item' => $complex->id, 'on_gallery' => 1]
                            ]);
                            ?>
                            <tr class="item">
                                <td><?php echo $r; ?></td>
                                <td><?php echo $complex->name_ar ?></td>
                                <td>
                                    <?php
                                    foreach ($photos as $photo){
                                        ?>
                                        <a href="<?php echo $photo->url ?>" target="_blank">
                                            <img src="<?php echo $photo->url ?>" height="64" />
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-circle waves-effect waves-light DIM" actionName="COMPLEXES/random-photos" actionItem="<?php echo $complex->id; ?>"><i class="fa fa-image"></i></button>
                                </td>
                            </tr>
                            <?php
                            ++$r;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>