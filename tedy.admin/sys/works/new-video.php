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
                <h4>اضافة فيديو</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off">
    <input type="hidden" name="actionName" value="NEW_WORK_VIDEO" />
    <input type="hidden" name="work" value="<?php echo $work->id; ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="url">الرابط</label>
                    <div class="col-md-12">
                        <input type="text" name="url" class="form-control form-control-line url" id="url"
                            placeholder="الرابط" />
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
