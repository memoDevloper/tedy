<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المواد</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM" actionName="MATERIALS" actionItem="new">اضافة مادة</button>
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM" actionName="MATERIALS" actionItem="new-quantity">استلام دفعة مواد</button>
            <ol class="breadcrumb">
                <li class="active">المواد</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">ادارة المواد</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>اسم المادة</th>
                            <th>وحدة القياس</th>
                            <th>تاريخ الاضافة</th>
                            <th>الخيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $materials = $wam->dbm->getData('materials A', [
                            'A.id',
                            'A.name',
                            'A.unit',
                            'A.date',
                        ], [
                            'order' => ['name'],
                        ]);
                        foreach ($materials as $key => $material) {
                            ?>
                            <tr class="item" >
                                <td><?php echo $material->name ?></td>
                                <td><?php echo $material->unit ?></td>
                                <td><?php echo date('d/m/Y', $material->date); ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="MATERIALS/quantities" actionItem="<?php echo $material->id; ?>">جدول الاستلام</button>
                                    <button type="button" class="btn btn-danger btn-circle waves-effect waves-light DIM" actionName="MATERIALS/edit" actionItem="<?php echo $material->id; ?>"><i class="fa fa-pencil" ></i></button>
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