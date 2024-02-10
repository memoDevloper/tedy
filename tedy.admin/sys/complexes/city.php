<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">مدينة <?php echo $city->name_ar; ?></h4>
        </div>
        <a href="/complexes/new/<?php echo $city->id; ?>" type="button" class="btn btn-warning pull-right m-l-20 waves-effect waves-light CPB">مجمع جديد</a>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="/complexes" class="CPB" >المجمعات السكنية</a></li>
                <li class="active"><?php echo $city->name_ar; ?></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">ادارة مجمعات <?php echo $city->name_ar; ?></div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table" data-table id="complexsTables">
                        <thead>
                        <tr>
                            <th>رقم المجمع</th>
                            <th>اسم المجمع</th>
                            <th>اسم المجمع التركي</th>
                            <th>المنطقة</th>
                            <th>الخيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $complexes = $wam->dbm->getData('realestate_complexes A', [
                            'A.id',
                            'A.photo',
                            '(SELECT name FROM realestate_complexes_details WHERE complex = A.id AND lang = "ar") as name_ar',
                            '(SELECT name FROM realestate_complexes_details WHERE complex = A.id AND lang = "tr") as name_tr',
                            '(SELECT name_tr FROM districts WHERE id = A.district) as district',
                        ], [
                            'eq' => ['A.city' => $city->id],
                            'order' => ['A.id']
                        ]);
                        $r = 1;
                        foreach ($complexes as $key => $complex) {
                            $complex->photo = str_ireplace('www.alrawi.co', 'cdn.alrawiemlak.com', $complex->photo);
                            ?>
                            <tr class="item">
                                <td><?php echo $r; ?></td>
                                <td><?php echo $complex->name_ar ?></td>
                                <td><?php echo $complex->name_tr ?></td>
                                <td><?php echo $complex->district ?></td>
                                <td>
                                    <a href="/complexes/edit/<?php echo $complex->id; ?>" class="btn btn-info btn-circle waves-effect waves-light CPB" ><i class="fa fa-pencil"></i></a>
                                    <a href="/complexes/items/<?php echo $complex->id; ?>" class="btn btn-info btn-circle waves-effect waves-light CPB" ><i class="fa fa-list"></i></a>
                                    <button type="button" class="btn <?php echo ($wam->dbm->check('realestate_complexes_details', ['eq' => ['complex' => $complex->id, 'lang' => 'ar']])) ? 'btn-danger' : ''; ?> btn-circle waves-effect waves-light DIM" actionName="COMPLEXES/details/ar" actionItem="<?php echo $complex->id; ?>">AR</button>
                                    <button type="button" class="btn <?php echo ($wam->dbm->check('realestate_complexes_details', ['eq' => ['complex' => $complex->id, 'lang' => 'en']])) ? 'btn-danger' : ''; ?> btn-circle waves-effect waves-light DIM" actionName="COMPLEXES/details/en" actionItem="<?php echo $complex->id; ?>">EN</button>
                                    <button type="button" class="btn <?php echo ($wam->dbm->check('realestate_complexes_details', ['eq' => ['complex' => $complex->id, 'lang' => 'tr']])) ? 'btn-danger' : ''; ?> btn-circle waves-effect waves-light DIM" actionName="COMPLEXES/details/tr" actionItem="<?php echo $complex->id; ?>">TR</button>
                                    <button type="button" class="btn <?php echo ($wam->dbm->check('realestate_complexes_details', ['eq' => ['complex' => $complex->id, 'lang' => 'ar']])) ? 'btn-danger' : ''; ?> btn-circle waves-effect waves-light DIM" actionName="COMPLEXES/edit-photo" actionItem="<?php echo $complex->id; ?>"><i class="fa fa-image"></i></button>
                                    <button type="button" class="btn btn-info btn-circle waves-effect waves-light DIM" actionName="COMPLEXES/vr" actionItem="<?php echo $complex->id; ?>"><i class="fas fa-vr-cardboard"></i></button>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_COMPLEX" data-item-id="<?php echo $complex->id; ?>"><i class="ti-trash"></i></button>
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