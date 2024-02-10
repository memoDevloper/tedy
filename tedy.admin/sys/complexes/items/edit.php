<?php
if($item = $wam->dbm->getData('realestate_complexes_items', '*', ['eq' => ['id' => $dir5]])){
    $item = $item[0];
}
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل نوع شقق</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="COMPLEX_EDIT_ITEM" />
    <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
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
                                <option value="<?php echo $key ?>" <?php echo $item->rooms == $key ? 'selected' : ''; ?>><?php echo $realestate_room ?></option>
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
                        <input type="number" name="price_start" class="form-control form-control-line price_start" id="price_start" placeholder="السعر الابتدائي" value="<?php echo $item->price_start; ?>" >
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="price_end">السعر النهائي</label>
                    <div class="col-md-12">
                        <input type="number" name="price_end" class="form-control form-control-line price_end" id="price_end" placeholder="السعر النهائي" value="<?php echo $item->price_end; ?>" >
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="area_start">المساحة الابتدائية</label>
                    <div class="col-md-12">
                        <input type="number" name="area_start" class="form-control form-control-line area_start" id="area_start" placeholder="المساحة الابتدائية" value="<?php echo $item->area_start; ?>" >
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="area_end">المساحة النهائية</label>
                    <div class="col-md-12">
                        <input type="number" name="area_end" class="form-control form-control-line area_end" id="area_end" placeholder="المساحة النهائية" value="<?php echo $item->area_end; ?>" >
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
                            <option value="flat" <?php echo $item->type == "flat" ? "selected" : ""; ?>>شقة سكنية</option>
                            <option value="duplex" <?php echo $item->type == "duplex" ? "selected" : ""; ?>>دوبلكس</option>
                            <option value="villa" <?php echo $item->type == "villa" ? "selected" : ""; ?>>فيلا</option>
                            <option value="office" <?php echo $item->type == "office" ? "selected" : ""; ?>>مكتب</option>
                            <option value="store" <?php echo $item->type == "store" ? "selected" : ""; ?>>محل تجاري</option>
                            <option value="home_office" <?php echo $item->type == "home_office" ? "selected" : ""; ?>>هوم أوفيس</option>
                            <option value="loft" <?php echo $item->type == "loft" ? "selected" : ""; ?>>لوفت</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light" >تعديل</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">الغاء</button>
    </div>
</form>
