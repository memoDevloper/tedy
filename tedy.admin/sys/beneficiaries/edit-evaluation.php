<?php
$evaluation = $wam->dbm->getData('evaluations', '*', ['eq' => ['id' => $dir5]]);
$evaluation = $evaluation[0];
$beneficiary = $wam->dbm->getData('beneficiaries', '*', ['eq' => ['id' => $evaluation->beneficiary]]);
$beneficiary = $beneficiary[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل تقييم المستفيد: <?php echo $beneficiary->name_ar; ?> - <?php echo $beneficiary->name; ?></h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="EDIT_EVALUATION" />
    <input type="hidden" name="id" value="<?php echo $evaluation->id; ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="furnishing">عفش البيت</label>
                    <div class="col-md-12">
                        <select name="furnishing" class="form-control form-control-line furnishing" id="furnishing" >
                            <?php
                            foreach ($evaluation_values as $key => $evaluation_value){
                                ?>
                                <option value="<?php echo $key ?>" <?php echo ($evaluation->furnishing == $key) ? 'selected' : ''; ?> ><?php  echo $evaluation_value;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="income_to_expenses">الدخل مقابل المصروف</label>
                    <div class="col-md-12">
                        <select name="income_to_expenses" class="form-control form-control-line income_to_expenses" id="income_to_expenses" >
                            <?php
                            foreach ($evaluation_values as $key => $evaluation_value){
                                ?>
                                <option value="<?php echo $key ?>" <?php echo ($evaluation->income_to_expenses == $key) ? 'selected' : ''; ?> ><?php  echo $evaluation_value;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="result">نتيجة التقييم</label>
                    <div class="col-md-12">
                        <select name="result" class="form-control form-control-line result" id="result" >
                            <?php
                            foreach ($evaluation_values as $key => $evaluation_value){
                                ?>
                                <option value="<?php echo $key ?>" <?php echo ($evaluation->result == $key) ? 'selected' : ''; ?> ><?php  echo $evaluation_value;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-12" >
                <div class="form-group">
                    <label class="col-md-12" for="notes">ملاحظات اضافية</label>
                    <div class="col-md-12">
                        <textarea name="notes" class="form-control form-control-line notes" id="notes" ><?php echo $evaluation->notes ?></textarea>
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