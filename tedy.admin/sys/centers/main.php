<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المراكز</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM" actionName="CENTERS" actionItem="new">اضافة مركز</button>
            <ol class="breadcrumb">
                <li class="active">المراكز</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">ادارة المراكز</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>اسم المركز</th>
                            <th>عقد الإيجار</th>
                            <th>اشتراك الكهرباء</th>
                            <th>اشتراك الماء</th>
                            <th>اشتراك الاترنت</th>
                            <th>الخيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $centers = $wam->dbm->getData('centers A', [
                            'A.id',
                            'A.name',
                            'A.rent_contract',
                            'A.electricity_no',
                            'A.water_no',
                            'A.internet_no',
                        ], [
                            'order' => ['id DESC'],
                        ]);
                        foreach ($centers as $key => $center) {
                            ?>
                            <tr class="item" >
                                <td><?php echo $center->name ?></td>
                                <td><a href="/<?php echo $center->rent_contract ?>" target="_blank" ><i class="fa fa-paper-plane" ></i></a></td>
                                <td><?php echo $center->electricity_no ?></td>
                                <td><?php echo $center->water_no ?></td>
                                <td><?php echo $center->internet_no ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="CENTERS/view" actionItem="<?php echo $center->id; ?>">عرض البيانات</button>
                                    <button type="button" class="btn btn-danger btn-circle waves-effect waves-light DIM" actionName="CENTERS/edit" actionItem="<?php echo $center->id; ?>"><i class="fa fa-pencil" ></i></button>
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