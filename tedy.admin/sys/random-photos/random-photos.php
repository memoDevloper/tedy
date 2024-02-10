<?php
if($complex = $wam->dbm->getData('realestate_complexes', 'id', ['eq' => ['id' => $dir5]])){
    $complex = $complex[0];
}
$dLang = [
    'ar' => 'العربية',
    'en' => 'الإنكليزية',
    'tr' => 'التركية',
][$dir5];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>صور المجمع العشوائية</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        الصور الداخلية
                        <button type="button" class="btn btn-success waves-effect waves-light DIM pull-right" actionName="COMPLEXES/edit-photos-sort" actionItem="<?php echo $complex->id; ?>/indoor" >تعديل الترتيب</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover manage-u-table">
                            <thead>
                            <tr>
                                <th>الصورة الأصلية</th>
                                <th>الصورة المضغوطة</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $photos = $wam->dbm->getData('realestate_media', [
                                'id',
                                'url',
                                'compressed',
                                'on_gallery',
                                'date'
                            ], [
                                'eq' => [
                                    'section' => 'complexes',
                                    'item' => $complex->id,
                                    'type' => 'indoor',
                                    'on_gallery' => 1,
                                ],
                                'order' => ['sort'],
                            ]);
                            foreach ($photos as $photo){
                                ?>
                                <tr class="item">
                                    <td><a href="<?php echo $photo->url; ?>" target="_blank">مشاهدة</a></td>
                                    <td>
                                        <?php
                                        if($photo->compressed){
                                            ?>
                                            <a href="<?php echo $photo->compressed; ?>" target="_blank">مشاهدة</a>
                                            <?php
                                        }else{
                                            ?>
                                            <span class="text-danger">لا يوجد</span>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info make-default-photo" data-complex="<?php echo $complex->id; ?>" data-id="<?php echo $photo->id; ?>">تعيين كصورة رئيسية</button>
                                        <button type="button" id="crop-photo" class="btn btn-info" data-complex="<?php echo $complex->id; ?>" data-type="edit" data-id="<?php echo $photo->id; ?>" data-photo="<?php echo $photo->url ?>">تعديل</button>
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_PROJECT_PHOTO" data-item-id="<?php echo $photo->id; ?>" ><i class="ti-trash"></i></button>
                                    </td>
                                    <td>
                                        <div class="form-group" >
                                            <input type="checkbox" class="js-switch" id="photo_<?php echo $photo->id; ?>" <?php echo ($photo->on_gallery) ? 'checked' : ''; ?> data-color="#f96262" change-properity data-item-id="<?php echo $photo->id; ?>" data-action="ON_GALLERY" />
                                            <label for="photo_<?php echo $photo->id; ?>" ></label>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        الصور الخارجية
                        <button type="button" class="btn btn-success waves-effect waves-light DIM pull-right" actionName="COMPLEXES/edit-photos-sort" actionItem="<?php echo $complex->id; ?>/outdoor" >تعديل الترتيب</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover manage-u-table">
                            <thead>
                            <tr>
                                <th>الصورة الأصلية</th>
                                <th>الصورة المضغوطة</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $photos = $wam->dbm->getData('realestate_media', [
                                'id',
                                'url',
                                'compressed',
                                'on_gallery',
                                'date'
                            ], [
                                'eq' => [
                                    'section' => 'complexes',
                                    'item' => $complex->id,
                                    'type' => 'outdoor',
                                    'on_gallery' => 1,
                                ],
                                'order' => ['sort'],
                            ]);
                            foreach ($photos as $photo){
                                ?>
                                <tr class="item">
                                    <td><a href="<?php echo $photo->url; ?>" target="_blank">مشاهدة</a></td>
                                    <td>
                                        <?php
                                        if($photo->compressed){
                                            ?>
                                            <a href="<?php echo $photo->compressed; ?>" target="_blank">مشاهدة</a>
                                            <?php
                                        }else{
                                            ?>
                                            <span class="text-danger">لا يوجد</span>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info make-default-photo" data-complex="<?php echo $complex->id; ?>" data-id="<?php echo $photo->id; ?>">تعيين كصورة رئيسية</button>
                                        <button type="button" id="crop-photo" class="btn btn-info" data-complex="<?php echo $complex->id; ?>" data-type="edit" data-id="<?php echo $photo->id; ?>" data-photo="<?php echo $photo->url ?>">تعديل</button>
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_PROJECT_PHOTO" data-item-id="<?php echo $photo->id; ?>" ><i class="ti-trash"></i></button>
                                    </td>
                                    <td>
                                        <div class="form-group" >
                                            <input type="checkbox" class="js-switch" id="photo_<?php echo $photo->id; ?>" <?php echo ($photo->on_gallery) ? 'checked' : ''; ?> data-color="#f96262" change-properity data-item-id="<?php echo $photo->id; ?>" data-action="ON_GALLERY" />
                                            <label for="photo_<?php echo $photo->id; ?>" ></label>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">إغلاق</button>
    </div>
</form>
