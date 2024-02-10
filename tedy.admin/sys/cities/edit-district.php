<?php
$district = $wam->dbm->getData('districts', '*', ['eq' => ['id' => $dir5]]);
$district = $district[0];
$city = $wam->dbm->getData('cities', 'id, name_ar, name_tr', ['eq' => ['id' => $district->city]]);
$city = $city[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل حيّ في مدينة: <?php echo $city->name_ar ?> - <?php echo $city->name_tr ?></h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="EDIT_DISTRICT" />
    <input type="hidden" name="id" value="<?php echo $district->id ?>" />
    <input type="hidden" name="city" value="<?php echo $district->city ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_tr">اسم الحي التركية</label>
                    <div class="col-md-12">
                        <input type="text" name="name_tr" class="form-control form-control-line name_tr" id="name_tr" value="<?php echo $district->name_tr ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="desc_tr">الشرح بالتركي</label>
                    <div class="col-md-12">
                        <textarea name="desc_tr" class="form-control form-control-line desc_tr" id="desc_tr" ><?php echo $district->desc_tr ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_en">اسم الحي الإنجليزي</label>
                    <div class="col-md-12">
                        <input type="text" name="name_en" class="form-control form-control-line name_en" id="name_en" value="<?php echo $district->name_en ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="desc_en">الشرح بالإنجليزي</label>
                    <div class="col-md-12">
                        <textarea name="desc_en" class="form-control form-control-line desc_en" id="desc_en" ><?php echo $district->desc_en ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name_ar">اسم الحي العربي</label>
                    <div class="col-md-12">
                        <input type="text" name="name_ar" class="form-control form-control-line name_ar" id="name_ar" value="<?php echo $district->name_ar ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="desc_ar">الشرح بالعربي</label>
                    <div class="col-md-12">
                        <textarea name="desc_ar" class="form-control form-control-line desc_ar" id="desc_ar" ><?php echo $district->desc_ar ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light" >اتمام الطلب</button>
        <button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="CITIES/districts" actionItem="<?php echo $district->city; ?>" >رجوع</button>
    </div>
</form>