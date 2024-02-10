<?php
$currency = $wam->dbm->getData('currencies', ['*'], ['eq' => ['id' => $dir5]]);
$currency = $currency[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل عملة</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="EDIT_CURRENCY" />
    <input type="hidden" name="id" value="<?php echo $currency->id; ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_ar">اسم العملة العربي</label>
                    <div class="col-md-12">
                        <input type="text" name="name_ar" class="form-control form-control-line name_ar" id="name_ar" value="<?php echo $currency->name_ar; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_en">اسم العملة الإنجليزي</label>
                    <div class="col-md-12">
                        <input type="text" name="name_en" class="form-control form-control-line name_en" id="name_en" value="<?php echo $currency->name_en; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_tr">اسم العملة التركي</label>
                    <div class="col-md-12">
                        <input type="text" name="name_tr" class="form-control form-control-line name_tr" id="name_tr" value="<?php echo $currency->name_tr; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="code">رمز العملة</label>
                    <div class="col-md-12">
                        <input type="text" name="code" class="form-control form-control-line code" id="code" value="<?php echo $currency->code; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <?php
        if($currency->code !== 'usd'){
            ?>
            <div class="row">
                <div class="col-md-6" >
                    <div class="form-group">
                        <label class="col-md-12" for="rate">سعر الصرف مقابل الدولار</label>
                        <div class="col-md-12">
                            <input type="number" step="any" name="rate" class="form-control form-control-line rate" id="rate" value="<?php echo $currency->rate; ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light" >تعديل</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true" >إلغاء</button>
    </div>
</form>