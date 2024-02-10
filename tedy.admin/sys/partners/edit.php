<?php
$partner = $wam->dbm->getData('partners', '*', [
    'eq' => ['id' => $dir5]
]);
$partner = $partner[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل معلومات شريك</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="EDIT_PARTNER" />
    <input type="hidden" name="id" value="<?php echo $partner->id; ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_ar">الاسم (عربي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_ar" class="form-control form-control-line name_ar" id="name_ar" placeholder="الاسم (عربي)" value="<?php echo $partner->name_ar; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_en">الاسم (الإنجليزي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_en" class="form-control form-control-line name_en" id="name_en" placeholder="الاسم (الإنجليزي)" value="<?php echo $partner->name_en; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_tr">الاسم (تركي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_tr" class="form-control form-control-line name_tr" id="name_tr" placeholder="الاسم (تركي)" value="<?php echo $partner->name_tr; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="url">رابط الصفحة</label>
                    <div class="col-md-12">
                        <input type="text" name="url" class="form-control form-control-line url" id="url" placeholder="رابط الصفحة" value="<?php echo $partner->url; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="logo">الشعار <?php echo $partner->logo ? "(<a href='$partner->logo' target='_blank'>فتح</a>)" : ''; ?></label>
                    <div class="col-md-12">
                        <input type="file" name="logo" class="form-control form-control-line logo" id="logo" placeholder="الشعار" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light" >تعديل</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">الغاء</button>
    </div>
</form>