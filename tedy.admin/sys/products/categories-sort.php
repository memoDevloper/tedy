<?php
$items = $wam->dbm->getData('categories A', [
    'A.id',
    'A.name_tr as name',
], [
    'order' => ['A.sort'],
]);
?>
<div class="modal-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="pull-left">
                <h4>تعديل ترتيب التصنيفات</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off">
    <input type="hidden" name="actionName" value="EDIT_CATEGORIES_SORT" />
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <ul class="sortable">
                            <?php
                            foreach ($items as $item) {
                            ?>
                                <li>
                                    <input type="hidden" name="sort[]" value="<?php echo $item->id; ?>" />
                                    <i class="ti-list determiner"></i>
                                    <span><?php echo $item->name; ?></span>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light">تعديل</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">إلغاء</button>
    </div>
</form>