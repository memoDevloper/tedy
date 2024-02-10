<?php
$user = $wam->dbm->getData('users', [
	'id',
	'name',
	'lastname',
	'gender',
	'birthdate',
	'email',
	'username',
	'phone',
	'avatar',
	'start_date',
	'leaving_date'
], [
	'eq' => ['id' => $user->id]
]);
$user = $user[0];
?>
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">الملف الشخصي</h4>
		</div>
	</div>
	<!-- /.row -->
	<!-- .row -->
	<div class="row">
		<div class="col-md-4 col-xs-12">
			<div class="white-box">
				<div class="user-bg">
					<div class="overlay-box">
						<div class="user-content">
							<a href="javascript:void(0)"><img src="/files/avatars/<?php echo $user->avatar; ?>" class="thumb-lg img-circle" alt="img"></a>
							<h4 class="text-white"><?php echo $user->name ?> <?php echo $user->lastname ?></h4>
							<h5 class="text-white"><?php echo $user->email ?></h5>
							<form class="form">
								<input type="hidden" name="actionName" value="UPDATE_PROFILE_PICTURE">
								<label for="profile_pic" class="btn btn-success profile_pic" >
									<input type="file" name="profile_pic" class="hide" id="profile_pic" >
									تغيير الصورة الشخصية
								</label>
							</form>
						</div>
					</div>
				</div>
				<div class="user-btm-box"></div>
			</div>
		</div>
		<div class="col-md-8 col-xs-12">
			<div class="white-box">
				<ul class="nav nav-tabs tabs customtab">
					<li class="active tab">
						<a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">الملف الشخصي</span> </a>
					</li>
					<li class="tab">
						<a href="#change_password" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">تغيير كلمة المرور</span> </a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="settings">
						<form class="form-horizontal form-material form">
							<input type="hidden" name="actionName" value="UPDATE_PROFILE">
							<div class="form-group">
								<label class="col-md-12" for="name">الاسم</label>
								<div class="col-md-12">
									<div>
										<input type="text" name="name" class="form-control form-control-line name" required="" id="name" placeholder="الاسم" value="<?php echo $user->name; ?>" >
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12" for="lastname">النسبة</label>
								<div class="col-md-12">
									<input type="text" name="lastname" class="form-control form-control-line lastname" id="lastname" placeholder="النسبة" value="<?php echo $user->lastname; ?>" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-12" for="gender">الجنس</label>
								<div class="col-sm-12">
									<select class="form-control form-control-line gender" id="gender" name="gender">
										<option value="1" <?php echo ($user->gender == 1) ? 'selected' : ''; ?> >ذكر</option>
										<option value="2" <?php echo ($user->gender == 2) ? 'selected' : ''; ?> >أنثى</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-12" for="birthdate">تاريخ الميلاد</label>
								<div class="col-sm-12">
									<input type="date" name="birthdate" class="form-control form-control-line birthdate mydatepicker" id="birthdate" placeholder="تاريخ الميلاد" value="<?php echo date('Y-m-d', $user->birthdate); ?>" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12" for="email">الايميل</label>
								<div class="col-md-12">
									<input type="email" name="email" class="form-control form-control-line email" id="email" placeholder="الايميل" value="<?php echo $user->email; ?>" >
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-md-12" for="username">اسم المستخدم</label>
                                <div class="col-md-12">
                                    <input type="text" required name="username" class="form-control form-control-line email" id="username" placeholder="اسم المستخدم" value="<?php echo $user->username ?>" >
                                </div>
                            </div>
							<div class="form-group">
								<label class="col-md-12" for="phone">رقم الهاتف</label>
								<div class="col-md-12">
									<input type="text" name="phone" class="form-control form-control-line phone" id="phone" placeholder="رقم الهاتف" value="<?php echo $user->phone; ?>" >
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-success">حفظ التغييرات</button>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="change_password">
						<form class="form-horizontal form-material form">
							<input type="hidden" name="actionName" value="UPDATE_PROFILE_PASSWORD">
							<div class="form-group">
								<label class="col-md-12" for="old_password">كلمة المرور الحالية</label>
								<div class="col-md-12">
									<div>
										<input type="password" name="old_password" class="form-control form-control-line old_password" required="" id="old_password" placeholder="كلمة المرور الحالية" >
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12" for="new_password">كلمة المرور الجديدة</label>
								<div class="col-md-12">
									<div>
										<input type="password" name="new_password" class="form-control form-control-line new_password" required="" id="new_password" placeholder="كلمة المرور الجديدة" >
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12" for="confirm_password">تأكيد كلمة المرور</label>
								<div class="col-md-12">
									<div>
										<input type="password" name="confirm_password" class="form-control form-control-line confirm_password" required="" id="confirm_password" placeholder="تأكيد كلمة المرور" >
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<input type="checkbox" name="sign_out" class="sign_out" value="1" id="sign_out" >
									<label for="sign_out">تسجيل الخروج من الأجهزة الأخرى</label>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-success">تغيير كلمة المرور</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
</div>