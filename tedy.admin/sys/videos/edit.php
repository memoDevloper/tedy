<?php
$video = $wam->dbm->getData('videos', [
    '*'
], [
    'eq' => ['id' => $dir5],
]);
$video = $video[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل فيديو</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="EDIT_VIDEO" />
    <input type="hidden" name="id" value="<?php echo $video->id; ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="source">المصدر</label>
                    <div class="col-md-12">
                        <select name="source" class="form-control form-control-line source" id="source" >
                            <option value="youtube" <?php echo $video->source == 'youtube' ? 'selected' : ''; ?>>YouTube</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name">عنوان الفيديو</label>
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control form-control-line name" id="name" placeholder="عنوان الفيديو" value="<?php echo $video->name; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="url">رابط الفيديو</label>
                    <div class="col-md-12">
                        <input type="text" name="url" class="form-control form-control-line url" id="url" placeholder="رابط الفيديو" value="<?php echo $video->url; ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light" >تعديل</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true" >إلغاء</button>
    </div>
</form>