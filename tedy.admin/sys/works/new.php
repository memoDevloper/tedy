<div class="modal-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="pull-left">
                <h4>اضافة عمل جديد</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off">
    <input type="hidden" name="actionName" value="NEW_WORK" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="name">الاسم</label>
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control form-control-line name" id="name"
                            placeholder="الاسم" />
                    </div>
                </div>
            </div>
            <?php
            $sections = [
                'video_editing' => 'التصوير والإنتاج المرئي',
                'graphic_design' => 'التصميم الجرافيكي',
                'brands' => 'تصميم الهويات البصرية',
                'marketing' => 'التسويق الإلكتروني',
                'web_development' => 'تطوير المواقع',
                'drone_photography' => 'التصوير الجوي',
            ];
            ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="section">القسم</label>
                    <div class="col-md-12">
                        <select name="section" class="form-control form-control-line section" id="section">
                            <option value="">اختر القسم</option>
                            <?php foreach ($sections as $key => $value) { ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="photo">الصورة</label>
                    <div class="col-md-12">
                        <input type="file" name="photo" class="form-control form-control-line photo" id="photo"
                            placeholder="الصورة" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12" for="description">الوصف</label>
                    <div class="col-md-12">
                        <textarea name="description" class="form-control form-control-line description" id="description"
                            placeholder="الوصف"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light">اضافة</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal"
            aria-hidden="true">الغاء</button>
    </div>
</form>
