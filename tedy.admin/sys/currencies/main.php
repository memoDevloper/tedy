<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">العملات</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-warning pull-right m-l-20 waves-effect waves-light DIM" actionName="CURRENCIES" actionItem="new">عملة جديدة</button>
            <button type="button" class="btn btn-warning pull-right m-l-20 waves-effect waves-light DIM" actionName="CURRENCIES" actionItem="edit-all">أسعار العملات</button>
            <ol class="breadcrumb">
                <li class="active">العملات</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">ادارة أسعار صرف العملات مقابل الدولار</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>العملة</th>
                            <th>سعر الصرف مقابل الدولار</th>
                            <th>آخر تعديل لسعر الصرف</th>
                            <th>الخيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $currencies = $wam->dbm->getData('currencies A', ['A.*'], [
                            'order' => ['FIELD(A.code, \'usd\') DESC, A.code'],
                        ]);
                        foreach ($currencies as $key => $currency) {
                            ?>
                            <tr class="item" >
                                <td><?php echo $currency->name_ar ?></td>
                                <td><?php echo $currency->rate ?></td>
                                <td><span dir="ltr"><?php echo date("d/m/Y H:i A", $currency->last_update); ?></span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-circle waves-effect waves-light DIM" actionName="CURRENCIES/edit" actionItem="<?php echo $currency->id; ?>"><i class="fa fa-pencil" ></i></button>
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