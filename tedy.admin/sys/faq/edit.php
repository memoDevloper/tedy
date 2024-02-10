<?php
$question = $wam->dbm->getData('faq', '*', [
    'eq' => ['id' => $dir5]
]);
$question = $question[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل سؤال</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="EDIT_FAQ" />
    <input type="hidden" name="id" value="<?php echo $question->id; ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-12" >
                <div class="form-group">
                    <label class="col-md-12" for="question">السؤال</label>
                    <div class="col-md-12">
                        <input type="text" name="question" class="form-control form-control-line question" id="question" placeholder="السؤال" value="<?php echo $question->question; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-12" >
                <div class="form-group">
                    <label class="col-md-12" for="answer">الجواب</label>
                    <div class="col-md-12">
                        <textarea name="answer" class="form-control form-control-line answer tinymce" id="answer" ><?php echo $question->answer; ?></textarea>
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