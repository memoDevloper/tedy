<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">أعمالنا</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM"
                actionName="WORKS" actionItem="new">عمل جديد</button>
            <ol class="breadcrumb">
                <li class="active">أعمالنا</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel to-copy">
                <div class="panel-heading">إدارة الأعمال</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
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
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>القسم</th>
                                <th width="300" class="hidden-print">الإدارة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $works = $wam->dbm->getData('works A', [
                                'A.id',
                                'A.name',
                                'A.section',
                            ], [
                                'order' => ['A.date'],
                            ]);
                            foreach ($works as $key => $work) {
                            ?>
                            <tr class="item">
                                <td class="text-center"><a href="/works/work/<?php echo $work->id ?>"
                                        class="CPB"><?php echo $work->name ?></a></td>
                                <td class="text-center"><?php echo $sections[$work->section] ?></td>
                                <td class="hidden-print">
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM"
                                        actionName="WORKS/edit" actionItem="<?php echo $work->id; ?>"><i
                                            class="ti-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB"
                                        data-action="DELETE_WORK" data-item-id="<?php echo $work->id; ?>"><i
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
