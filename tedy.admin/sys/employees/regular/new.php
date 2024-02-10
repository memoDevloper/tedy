<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">موظف جديد</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="/employees" class="CPB backButton">الموظفين</a></li>
                <li class="active">موظف جديد</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material form">
                    <input type="hidden" name="actionName" value="NEW_EMPLOYEE_REGULAR">
                    <div class="form-group">
                        <label class="col-md-12" for="name">الاسم الأول</label>
                        <div class="col-md-12">
                            <div>
                                <input type="text" required name="name" class="form-control form-control-line name"
                                    required="" id="name" placeholder="الاسم الأول">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="lastname">الاسم الأخير</label>
                        <div class="col-md-12">
                            <input type="text" required name="lastname" class="form-control form-control-line lastname"
                                id="lastname" placeholder="الاسم الأخير">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="type">نوع الصلاحيات</label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line type" id="type" name="type">
                                <option value="1">صلاحيات عامة</option>
                                <option value="2">صلاحيات محددة</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="gender">الجنس</label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line gender" id="gender" name="gender">
                                <option value="1">ذكر</option>
                                <option value="2">أنثى</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="birthdate">تاريخ الميلاد</label>
                        <div class="col-sm-12">
                            <input type="text" required name="birthdate"
                                class="form-control form-control-line birthdate mydatepicker" id="birthdate"
                                placeholder="تاريخ الميلاد" value="<?php echo date('Y-m-d', $time); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="email">الايميل</label>
                        <div class="col-md-12">
                            <input type="email" required name="email" class="form-control form-control-line email"
                                id="email" placeholder="الايميل">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="phone">رقم الهاتف</label>
                        <div class="col-md-12">
                            <input type="text" required name="phone" class="form-control form-control-line phone"
                                id="phone" placeholder="رقم الهاتف">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="salary">الراتب</label>
                        <div class="col-md-12">
                            <input type="number" required name="salary" class="form-control form-control-line salary"
                                id="salary" placeholder="الراتب">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="password">كلمة المرور</label>
                        <div class="col-md-12">
                            <input type="password" required name="password"
                                class="form-control form-control-line password" id="password" placeholder="كلمة المرور">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="repassword">تأكيد كلمة المرور</label>
                        <div class="col-md-12">
                            <input type="password" required name="repassword"
                                class="form-control form-control-line repassword" id="repassword"
                                placeholder="تأكيد كلمة المرور">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">اضافة</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
