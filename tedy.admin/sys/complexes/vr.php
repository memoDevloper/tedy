<?php
if($complex = $wam->dbm->getData('realestate_complexes_details', '*', ['eq' => ['complex' => $dir5, 'lang' => 'ar']])){
    $complex = $complex[0];
}
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>ادارة الصور البانورامية</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover manage-u-table">
                <thead>
                <tr>
                    <th>الرابط</th>
                    <th>التاريخ</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $photos = $wam->dbm->getData('realestate_media', 'id, url, date', ['eq' => ['type' => 'panorama', 'section' => 'complexes', 'item' => $complex->complex]]);
                foreach ($photos as $photo){
                    ?>
                    <tr>
                        <td><a href="<?php echo $photo->url; ?>" target="_blank"><?php echo $photo->url; ?></a></td>
                        <td><?php echo date('d/m/Y', $photo->date); ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer" >
    <button type="button" class="btn btn-success waves-effect waves-light upload-photo" data-action="UPLOAD_360_PHOTO" data-item="<?php echo $complex->complex; ?>" data-container=".vr-photos-container" ><i class="fa fa-image" ></i> اضافة صورة جديدة</button>
    <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">الغاء</button>
</div>