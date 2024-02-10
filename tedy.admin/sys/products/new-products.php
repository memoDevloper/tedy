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
    <input type="hidden" name="actionName" value="NEW_PRODUCTS" />
    <input type="hidden" name="category" value="<?php echo $category->id; ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="names_tr">الاسم (تركي)</label>
                    <div class="col-md-12">
                        <textarea name="names_tr" class="form-control form-control-line names_tr" id="names_tr" placeholder="الاسم (تركي)"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="prices">السعر</label>
                    <div class="col-md-12">
                        <textarea name="prices" class="form-control form-control-line prices" id="prices" placeholder="السعر"></textarea>
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