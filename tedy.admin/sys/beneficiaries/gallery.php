<?php
$beneficiary = $wam->dbm->getData('beneficiaries', '*', ['eq' => ['id' => $dir5]]);
$beneficiary = $beneficiary[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>مستندات المستفيد: <?php echo $beneficiary->name_ar ?> - <?php echo $beneficiary->name; ?></h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<div class="modal-body">
    <div class="row el-element-overlay beneficiary-documents-area" >
        <?php
        $files = $wam->dbm->getData('beneficiaries_files', 'id, file, extension', [
            'eq' => ['beneficiary' => $beneficiary->id]
        ]);
        $images = ['jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'];
        foreach ($files as $file){
            if(in_array($file->extension, $images)){
                $icon = $file->file;
            }else{
                $icon = '/css/file.png';
            }
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="white-box">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1">
                            <img src="<?php echo $icon ?>">
                            <div class="el-overlay">
                                <ul class="el-info">
                                    <li><a class="btn default btn-outline image-popup" href="<?php echo $file->file; ?>" ><i class="icon-magnifier"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success waves-effect waves-light upload-photo" data-action="BENEFICIARIES_DOCUMENTS" data-item="<?php echo $beneficiary->id; ?>" data-container=".beneficiary-documents-area" >اضافة مستند</button>
    <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">اغلاق</button>
</div>