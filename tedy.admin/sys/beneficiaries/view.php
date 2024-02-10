<?php
$beneficiary = $wam->dbm->getData('beneficiaries', '*', ['eq' => ['id' => $dir5]]);
$beneficiary = $beneficiary[0];
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>عرض بيانات مستفيد</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<div class="modal-body">
    <div class="row" >
        <div class="col-md-12" >
            <div class="panel">
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <tbody>
                        <tr>
                            <td width="30%" ><b>اسم المستفيد باللغة التركية</b></td>
                            <td><span dir="ltr" ><?php echo $beneficiary->name ?></span></td>
                        </tr>
                        <tr>
                            <td><b>اسم المستفيد باللغة العربية</b></td>
                            <td><?php echo $beneficiary->name_ar ?></td>
                        </tr>
                        <tr>
                            <td><b>الرقم الوطني (TC)</b></td>
                            <td><span dir="ltr" ><?php echo $beneficiary->tc ?></span></td>
                        </tr>
                        <tr>
                            <td><b>رقم الهاتف</b></td>
                            <td><span dir="ltr" ><?php echo $beneficiary->phone ?></span></td>
                        </tr>
                        <tr>
                            <td><b>رقم العائلة</b></td>
                            <td><span dir="ltr" ><?php echo $beneficiary->family_no ?></span></td>
                        </tr>
                        <tr>
                            <td><b>عدد أفراد العائلة الكلي</b></td>
                            <td><?php echo $beneficiary->family_members ?></td>
                        </tr>
                        <tr>
                            <td><b>عدد الذكور</b></td>
                            <td><?php echo $beneficiary->males ?></td>
                        </tr>
                        <tr>
                            <td><b>عدد الإناث</b></td>
                            <td><?php echo $beneficiary->females ?></td>
                        </tr>
                        <tr>
                            <td><b>عدد الذكور فوق سن الـ 18</b></td>
                            <td><?php echo $beneficiary->males_upper_eighteen ?></td>
                        </tr>
                        <tr>
                            <td><b>ربطات الخبز المستحقة</b></td>
                            <td><?php echo $beneficiary->bundles ?></td>
                        </tr>
                        <tr>
                            <td><b>العنوان</b></td>
                            <td><?php echo $beneficiary->address ?></td>
                        </tr>
                        <tr>
                            <td><b>ملاحظات اضافية</b></td>
                            <td><?php echo $beneficiary->notes ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><h3>التقييم</h3></td>
                        </tr>
                        <?php
                        if($evaluation = $wam->dbm->getData('evaluations', '*', ['eq' => ['beneficiary' => $beneficiary->id]])){
                            $evaluation = $evaluation[0];
                            ?>
                            <tr>
                                <td><b>تاريخ التقييم</b></td>
                                <td><?php echo date('d/m/Y', $evaluation->date); ?></td>
                            </tr>
                            <tr>
                                <td><b>عفش البيت</b></td>
                                <td><?php echo $evaluation_values[$evaluation->furnishing]; ?></td>
                            </tr>
                            <tr>
                                <td><b>الدخل مقابل المصروف</b></td>
                                <td><?php echo $evaluation_values[$evaluation->income_to_expenses]; ?></td>
                            </tr>
                            <tr>
                                <td><b>نتيجة التقييم</b></td>
                                <td><?php echo $evaluation_values[$evaluation->result]; ?></td>
                            </tr>
                            <tr>
                                <td><b>ملاحظات التقييم</b></td>
                                <td><?php echo $evaluation->notes ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="BENEFICIARIES/edit-evaluation" actionItem="<?php echo $evaluation->id; ?>">تعديل التقييم</button></td>
                            </tr>
                            <?php
                        }else{
                            ?>
                            <tr>
                                <td></td>
                                <td><button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="BENEFICIARIES/add-evaluation" actionItem="<?php echo $beneficiary->id; ?>">اضافة تقييم</button></td>
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
<div class="modal-footer">
    <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">اغلاق</button>
</div>