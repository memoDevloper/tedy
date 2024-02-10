<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">التوصيات</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM" actionName="TESTIMONIALS" actionItem="new">توصية جديدة</button>
            <ol class="breadcrumb">
                <li class="active">التوصيات</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel to-copy">
                <div class="panel-heading">إدارة التوصيات</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>اللغة</th>
                            <th>التاريخ</th>
                            <th width="300" class="hidden-print">الإدارة</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $testimonials = $wam->dbm->getData('testimonials A', [
                            'A.id',
                            'A.name',
                            'A.lang',
                            'A.date',
                        ], [
                            'order' => ['A.date'],
                        ]);
                        foreach ($testimonials as $key => $testimonial) {
                            ?>
                            <tr class="item" >
                                <td><?php echo $testimonial->name ?></td>
                                <td><?php echo $testimonial->lang ?></td>
                                <td><?php echo date('d/m/Y', $testimonial->date); ?></td>
                                <td class="hidden-print">
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM"  actionName="TESTIMONIALS/edit" actionItem="<?php echo $testimonial->id; ?>"><i class="ti-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_TESTIMONIAL" data-item-id="<?php echo $testimonial->id; ?>" ><i class="ti-trash"></i></button>
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