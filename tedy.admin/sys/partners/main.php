<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">شركاؤنا</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM"
                actionName="PARTNERS" actionItem="new">شريك جديد</button>
            <ol class="breadcrumb">
                <li class="active">شركاؤنا</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel to-copy">
                <div class="panel-heading">إدارة الشركاء</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الرابط</th>
                                <th>الشعار</th>
                                <th width="300" class="hidden-print">الإدارة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $partners = $wam->dbm->getData('partners A', [
                                'A.id',
                                'A.name_ar as name',
                                'A.logo',
                                'A.url',
                            ], [
                                'order' => ['A.date'],
                            ]);
                            foreach ($partners as $key => $partner) {
                            ?>
                            <tr class="item">
                                <td class="text-center"><?php echo $partner->name ?></td>
                                <td><a href="<?php echo $partner->url ?>" target="_blank">اضغط هنا</a></td>
                                <td><img src="/<?php echo $partner->logo; ?>" height="40px"
                                        alt="<?php echo $partner->name ?>"></td>
                                <td class="hidden-print">
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM"
                                        actionName="PARTNERS/edit" actionItem="<?php echo $partner->id; ?>"><i
                                            class="ti-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB"
                                        data-action="DELETE_PARTNER" data-item-id="<?php echo $partner->id; ?>"><i
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
