<?php
$beneficiary = $wam->dbm->getData('beneficiaries', '*', ['eq' => ['id' => $dir5]]);
$beneficiary = $beneficiary[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>ارسال رسالة نصية الى المستفيد: <?php echo $beneficiary->name_ar ?> - <?php echo $beneficiary->name; ?></h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="SEND_SINGLE_SMS" />
    <input type="hidden" name="beneficiary" value="<?php echo $beneficiary->id; ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-12" >
                <div class="form-group">
                    <label class="col-md-12" for="message">الرسالة</label>
                    <div class="col-md-12">
                        <textarea name="message" class="form-control form-control-line message" id="message" required ></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light" >اتمام الطلب</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">الغاء</button>
    </div>
</form>