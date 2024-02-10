<?php
if ($complex = $wam->dbm->getData('realestate_complexes_details', '*', ['eq' => ['complex' => $dir6, 'lang' => $dir5]])) {
    $complex = $complex[0];
}
$dLang = [
    'ar' => 'العربية',
    'en' => 'الإنكليزية',
    'tr' => 'التركية',
][$dir5];
?>
<div class="modal-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="pull-left">
                <h4>تفاصيل المجمع <?php echo $dLang; ?></h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off">
    <input type="hidden" name="actionName"
        value="<?php echo ($complex) ? 'EDIT_COMPLEX_DETAILS' : 'NEW_COMPLEX_DETAILS'; ?>" />
    <input type="hidden" name="complex" value="<?php echo $dir6; ?>" />
    <input type="hidden" name="lang" value="<?php echo $dir5; ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-md-12" for="name">اسم المجمع</label>
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control form-control-line name" id="name"
                            value="<?php echo ($complex->name) ? $complex->name : ''; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-md-12" for="short_desc">الوصف المختصر</label>
                    <div class="col-md-12">
                        <textarea name="short_desc" class="tinymce short_desc text-count" data-length="160"
                            id="short_desc"><?php echo ($complex->short_desc) ? $complex->short_desc : ''; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-md-12" for="address">عنوان المجمع</label>
                    <div class="col-md-12">
                        <textarea name="address" class="form-control form-control-line address"
                            id="address"><?php echo ($complex->address) ? $complex->address : ''; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-md-12" for="details">تفاصيل اضافية</label>
                    <div class="col-md-12">
                        <textarea name="details" class="tinymce details"
                            id="details"><?php echo ($complex->details) ? $complex->details : ''; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-md-12" for="keywords">الكلمات الدلالية</label>
                    <div class="col-md-12">
                        <textarea name="keywords" class="form-control form-control-line keywords"
                            id="keywords"><?php echo ($complex->keywords) ? $complex->keywords : ''; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light">اتمام الطلب</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal"
            aria-hidden="true">الغاء</button>
    </div>
</form>
