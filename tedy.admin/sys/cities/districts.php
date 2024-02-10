<?php
$city = $wam->dbm->getData('cities', 'id, name_ar, name_tr', ['eq' => ['id' => $dir5]]);
$city = $city[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>أحياء مدينة: <?php echo $city->name_ar; ?> - <?php echo $city->name_tr; ?></h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<div class="modal-body">
    <div class="row" >
        <div class="col-md-12" >
            <div class="panel">
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>اسم الحي</th>
                            <th>اسم الحي العربي</th>
                            <th>الخيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $districts = $wam->dbm->getData('districts A', [
                            'A.id',
                            'A.name_ar',
                            'A.name_tr',
                        ], [
                            'eq' => ['city' => $city->id],
                            'order' => ['name_tr'],
                        ]);
                        foreach ($districts as $key => $district) {
                            ?>
                            <tr class="item" >
                                <td><?php echo $district->name_tr ?></td>
                                <td><?php echo $district->name_ar ?></td>
                                <td>

                                    <button type="button" class="btn btn-danger btn-circle waves-effect waves-light DIM" actionName="CITIES/edit-district" actionItem="<?php echo $district->id; ?>"><i class="fa fa-pencil" ></i></button>
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
<div class="modal-footer">
    <button type="button" class="btn btn-success waves-effect waves-light DIM" actionName="CITIES/new-district" actionItem="<?php echo $city->id; ?>">اضافة حي جديد</button>
    <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">اغلاق</button>
</div>