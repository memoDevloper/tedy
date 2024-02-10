<?php
if($complex = $wam->dbm->getData('realestate_complexes', 'id', ['eq' => ['id' => $dir5]])){
    $complex = $complex[0];
}
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>اضافة صورة جديدة جديدة</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="NEW_COMPLEX_IMAGE" />
    <input type="hidden" name="complex" value="<?php echo $complex->id; ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="type">نوع الصورة</label>
                    <div class="col-md-12">
                        <select name="type" class="form-control form-control-line type" id="photo-type" >
                            <option value="indoor">صورة داخلية</option>
                            <option value="outdoor">صورة خارجية</option>
                            <option value="plan">صورة مخطط</option>
                            <option value="facility">صورة مرفق</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="photo">الصورة</label>
                    <div class="col-md-12">
                        <input type="file" name="photo" class="form-control form-control-line photo" id="image-crop-input" data-complex="<?php echo $complex->id; ?>" data-type="new" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light" >اضافة</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true" >إلغاء</button>
    </div>
</form>