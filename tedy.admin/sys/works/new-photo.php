<?php
$work = $wam->dbm->getData('works', '*', [
    'eq' => ['id' => $dir5]
]);
$work = $work[0];
?>
<div class="modal-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="pull-left">
                <h4>اضافة صورة</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off">
    <input type="hidden" name="actionName" value="NEW_WORK_PHOTO" />
    <input type="hidden" name="work" value="<?php echo $work->id; ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="photo">الصورة</label>
                    <div class="col-md-12">
                        <input type="file" name="photo" class="form-control form-control-line photo" id="photo"
                            placeholder="الصورة" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light">اضافة</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal"
            aria-hidden="true">الغاء</button>
    </div>
</form>
