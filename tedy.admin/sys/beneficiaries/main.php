<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المستفيدين</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM" actionName="BENEFICIARIES" actionItem="new">اضافة مستفيد</button>
            <ol class="breadcrumb">
                <li class="active">المستفيدين</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">ادارة المستفيدين</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                            <tr>
                                <th>اسم المستفيد</th>
                                <th>الرقم الوطني</th>
                                <th>رقم الهاتف</th>
                                <th>الرقم العائلي</th>
                                <th>عدد الأفراد</th>
                                <th>عدد الإناث</th>
                                <th>نتيجة التقييم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $beneficiaries = $wam->dbm->getData('beneficiaries A', [
                            'A.id',
                            'A.name',
                            'A.phone',
                            'A.tc',
                            'A.family_no',
                            'A.family_members',
                            'A.females',
                        ], [
                            'order' => ['A.name'],
                        ]);
                        foreach ($beneficiaries as $key => $beneficiary) {
                            ?>
                            <tr class="item" >
                                <td><?php echo $beneficiary->name ?></td>
                                <td><span dir="ltr" ><?php echo $beneficiary->tc ?></span></td>
                                <td><span dir="ltr" ><?php echo $beneficiary->phone ?></span></td>
                                <td><?php echo $beneficiary->family_no ?></td>
                                <td><?php echo $beneficiary->family_members ?></td>
                                <td><?php echo $beneficiary->females ?></td>
                                <td>
                                    <?php
                                    if($evaluation = $wam->dbm->getData('evaluations', 'result', ['eq' => ['beneficiary' => $beneficiary->id]])){
                                        $evaluation = $evaluation[0];
                                        echo $evaluation_values[$evaluation->result];
                                    }else{
                                        ?>
                                        <button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="BENEFICIARIES/add-evaluation" actionItem="<?php echo $beneficiary->id; ?>">تقييم</button>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="BENEFICIARIES/view" actionItem="<?php echo $beneficiary->id; ?>">عرض</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="BENEFICIARIES/attributions-table" actionItem="<?php echo $beneficiary->id; ?>">الإسنادات</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="BENEFICIARIES/sms" actionItem="<?php echo $beneficiary->id; ?>">SMS</button>
                                    <button type="button" class="btn btn-danger btn-circle waves-effect waves-light DIM" actionName="BENEFICIARIES/gallery" actionItem="<?php echo $beneficiary->id; ?>"><i class="fa fa-file-photo-o" ></i></button>
                                    <button type="button" class="btn btn-danger btn-circle waves-effect waves-light DIM" actionName="BENEFICIARIES/edit" actionItem="<?php echo $beneficiary->id; ?>"><i class="fa fa-pencil" ></i></button>
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