<?php
if($userData = $wam->dbm->getData('users A', [
	'A.id',
	'A.type',
	'A.name',
	'A.lastname',
	'A.gender',
	'A.birthdate',
	'A.email',
	'A.phone',
	'A.permissions',
	'A.salary',
	'A.rph',
], [
	'eq' => ['A.id' => $dir4]
])){
	$userData = $userData[0];
	?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">تعديل موظف</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="/employees" class="CPB backButton">الموظفين</a></li>
                <li class="active">تعديل موظف</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material form">
                    <input type="hidden" name="actionName" value="EDIT_EMPLOYEE_REGULAR">
                    <input type="hidden" name="user" value="<?php echo $userData->id ?>">
                    <div class="form-group">
                        <label class="col-md-12" for="name">الاسم الأول</label>
                        <div class="col-md-12">
                            <div>
                                <input type="text" required name="name" class="form-control form-control-line name"
                                    required="" id="name" placeholder="الاسم الأول"
                                    value="<?php echo $userData->name ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="lastname">الاسم الأخير</label>
                        <div class="col-md-12">
                            <input type="text" required name="lastname" class="form-control form-control-line lastname"
                                id="lastname" placeholder="الاسم الأخير" value="<?php echo $userData->lastname ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="type">نوع الصلاحيات</label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line type" id="type" name="type">
                                <option value="1" <?php echo ($userData->type == 1) ? 'selected' : ''; ?>>صلاحيات عامة
                                </option>
                                <option value="2" <?php echo ($userData->type == 2) ? 'selected' : ''; ?>>صلاحيات محددة
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="gender">الجنس</label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line gender" id="gender" name="gender">
                                <option value="1" <?php echo ($userData->gender == 1) ? 'selected' : ''; ?>>ذكر</option>
                                <option value="2" <?php echo ($userData->gender == 2) ? 'selected' : ''; ?>>أنثى
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="birthdate">تاريخ الميلاد</label>
                        <div class="col-sm-12">
                            <input type="text" required name="birthdate"
                                class="form-control form-control-line birthdate mydatepicker" id="birthdate"
                                placeholder="تاريخ الميلاد" value="<?php echo date('Y-m-d', $userData->birthdate); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="email">الايميل</label>
                        <div class="col-md-12">
                            <input type="email" required name="email" class="form-control form-control-line email"
                                id="email" placeholder="الايميل" value="<?php echo $userData->email ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="phone">رقم الهاتف</label>
                        <div class="col-md-12">
                            <input type="text" required name="phone" class="form-control form-control-line phone"
                                id="phone" placeholder="رقم الهاتف" value="<?php echo $userData->phone ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="salary">الراتب</label>
                        <div class="col-md-12">
                            <input type="number" required name="salary" class="form-control form-control-line salary"
                                id="salary" placeholder="الراتب" value="<?php echo $userData->salary ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">تعديل</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}else{echo mysql_error();}
?>
