<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">السلايدر</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM" actionName="SLIDER" actionItem="new">سلايد جديد</button>
            <ol class="breadcrumb">
                <li class="active">السلايدر</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel to-copy">
                <div class="panel-heading">إدارة السلايدر</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الرابط</th>
                                <th>الصورة</th>
                                <th width="300" class="hidden-print">الإدارة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $slider = $wam->dbm->getData('slider A', [
                                'A.id',
                                'A.name_tr as name',
                                'A.image',
                                'A.link',
                            ], [
                                'order' => ['A.sort'],
                            ]);
                            foreach ($slider as $key => $slide) {
                            ?>
                                <tr class="item">
                                    <td class="text-center"><?php echo $slide->name ?></td>
                                    <td><a href="<?php echo $slide->link ?>" target="_blank">اضغط هنا</a></td>
                                    <td><img src="/<?php echo $slide->image; ?>" height="150px" alt="<?php echo $slide->name ?>"></td>
                                    <td class="hidden-print">
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="SLIDER/edit" actionItem="<?php echo $slide->id; ?>"><i class="ti-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_SLIDE" data-item-id="<?php echo $slide->id; ?>"><i class="ti-trash"></i></button>
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