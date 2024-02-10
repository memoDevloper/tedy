<?php
$material = $wam->dbm->getData('materials', '*', ['eq' => ['id' => $dir5]]);
$material = $material[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>جدول استلام مادة: <?php echo $material->name; ?></h4>
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
                                <th>رقم المناقلة</th>
                                <th>تاريخ الاستلام</th>
                                <th>المركز</th>
                                <th>الموَّرد</th>
                                <th>الكمية</th>
                                <th>الجودة</th>
                                <th>الملاحظات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $quantities = $wam->dbm->getData('materials_quantities A', [
                                'A.id',
                                '(SELECT name FROM centers WHERE id = A.center) as center',
                                '(SELECT name FROM suppliers WHERE id = A.supplier) as supplier',
                                'A.quantity',
                                'A.quality',
                                'A.notes',
                                'A.date',
                            ], [
                                'eq' => ['A.material' => $material->id],
                                'order' => ['A.date DESC'],
                            ]);
                            foreach ($quantities as $key => $quantity) {
                                ?>
                                <tr class="item" >
                                    <td><b><?php echo $quantity->id; ?></b></td>
                                    <td><?php echo date('d/m/Y', $quantity->date); ?></td>
                                    <td><?php echo $quantity->center; ?></td>
                                    <td><?php echo $quantity->supplier; ?></td>
                                    <td><?php echo $quantity->quantity; ?></td>
                                    <td><?php echo $material_qualities[$quantity->quality]; ?></td>
                                    <td><?php echo $quantity->notes; ?></td>
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
    <button type="button" class="btn btn-success waves-effect waves-light DIM" actionName="MATERIALS/new-quantity" actionItem="<?php echo $material->id; ?>">اضافة دفعة استلام</button>
    <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">اغلاق</button>
</div>