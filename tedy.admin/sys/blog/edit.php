<?php
$blog = $wam->dbm->getData('blogs', '*', ['eq' => ['id' => $dir4]]);
$blog = $blog[0];
$blogs_lang = $blog->lang;
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">تعديل تدوينة</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>المدونة</li>
                <li><a href="/blog/<?php echo $blogs_lang ?>" class="CPB backButton">المدونات
                        <?php echo ucfirst($blog_lang); ?></a></li>
                <li class="active">تعديل تدوينة</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material form" autocomplete="off">
                    <input type="hidden" name="actionName" value="EDIT_BLOG">
                    <input type="hidden" name="id" value="<?php echo $blog->id; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="name">العنوان</label>
                                <div class="col-md-12">
                                    <div>
                                        <input type="text" required name="name"
                                            class="form-control form-control-line name text-count" data-length="60"
                                            id="name" placeholder="العنوان" value="<?php echo $blog->name; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="photo">الصورة</label>
                                <div class="col-md-12">
                                    <div>
                                        <input type="file" name="photo" class="form-control form-control-line photo"
                                            id="photo" placeholder="الصورة">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="slug">الرابط</label>
                                <div class="col-md-12">
                                    <div>
                                        <input type="text" name="slug" class="form-control form-control-line slug"
                                            id="slug" placeholder="الرابط" value="<?php echo $blog->slug; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="lang">اللغة</label>
                                <div class="col-md-12">
                                    <div>
                                        <select type="text" name="lang" class="form-control form-control-line lang"
                                            id="lang">
                                            <option value="ar" <?php echo $blog->lang == 'ar' ? 'selected' : ''; ?>>
                                                العربية</option>
                                            <option value="en" <?php echo $blog->lang == 'en' ? 'selected' : ''; ?>>
                                                الإنجليزية</option>
                                            <option value="tr" <?php echo $blog->lang == 'tr' ? 'selected' : ''; ?>>
                                                التركية</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="blog">التدوينة</label>
                                <textarea class="form-control form-control-line tinymce blog" id="blog"
                                    name="blog"><?php echo $blog->blog ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="keywords">الكلمات الدلالية</label>
                                <textarea class="form-control form-control-line keywords" id="keywords"
                                    name="keywords"><?php echo $blog->keywords ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">تعديل</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
