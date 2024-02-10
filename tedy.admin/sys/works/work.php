<?php
$work = $wam->dbm->getData('works', '*', [
    'eq' => ['id' => $dir4]
]);
$work = $work[0];
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">أعمالنا</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM"
                actionName="WORKS/new-video" actionItem="<?php echo $work->id; ?>">اضافة فيديو</button>
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM"
                actionName="WORKS/new-photo" actionItem="<?php echo $work->id; ?>">اضافة صورة</button>
            <ol class="breadcrumb">
                <li><a href="/works" class="CPB">أعمالنا</a></li>
                <li class="active"><?php echo $work->name; ?></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel to-copy">
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                            <tr>
                                <th>النوع</th>
                                <th></th>
                                <th width="300" class="hidden-print">الإدارة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $works = $wam->dbm->getData('work_items A', [
                                'A.id',
                                'A.type',
                                'A.url',
                            ], [
                                'eq' => ['A.work' => $work->id],
                                'order' => ['A.date'],
                            ]);
                            $types = [
                                'video' => 'فيديو',
                                'photo' => 'صورة',
                            ];
                            foreach ($works as $key => $work) {
                            ?>
                            <tr class="item">
                                <td><?php echo $types[$work->type] ?></td>
                                <td>
                                    <?php
                                        if ($work->type == 'video') {
                                        ?>
                                    <a href="<?php echo $work->url ?>" target="_blank">فتح</a>
                                    <?php
                                        } else {
                                        ?>
                                    <img src="<?php echo $work->url; ?>" width="100%" />
                                    <?php
                                        }
                                        ?>
                                <td class="hidden-print">
                                    <!-- <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM"
                                        actionName="WORKS/edit" actionItem="<?php echo $work->id; ?>"><i
                                            class="ti-pencil-alt"></i></button> -->
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB"
                                        data-action="DELETE_WORK_ITEM" data-item-id="<?php echo $work->id; ?>"><i
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
