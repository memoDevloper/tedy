<?php
if($userData = $wam->dbm->getData(['users A', 'employees_freelance B'], [
	'A.id',
	'A.name',
	'A.lastname',
	'A.gender',
	'A.birthdate',
	'A.email',
	'A.username',
	'A.phone',
	'A.skype',
	'A.address',
	'A.timezone',
	'A.start_date',
	'B.ar_en',
	'B.en_ar',
	'B.ar_en_salary',
	'B.en_ar_salary'
], [
	'join' => [
		'type' => 'right',
		'on' => ['A.id', 'B.user']
	],
	'eq' => ['A.id' => $dir5]
])){
	$userData = $userData[0];
	?>
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Edit Freelance Employee</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li>Employees</li>
					<li><a href="/employees/freelance" class="CPB backButton" >Freelance</a></li>
					<li class="active">Edit Employee</li>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="white-box">
					<form class="form-horizontal form-material form">
						<input type="hidden" name="actionName" value="EDIT_EMPLOYEE_FREELANCE">
						<input type="hidden" name="user" value="<?php echo $userData->id ?>">
						<div class="form-group">
							<label class="col-md-12" for="name">First Name</label>
							<div class="col-md-12">
								<div>
									<input type="text" required name="name" class="form-control form-control-line name" required="" id="name" placeholder="First Name" value="<?php echo $userData->name ?>" >
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="lastname">Last Name</label>
							<div class="col-md-12">
								<input type="text" required name="lastname" class="form-control form-control-line lastname" id="lastname" placeholder="Last Name" value="<?php echo $userData->lastname ?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12" for="gender">Gender</label>
							<div class="col-sm-12">
								<select class="form-control form-control-line gender" id="gender" name="gender">
									<option value="1" <?php echo ($userData->gender == 1) ? 'selected' : ''; ?> >Male</option>
									<option value="2" <?php echo ($userData->gender == 2) ? 'selected' : ''; ?> >Female</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12" for="birthdate">Birth Date</label>
							<div class="col-sm-12">
								<input type="text" required name="birthdate" class="form-control form-control-line birthdate mydatepicker" id="birthdate" placeholder="Birth Date" value="<?php echo date('Y-m-d', $userData->birthdate); ?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12" for="start_date">Joining Date</label>
							<div class="col-sm-12">
								<input type="text" required name="start_date" class="form-control form-control-line start_date mydatepicker" id="start_date" placeholder="Joining Date" value="<?php echo date('Y-m-d', $userData->start_date); ?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="email">Email</label>
							<div class="col-md-12">
								<input type="email" required name="email" class="form-control form-control-line email" id="email" placeholder="Email" value="<?php echo $userData->email ?>" >
							</div>
						</div>
                        <div class="form-group">
                            <label class="col-md-12" for="username">Username</label>
                            <div class="col-md-12">
                                <input type="text" required name="username" class="form-control form-control-line email" id="username" placeholder="Username" value="<?php echo $userData->username ?>" >
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-md-12" for="phone">Phone</label>
							<div class="col-md-12">
								<input type="text" required name="phone" class="form-control form-control-line phone" id="phone" placeholder="Phone Number" value="<?php echo $userData->phone ?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="skype">Skype</label>
							<div class="col-md-12">
								<input type="text" name="skype" class="form-control form-control-line skype" id="phone" placeholder="Skype" value="<?php echo $userData->skype ?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="address">Address</label>
							<div class="col-md-12">
								<textarea rows="5" name="address" class="form-control form-control-line address" id="address" placeholder="Address"><?php echo $userData->address ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12" for="timezone">Timezone</label>
							<div class="col-sm-12">
								<select class="form-control form-control-line timezone" id="timezone" name="timezone">
									<option value="Europe/Istanbul" <?php echo ($userData->timezone == "Europe/Istanbul") ? 'selected' : ''; ?> >Istanbul</option>
									<option value="Asia/Dubai" <?php echo ($userData->timezone == "Asia/Dubai") ? 'selected' : ''; ?> >Dubai</option>
									<option value="Africa/Cairo" <?php echo ($userData->timezone == "Africa/Cairo") ? 'selected' : ''; ?> >Cairo</option>
									<option value="Asia/Damascus" <?php echo ($userData->timezone == "Asia/Damascus") ? 'selected' : ''; ?> >Damascus</option>
									<option value="Africa/Khartoum" <?php echo ($userData->timezone == "Africa/Khartoum") ? 'selected' : ''; ?> >Khartoum</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="en_ar">English to Arabic</label>
							<div class="col-md-2 col-xs-3" >
								<input type="checkbox" name="en_ar" id="en_ar" value="1" <?php echo ($userData->en_ar) ? 'checked' : ''; ?> class="js-switch en_ar" data-color="#f96262" />
							</div>
							<div class="col-md-10 col-xs-9">
								<input type="text" name="en_ar_salary" class="form-control form-control-line en_ar_salary" id="en_ar_salary" placeholder="English To Arabic fees per word" value="<?php echo ($userData->en_ar) ? $userData->en_ar_salary : ''; ?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="ar_en">Arabic to English</label>
							<div class="col-md-2 col-xs-3" >
								<input type="checkbox" name="ar_en" id="ar_en" value="1" <?php echo ($userData->ar_en) ? 'checked' : ''; ?> class="js-switch ar_en" data-color="#f96262" />
							</div>
							<div class="col-md-10 col-xs-9">
								<input type="text" name="ar_en_salary" class="form-control form-control-line ar_en_salary" id="ar_en_salary" placeholder="Arabic To English fees per word" value="<?php echo ($userData->ar_en) ? $userData->ar_en_salary : ''; ?>" >
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-success">EDIT</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
}else{}
?>