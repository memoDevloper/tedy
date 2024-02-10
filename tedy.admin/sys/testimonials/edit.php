<?php
$testimonial = $wam->dbm->getData('testimonials', '*', [
    'eq' => ['id' => $dir5]
]);
$testimonial = $testimonial[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>تعديل توصية</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="EDIT_TESTIMONIALS" />
    <input type="hidden" name="id" value="<?php echo $testimonial->id; ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name">الاسم</label>
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control form-control-line name" id="name" placeholder="الاسم" value="<?php echo $testimonial->name; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="title">الصفة</label>
                    <div class="col-md-12">
                        <input type="text" name="title" class="form-control form-control-line title" id="title" placeholder="الصفة" value="<?php echo $testimonial->title; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="avatar">الصورة <?php echo $testimonial->avatar ? "(<a href='$wam->website/$testimonial->avatar' target='_blank'>فتح</a>)" : ''; ?></label>
                    <div class="col-md-12">
                        <input type="file" name="avatar" class="form-control form-control-line avatar" id="avatar" placeholder="الصورة" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="lang">اللغة</label>
                    <div class="col-md-12">
                        <select name="lang" class="form-control form-control-line lang" id="lang" >
                            <option value="ar" <?php echo $testimonial->lang == 'ar' ? 'selected' : ''; ?>>العربية</option>
                            <option value="en" <?php echo $testimonial->lang == 'en' ? 'selected' : ''; ?>>الإنجليزية</option>
                            <option value="tr" <?php echo $testimonial->lang == 'tr' ? 'selected' : ''; ?>>التركية</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-12" >
                <div class="form-group">
                    <label class="col-md-12" for="message">الرسالة</label>
                    <div class="col-md-12">
                        <textarea name="message" class="form-control form-control-line message" id="message" placeholder="الرسالة" ><?php echo $testimonial->message; ?></textarea>
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