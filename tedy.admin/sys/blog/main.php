<?php
$blog_lang = [
    '' => 'العربية',
    'ar' => 'العربية',
    'en' => 'الإنجليزية',
    'tr' => 'التركية',
][$dir3];
$lang = [
    '' => 'ar',
    'ar' => 'ar',
    'en' => 'en',
    'tr' => 'tr',
][$dir3];
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المدونة</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="/blog/new/<?php echo $blog_lang ?>"
                class="btn btn-warning pull-right m-l-20 waves-effect waves-light CPB">تدوينة جديدة</a>
            <ol class="breadcrumb">
                <li>المدونات</li>
                <li class="active">المدونات <?php echo ucfirst($blog_lang); ?></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">إدارة التدوينات</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table" data-table id="blogsTable">
                        <thead>
                            <tr>
                                <th>العنوان</th>
                                <th>الرابط</th>
                                <th>الإدارة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $blogs = $wam->dbm->getData('blogs', ['id', 'name'], ['eq' => ['lang' => $lang], 'order' => ['date DESC']]);
                            foreach ($blogs as $key => $blog) {
                            ?>
                            <tr class="item">
                                <td><?php echo $blog->name ?></td>
                                <td><a href="https://axismediapro.com/blog/<?php echo $blog->id; ?>"
                                        target="_blank">الرابط</a></td>
                                <td>
                                    <a href="/blog/edit/<?php echo $blog->id ?>"
                                        class="btn btn-info btn-outline btn-circle m-r-5 CPB"><i
                                            class="ti-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB"
                                        data-action="DELETE_BLOG" data-item-id="<?php echo $blog->id; ?>"><i
                                            class="ti-trash"></i></button>
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
