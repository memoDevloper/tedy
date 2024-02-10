<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل مدينة</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<?php
$city = $wam->dbm->getData('cities', '*', ['qe' => ['id' => $dir5]]);
$city = $city[0];
?>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="EDIT_CITY" />
    <input type="hidden" name="id" value="<?php echo $city->id ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_tr">اسم المدينة التركية</label>
                    <div class="col-md-12">
                        <input type="text" name="name_tr" class="form-control form-control-line name_tr" id="name_tr" value="<?php echo $city->name_tr ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_en">اسم المدينة الإنجليزي</label>
                    <div class="col-md-12">
                        <input type="text" name="name_en" class="form-control form-control-line name_en" id="name_en" value="<?php echo $city->name_en ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_ar">اسم المدينة العربي</label>
                    <div class="col-md-12">
                        <input type="text" name="name_ar" class="form-control form-control-line name_ar" id="name_ar" value="<?php echo $city->name_ar ?>" />
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