<?php
$beneficiary = $wam->dbm->getData('beneficiaries', '*', ['eq' => ['id' => $dir5]]);
$beneficiary = $beneficiary[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل بيانات مستفيد</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="EDIT_BENEFICIARY" />
    <input type="hidden" name="id" value="<?php echo $beneficiary->id; ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name">الاسم (باللغة التركية)</label>
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control form-control-line name" id="name" data-only-turkish required value="<?php echo $beneficiary->name ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_ar">الاسم (باللغة العربية)</label>
                    <div class="col-md-12">
                        <input type="text" name="name_ar" class="form-control form-control-line name_ar" id="name_ar" data-only-arabic required value="<?php echo $beneficiary->name_ar ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="phone">رقم الهاتف</label>
                    <div class="col-md-12">
                        <input type="text" name="phone" class="form-control form-control-line phone" required id="phone" data-mask="(599) 999 9999" value="<?php echo $beneficiary->phone ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="tc">الرقم الوطني (TC)</label>
                    <div class="col-md-12">
                        <input type="text" name="tc" class="form-control form-control-line tc" required id="tc" data-mask="9{11}" value="<?php echo $beneficiary->tc ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="family_no">رقم العائلة</label>
                    <div class="col-md-12">
                        <input type="text" name="family_no" class="form-control form-control-line family_no" id="family_no" required value="<?php echo $beneficiary->family_no ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="family_members">عدد أفراد العائلة</label>
                    <div class="col-md-12">
                        <input type="text" name="family_members" class="form-control form-control-line family_members" id="family_members" data-mask="9{2}" required value="<?php echo $beneficiary->family_members ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="males">عدد الئكور في العائلة</label>
                    <div class="col-md-12">
                        <input type="text" name="males" class="form-control form-control-line males" id="males" data-mask="9{2}" required value="<?php echo $beneficiary->males ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="males_upper_eighteen">عدد الئكور فوق سن الـ 18</label>
                    <div class="col-md-12">
                        <input type="text" name="males_upper_eighteen" class="form-control form-control-line males_upper_eighteen" id="males_upper_eighteen" data-mask="9{2}" required value="<?php echo $beneficiary->males_upper_eighteen ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="bundles">ربطات الخبز المستحقة</label>
                    <div class="col-md-12">
                        <input type="text" name="bundles" class="form-control form-control-line bundles" id="bundles" data-mask="9{2}" required value="<?php echo $beneficiary->bundles ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="address">العنوان</label>
                    <div class="col-md-12">
                        <textarea name="address" class="form-control form-control-line address" id="address" required ><?php echo $beneficiary->address ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="notes">ملاحظات اضافية</label>
                    <div class="col-md-12">
                        <textarea name="notes" class="form-control form-control-line notes" id="notes" ><?php echo $beneficiary->notes ?></textarea>
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