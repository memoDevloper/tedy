<?php
if($material = $wam->dbm->getData('materials', '*', ['eq' => ['id' => $dir5]])) {
    $material = $material[0];
}
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>استلام دفعة مواد جديدة</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="NEW_MATERIAL_QUANTITY" />
    <div class="modal-body">
        <div class="row" >
            <?php
            if($material){
                ?>
                <input type="hidden" name="material" value="<?php echo $material->id; ?>" />
                <div class="col-md-6" >
                    <div class="form-group">
                        <div class="col-md-12">
                            <h4>المادة: <?php echo $material->name; ?></h4>
                        </div>
                    </div>
                </div>
                <?php
            }else{
                ?>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label class="col-md-12" for="material">المادة</label>
                        <div class="col-md-12">
                            <select name="material" class="form-control form-control-line material" id="material" >
                                <?php
                                $materials = $wam->dbm->getData('materials', 'id, name');
                                foreach ($materials as $key => $material){
                                    ?>
                                    <option value="<?php echo $material->id ?>"><?php echo $material->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="supplier">الموَّرد</label>
                    <div class="col-md-12">
                        <select name="supplier" class="form-control form-control-line supplier" id="supplier" >
                            <?php
                            $suppliers = $wam->dbm->getData('suppliers', 'id, name');
                            foreach ($suppliers as $key => $supplier){
                                ?>
                                <option value="<?php echo $supplier->id ?>"><?php echo $supplier->name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="center">المركز</label>
                    <div class="col-md-12">
                        <select name="center" class="form-control form-control-line center" id="center" >
                            <?php
                            $centers = $wam->dbm->getData('centers', 'id, name');
                            foreach ($centers as $key => $center){
                                ?>
                                <option value="<?php echo $center->id ?>"><?php echo $center->name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="quantity">الكمية</label>
                    <div class="col-md-12">
                        <input type="number" name="quantity" class="form-control form-control-line quantity" required id="quantity" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="quality">الجودة</label>
                    <div class="col-md-12">
                        <select name="quality" class="form-control form-control-line quality" id="quality" >
                            <?php
                            foreach ($material_qualities as $key => $material_quality){
                                ?>
                                <option value="<?php echo $key ?>"><?php echo $material_quality; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="notes">ملاحظات اضافية</label>
                    <div class="col-md-12">
                        <textarea name="notes" class="form-control form-control-line notes" id="notes" ></textarea>
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