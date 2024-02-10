<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">فيديوهات الجنسية</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-warning pull-right m-l-20 waves-effect waves-light DIM" actionName="VIDEOS/new" actionItem="turkish-citizenship">فيديو جديد</button>
            <ol class="breadcrumb">
                <li>الفيديوهات</li>
                <li class="active">فيديوهات الجنسية</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">ادارة الفيديوهات</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>عنوان الفيديو</th>
                            <th>رابط الفيديو</th>
                            <th>الخيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $videos = $wam->dbm->getData('videos A', [
                            'A.id',
                            'A.name',
                            'A.url',
                        ], [
                            'eq' => ['A.section' => 'turkish-citizenship'],
                        ]);
                        foreach ($videos as $key => $video) {
                            ?>
                            <tr class="item" >
                                <td><?php echo $video->name ?></td>
                                <td><a href="<?php echo $video->url ?>" target="_blank"><?php echo $video->url ?></a></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-circle waves-effect waves-light DIM" actionName="VIDEOS/edit" actionItem="<?php echo $video->id; ?>"><i class="fa fa-pencil" ></i></button>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_VIDEO" data-item-id="<?php echo $video->id; ?>"><i class="ti-trash"></i></button>
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