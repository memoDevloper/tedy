<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المكاتب</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM" actionName="OFFICES" actionItem="new">مكتب جديد</button>
            <ol class="breadcrumb">
                <li class="active">المكاتب</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel to-copy">
                <div class="panel-heading">إدارة المكاتب</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الموقع</th>
                            <th>QR</th>
                            <th>Date</th>
                            <th width="300" class="hidden-print">الإدارة</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $offices = $wam->dbm->getData('offices A', [
                            'A.id',
                            'A.name',
                            'A.lat',
                            'A.lng',
                            'A.date',
                        ], [
                            'order' => ['A.date'],
                        ]);
                        foreach ($offices as $key => $office) {
                            ?>
                            <tr class="item" >
                                <td><?php echo $office->name ?></td>
                                <td><?php echo $office->lat ?>, <?php echo $office->lng ?></td>
                                <td>
                                    <a href="/offices/<?php echo $office->id ?>.png" target="_blank">
                                        <img src="/offices/<?php echo $office->id ?>.png" height="100" />
                                    </a>
                                </td>
                                <td><?php echo date('c', $office->date); ?></td>
                                <td class="hidden-print">
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM"  actionName="OFFICES/edit" actionItem="<?php echo $office->id; ?>"><i class="ti-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_OFFICE" data-item-id="<?php echo $office->id; ?>" ><i class="ti-trash"></i></button>
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
    <div class="row">
        <div class="col-md-12">
            <div class="panel to-copy">
                <div class="panel-heading">إدارة المكاتب</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>التاريخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $checks = $wam->dbm->getData('users_checks A', [
                            'A.id',
                            'A.date',
                        ], [
                            'order' => ['A.date'],
                        ]);
                        foreach($checks as $key => $check){
                            $checks[$key]->date = date('c', strtotime($check->date));
                        }
                        foreach ($checks as $key => $check) {
                            ?>
                            <tr class="item" >
                                <td><?php echo $check->date ?></td>
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