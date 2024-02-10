<?php
$product = $wam->dbm->getData('products', '*', [
    'eq' => ['id' => $dir5]
]);
$product = $product[0];
$category = $wam->dbm->getData('categories', '*', [
    'eq' => ['id' => $product->category]
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
    <input type="hidden" name="actionName" value="EDIT_PRODUCT" />
    <input type="hidden" name="id" value="<?php echo $product->id; ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_ar">الاسم (عربي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_ar" class="form-control form-control-line name_ar" id="name_ar" placeholder="الاسم (عربي)" value="<?php echo $product->name_ar ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="desc_ar">الوصف (عربي)</label>
                    <div class="col-md-12">
                        <textarea name="desc_ar" class="form-control form-control-line desc_ar" id="desc_ar" placeholder="الوصف (عربي)"><?php echo $product->desc_ar ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_en">الاسم (الإنجليزي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_en" class="form-control form-control-line name_en" id="name_en" placeholder="الاسم (الإنجليزي)" value="<?php echo $product->name_en ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="desc_en">الوصف (الإنجليزي)</label>
                    <div class="col-md-12">
                        <textarea name="desc_en" class="form-control form-control-line desc_en" id="desc_en" placeholder="الوصف (الإنجليزي)"><?php echo $product->desc_en ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name_tr">الاسم (تركي)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_tr" class="form-control form-control-line name_tr" id="name_tr" placeholder="الاسم (تركي)" value="<?php echo $product->name_tr ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="desc_tr">الوصف (تركي)</label>
                    <div class="col-md-12">
                        <textarea name="desc_tr" class="form-control form-control-line desc_tr" id="desc_tr" placeholder="الوصف (تركي)"><?php echo $product->desc_tr ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="price">االسعر</label>
                    <div class="col-md-12">
                        <input type="number" name="price" class="form-control form-control-line price" id="price" placeholder="السعر" step="0.10" value="<?php echo $product->price ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="icon">
                        الأيقونة
                        (
                        <a href="<?php echo $product->icon; ?>" target="_blank" class="btn btn-info btn-sm">فتح</a>
                        )
                    </label>
                    <div class="col-md-12">
                        <input type="file" name="icon" class="form-control form-control-line icon" id="icon" placeholder="الأيقونة" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="category">التصنيف</label>
                    <div class="col-md-12">
                        <select name="category" class="form-control form-control-line category" id="category">
                            <option value="0">لا يوجد</option>
                            <?php
                            $subCategories = $wam->dbm->getData('categories A', [
                                'A.id',
                                'A.name_tr as name'
                            ], [
                                'order' => ['A.sort']
                            ]);
                            foreach ($subCategories as $subCategory) {
                            ?>
                                <option value="<?php echo $subCategory->id; ?>" <?php echo $subCategory->id == $product->category ? 'selected' : ''; ?>>
                                    <?php echo $subCategory->name; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
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