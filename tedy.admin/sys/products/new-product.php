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
                <h4>اضافة منتج جديد</h4>
                <h4><?php echo $category->name_tr ?></h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off">
    <input type="hidden" name="actionName" value="NEW_PRODUCT" />
    <input type="hidden" name="category" value="<?php echo $category->id; ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_ar">الاسم (عربي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_ar" class="form-control form-control-line name_ar" id="name_ar" placeholder="الاسم (عربي)" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="desc_ar">الوصف (عربي)</label>
                    <div class="col-md-12">
                        <textarea name="desc_ar" class="form-control form-control-line desc_ar" id="desc_ar" placeholder="الوصف (عربي)"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_en">الاسم (الإنجليزي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_en" class="form-control form-control-line name_en" id="name_en" placeholder="الاسم (الإنجليزي)" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="desc_en">الوصف (الإنجليزي)</label>
                    <div class="col-md-12">
                        <textarea name="desc_en" class="form-control form-control-line desc_en" id="desc_en" placeholder="الوصف (الإنجليزي)"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_tr">الاسم (تركي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_tr" class="form-control form-control-line name_tr" id="name_tr" placeholder="الاسم (تركي)" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="desc_tr">الوصف (تركي)</label>
                    <div class="col-md-12">
                        <textarea name="desc_tr" class="form-control form-control-line desc_tr" id="desc_tr" placeholder="الوصف (تركي)"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="price">االسعر</label>
                    <div class="col-md-12">
                        <input type="number" name="price" class="form-control form-control-line price" id="price" placeholder="السعر" step="0.10" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="icon">الأيقونة</label>
                    <div class="col-md-12">
                        <input type="file" name="icon" class="form-control form-control-line icon" id="icon" placeholder="الأيقونة" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light">اضافة</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">الغاء</button>
    </div>
</form>