<?php
$category = $wam->dbm->getData('categories', '*', [
    'eq' => ['id' => $dir5]
]);
$category = $category[0];
?>
<div class="modal-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="pull-left">
                <h4>تعديل تصنيف</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off">
    <input type="hidden" name="actionName" value="EDIT_CATEGORY" />
    <input type="hidden" name="id" value="<?php echo $category->id; ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_ar">الاسم (عربي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_ar" class="form-control form-control-line name_ar" id="name_ar" placeholder="الاسم (عربي)" value="<?php echo $category->name_ar; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_en">الاسم (الإنجليزي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_en" class="form-control form-control-line name_en" id="name_en" placeholder="الاسم (الإنجليزي)" value="<?php echo $category->name_en; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_tr">الاسم (تركي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_tr" class="form-control form-control-line name_tr" id="name_tr" placeholder="الاسم (تركي)" value="<?php echo $category->name_tr; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="slug">رابط التصنيف</label>
                    <div class="col-md-12">
                        <input type="text" name="slug" class="form-control form-control-line slug" id="slug" placeholder="رابط التصنيف" value="<?php echo $category->slug; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="icon">
                        الأيقونة
                        (
                        <a href="<?php echo $category->icon; ?>" target="_blank" class="btn btn-info btn-sm">فتح</a>
                        )
                    </label>
                    <div class="col-md-12">
                        <input type="file" name="icon" class="form-control form-control-line icon" id="icon" placeholder="الأيقونة" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="cover">
                        الكفر
                        (
                        <a href="<?php echo $category->cover; ?>" target="_blank" class="btn btn-info btn-sm">فتح</a>
                        )
                    </label>
                    <div class="col-md-12">
                        <input type="file" name="cover" class="form-control form-control-line cover" id="cover" placeholder="الكفر" />
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