<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">مميزات المشاريع</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-warning pull-right m-l-20 waves-effect waves-light DIM" actionName="FEATURES" actionItem="new">ميزة جديدة</button>
            <ol class="breadcrumb">
                <li class="active">مميزات المشاريع</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">ادارة المميزات</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>الميزة</th>
                            <th>الأيقونة</th>
                            <th>الخيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $features = $wam->dbm->getData('realestate_features A', [
                            'A.id',
                            'A.name_ar as name',
                            'A.icon',
                        ], [
                            'order' => ['A.name_ar'],
                        ]);
                        foreach ($features as $key => $feature) {
                            ?>
                            <tr class="item" >
                                <td><?php echo $feature->name ?></td>
                                <td>
                                    <?php
                                    if($feature->icon){
                                        ?>
                                        <img src="<?php echo $feature->icon; ?>" alt="<?php echo $features->name ?>">
                                        <?php
                                    }else{
                                        echo 'No Icon';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-circle waves-effect waves-light DIM" actionName="FEATURES/edit" actionItem="<?php echo $feature->id; ?>"><i class="fa fa-pencil" ></i></button>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_FEATURE" data-item-id="<?php echo $feature->id; ?>" ><i class="ti-trash"></i></button>
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