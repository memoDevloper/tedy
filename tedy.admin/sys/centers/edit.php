<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل مركز</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<?php
$center = $wam->dbm->getData('centers', '*', ['qe' => ['id' => $dir5]]);
$center = $center[0];
?>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="EDIT_CENTER" />
    <input type="hidden" name="id" value="<?php echo $center->id ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name">اسم المركز</label>
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control form-control-line name" id="name" value="<?php echo $center->name ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="rent_contract">عقد الإيجار</label>
                    <div class="col-md-12">
                        <input type="file" name="rent_contract" class="form-control form-control-line rent_contract" id="rent_contract" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="electricity_no">رقم اشتراك الكهرباء</label>
                    <div class="col-md-12">
                        <input type="text" name="electricity_no" class="form-control form-control-line electricity_no" id="electricity_no" value="<?php echo $center->electricity_no ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="water_no">رقم اشتراك الماء</label>
                    <div class="col-md-12">
                        <input type="text" name="water_no" class="form-control form-control-line water_no" id="water_no" value="<?php echo $center->water_no ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="internet_no">رقم اشتراك الانترنت</label>
                    <div class="col-md-12">
                        <input type="text" name="internet_no" class="form-control form-control-line internet_no" id="internet_no" value="<?php echo $center->internet_no ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="address">العنوان</label>
                    <div class="col-md-12">
                        <textarea name="address" class="form-control form-control-line address" id="address" ><?php echo $center->address ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="notes">ملاحظات اضافية</label>
                    <div class="col-md-12">
                        <textarea name="notes" class="form-control form-control-line notes" id="notes" ><?php echo $center->notes ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light" >اتمام الطلب</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">الغاء</button>
    </div>
</form>