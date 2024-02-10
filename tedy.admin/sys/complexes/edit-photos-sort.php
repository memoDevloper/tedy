<?php
$items = $wam->dbm->getData('realestate_media', 'id, compressed, url, item', [
    'eq' => ['type' => $dir6, 'item' => $dir5, 'section' => 'complexes'],
    'order' => ['sort']
]);
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل ترتيب الصور</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="EDIT_COMPLEXES_PHOTOS_SORT" />
    <input type="hidden" name="complex" value="<?php echo $dir5; ?>" />
    <input type="hidden" name="type" value="<?php echo $dir6; ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row" >
                    <div class="col-md-8 col-md-offset-2">
                        <ul class="sortable">
                            <?php
                            foreach ($items as $item){
                                ?>
                                <li>
                                    <input type="hidden" name="sort[]" value="<?php echo $item->id; ?>" />
                                    <i class="ti-list determiner" ></i>
                                    <img src="<?php echo $item->compressed ? $item->compressed : $item->url; ?>" height="50px" />
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
        <button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="COMPLEXES/edit-photo" actionItem="<?php echo $dir5; ?>">إلغاء</button>
    </div>
</form>