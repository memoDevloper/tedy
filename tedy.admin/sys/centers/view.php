<?php
$center = $wam->dbm->getData('centers', '*', ['eq' => ['id' => $dir5]]);
$center = $center[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>عرض مركز</h4>
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
                        <tbody>
                            <tr>
                                <td width="30%" ><b>اسم المركز</b></td>
                                <td><?php echo $center->name ?></td>
                            </tr>
                            <tr>
                                <td><b>رقم فاتورة الكهرباء</b></td>
                                <td><?php echo $center->electricity_no ?></td>
                            </tr>
                            <tr>
                                <td><b>رقم فاتورة الماء</b></td>
                                <td><?php echo $center->water_no ?></td>
                            </tr>
                            <tr>
                                <td><b>رقم فاتورة الانترنت</b></td>
                                <td><?php echo $center->internet_no ?></td>
                            </tr>
                            <tr>
                                <td><b>العنوان</b></td>
                                <td><?php echo $center->address ?></td>
                            </tr>
                            <tr>
                                <td><b>ملاحظات اضافية</b></td>
                                <td><?php echo $center->notes ?></td>
                            </tr>
                            <tr>
                                <td><b>عقد الإيجار</b></td>
                                <td>
                                    <iframe src="/<?php echo $center->rent_contract ?>" width="100%" ></iframe>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">اغلاق</button>
</div>