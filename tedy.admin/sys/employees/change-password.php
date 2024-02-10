<?php
if($user->type == 1 || in_array('account', $user->permissions)){
    ?>
    <?php
    $employee = $wam->dbm->getData('users A', [
        'A.id',
        'A.name',
        'A.lastname',
    ], [
        'eq' => ['A.id' => $dir5]
    ]);
    $employee = $employee[0];
    ?>
    <div class="modal-header">
        <div class="row" >
            <div class="col-xs-12" >
                <div class="pull-left" >
                    <h4>تغيير كلمة مرور موظف</h4>
                    <h4>الموظف: <?php echo $employee->name ?> <?php echo $employee->lastname ?></h4>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
        </div>
    </div>
    <form class="form-horizontal form-material form" >
        <div class="modal-body" >
            <div class="row" >
                <input type="hidden" name="actionName" value="CHANGE_EMPLOYEE_PASSWORD" />
                <input type="hidden" name="employee" value="<?php echo $employee->id; ?>" />
                <div class="col-sm-12" >
                    <div class="form-group">
                        <label class="col-md-12" for="psw1">كلمة المرور الجديدة</label>
                        <div class="col-md-12">
                            <input type="password" name="psw1" class="form-control form-control-line psw1" id="psw1" placeholder="كلمة المرور الجديدة" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" >
                    <div class="form-group">
                        <label class="col-md-12" for="psw2">تأكيد كلمة المرور</label>
                        <div class="col-md-12">
                            <input type="password" name="psw2" class="form-control form-control-line psw2" id="psw2" placeholder="تأكيد كلمة المرور" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="checkbox" name="sign_out" class="sign_out" value="1" id="sign_out" >
                            <label for="sign_out">تسجيل الخروج من الأجهزة الأخرى</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" >
            <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true" >الغاء</button>
            <button type="submit" class="btn btn-success waves-effect waves-light">تغيير كلمة المرور</button>
        </div>
    </form>
    <?php
}