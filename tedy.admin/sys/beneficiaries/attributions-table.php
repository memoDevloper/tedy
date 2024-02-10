<?php
$beneficiary = $wam->dbm->getData('beneficiaries', 'id, name, name_ar', ['eq' => ['id' => $dir5]]);
$beneficiary = $beneficiary[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>جدول اسناد البطاقات: <?php echo $beneficiary->name_ar; ?> - <?php echo $beneficiary->name; ?></h4>
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
                                <th>رقم البطاقة</th>
                                <th>QR</th>
                                <th>تاريخ الاسناد</th>
                                <th>اللون</th>
                                <th>الحالة</th>
                                <th>النوع</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cards = $wam->dbm->getData('cards A', [
                                'A.id',
                                'A.type',
                                'A.color',
                                'A.qr_code',
                                'A.beneficiary',
                                'A.status',
                                'A.date',
                            ], [
                                'eq' => ['beneficiary' => $beneficiary->id],
                                'order' => ['id DESC'],
                            ]);
                            foreach ($cards as $key => $card) {
                                ?>
                                <tr class="item" >
                                    <td><?php echo $card->id ?></td>
                                    <td><a href="/<?php echo $card->qr_code ?>" target="_blank" ><img src="/<?php echo $card->qr_code ?>" alt="<?php echo $beneficiary->name; ?>" width="50" /></a></td>
                                    <td><?php echo date('d/m/Y', $card->date); ?></td>
                                    <td><?php echo $card_colors[$card->color] ?></td>
                                    <td>
                                        <div class="form-group" >
                                            <input type="checkbox" class="js-switch" change-properity data-action="CARD_STATUS" data-item-id="<?php echo $card->id ?>" <?php echo ($card->status) ? 'checked' : ''; ?> data-color="#f96262" />
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        switch ($card->type){
                                            case "instead-lost":
                                                echo 'بدل ضائع';
                                                break;
                                            case "new":
                                                echo 'بطاقة جديدة';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td></td>
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
    <button type="button" class="btn btn-success waves-effect waves-light DIM" actionName="CARDS/add-new" actionItem="<?php echo $beneficiary->id; ?>">اسناد بطاقة جديدة</button>
    <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">اغلاق</button>
</div>