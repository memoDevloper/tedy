<?php
if($complex = $wam->dbm->getData('realestate_complexes', '*', ['eq' => ['id' => $dir5]])){
    $complex = $complex[0];
}
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>اضافة نوع شقق</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="COMPLEX_NEW_ITEM" />
    <input type="hidden" name="complex" value="<?php echo $complex->id; ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="rooms">عدد الغرف</label>
                    <div class="col-md-12">
                        <select name="rooms" class="form-control form-control-line rooms" id="rooms" >
                            <?php
                            foreach ($realestate_rooms as $key => $realestate_room){
                                ?>
                                <option value="<?php echo $key ?>"><?php echo $realestate_room ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="price_start">السعر الابتدائي</label>
                    <div class="col-md-12">
                        <input type="number" name="price_start" class="form-control form-control-line price_start" id="price_start" placeholder="السعر الابتدائي" >
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="price_end">السعر النهائي</label>
                    <div class="col-md-12">
                        <input type="number" name="price_end" class="form-control form-control-line price_end" id="price_end" placeholder="السعر النهائي" >
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="area_start">المساحة الابتدائية</label>
                    <div class="col-md-12">
                        <input type="number" name="area_start" class="form-control form-control-line area_start" id="area_start" placeholder="المساحة الابتدائية" >
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="area_end">المساحة النهائية</label>
                    <div class="col-md-12">
                        <input type="number" name="area_end" class="form-control form-control-line area_end" id="area_end" placeholder="المساحة النهائية" >
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="type">نوع العقار</label>
                    <div class="col-md-12">
                        <select type="number" name="type" class="form-control form-control-line type" id="type">
                            <option value="flat">شقة سكنية</option>
                            <option value="duplex">دوبلكس</option>
                            <option value="villa">فيلا</option>
                            <option value="office">مكتب</option>
                            <option value="store">محل تجاري</option>
                            <option value="home_office">هوم أوفيس</option>
                            <option value="loft">لوفت</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light" >اضافة</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">الغاء</button>
    </div>
</form>
