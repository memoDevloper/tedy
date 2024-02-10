<?php
$slide = $wam->dbm->getData('slider', '*', [
    'eq' => ['id' => $dir5]
]);
$slide = $slide[0];
?>
<div class="modal-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="pull-left">
                <h4>تعديل سلايد</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off">
    <input type="hidden" name="actionName" value="EDIT_SLIDE" />
    <input type="hidden" name="id" value="<?php echo $slide->id; ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_tr">الاسم (تركي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_tr" class="form-control form-control-line name_tr" id="name_tr" placeholder="الاسم (تركي)" value="<?php echo $slide->name_tr; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="desc_tr">الشرح (تركي)</label>
                    <div class="col-md-12">
                        <textarea type="text" name="desc_tr" class="form-control form-control-line desc_tr" id="desc_tr" placeholder="الشرح (تركي)"><?php echo $slide->desc_tr; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_ar">الاسم (عربي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_ar" class="form-control form-control-line name_ar" id="name_ar" placeholder="الاسم (عربي)" value="<?php echo $slide->name_ar; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="desc_ar">الشرح (عربي)</label>
                    <div class="col-md-12">
                        <textarea type="text" name="desc_ar" class="form-control form-control-line desc_ar" id="desc_ar" placeholder="الشرح (عربي)"><?php echo $slide->desc_ar; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_en">الاسم (الإنجليزي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_en" class="form-control form-control-line name_en" id="name_en" placeholder="الاسم (الإنجليزي)" value="<?php echo $slide->name_en; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="desc_en">الشرح (الإنجليزي)</label>
                    <div class="col-md-12">
                        <textarea type="text" name="desc_en" class="form-control form-control-line desc_en" id="desc_en" placeholder="الشرح (الإنجليزي)"><?php echo $slide->desc_en; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="image">الصورة (<a href="<?php echo $slide->image ?>" target="_blank">فتح</a>)</label>
                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control form-control-line image" id="image" placeholder="الصورة" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="link">رابط الصفحة</label>
                    <div class="col-md-12">
                        <input type="text" name="link" class="form-control form-control-line link" id="link" placeholder="رابط الصفحة" value="<?php echo $slide->link; ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light">تعديل</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">الغاء</button>
    </div>
</form>