<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المدن</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active">المدن</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">ادارة المدن</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                            <tr>
                                <th>اسم المدينة</th>
                                <th>اسم المدينة العربي</th>
                                <th>عدد الأحياء</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cities = $wam->dbm->getData('cities A', [
                                'A.id',
                                'A.name_tr',
                                'A.name_ar',
                            ], [
                                'order' => ['name_tr'],
                            ]);
                            foreach ($cities as $key => $city) {
                                $districts = $wam->dbm->rows('districts', ['eq' => ['city' => $city->id]]);
                                ?>
                                <tr class="item" >
                                    <td><?php echo $city->name_tr ?></td>
                                    <td><?php echo $city->name_ar ?></td>
                                    <td><?php echo $districts; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="CITIES/districts" actionItem="<?php echo $city->id; ?>">الأحياء</button>
                                        <button type="button" class="btn btn-danger btn-circle waves-effect waves-light DIM" actionName="CITIES/edit" actionItem="<?php echo $city->id; ?>"><i class="fa fa-pencil" ></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>