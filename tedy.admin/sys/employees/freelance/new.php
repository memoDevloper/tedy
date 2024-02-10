<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">New Freelance Employee</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li>Employees</li>
				<li><a href="/employees/freelance" class="CPB backButton" >Freelance</a></li>
				<li class="active">New Employee</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="white-box">
				<form class="form-horizontal form-material form">
					<input type="hidden" name="actionName" value="NEW_EMPLOYEE_FREELANCE">
					<div class="form-group">
						<label class="col-md-12" for="name">First Name</label>
						<div class="col-md-12">
							<div>
								<input type="text" required name="name" class="form-control form-control-line name" required="" id="name" placeholder="First Name" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="lastname">Last Name</label>
						<div class="col-md-12">
							<input type="text" required name="lastname" class="form-control form-control-line lastname" id="lastname" placeholder="Last Name" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-12" for="gender">Gender</label>
						<div class="col-sm-12">
							<select class="form-control form-control-line gender" id="gender" name="gender">
								<option value="1" >Male</option>
								<option value="2" >Female</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-12" for="birthdate">Birth Date</label>
						<div class="col-sm-12">
							<input type="text" required name="birthdate" class="form-control form-control-line birthdate mydatepicker" id="birthdate" placeholder="Birth Date" value="<?php echo date('Y-m-d', $time); ?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-12" for="start_date">Joining Date</label>
						<div class="col-sm-12">
							<input type="text" required name="start_date" class="form-control form-control-line start_date mydatepicker" id="start_date" placeholder="Birth Date" value="<?php echo date('Y-m-d', $time); ?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="email">Email</label>
						<div class="col-md-12">
							<input type="email" required name="email" class="form-control form-control-line email" id="email" placeholder="Email" >
						</div>
					</div>
                    <div class="form-group">
                        <label class="col-md-12" for="username">Username</label>
                        <div class="col-md-12">
                            <input type="text" required name="username" class="form-control form-control-line email" id="username" placeholder="Username" >
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-12" for="phone">Phone</label>
						<div class="col-md-12">
							<input type="text" required name="phone" class="form-control form-control-line phone" id="phone" placeholder="Phone Number" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="skype">Skype</label>
						<div class="col-md-12">
							<input type="text" name="skype" class="form-control form-control-line skype" id="phone" placeholder="Skype" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="address">Address</label>
						<div class="col-md-12">
							<textarea rows="5" name="address" class="form-control form-control-line address" id="address" placeholder="Address"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-12" for="timezone">Timezone</label>
						<div class="col-sm-12">
							<select class="form-control form-control-line timezone" id="timezone" name="timezone">
								<option value="Europe/Istanbul" >Istanbul</option>
								<option value="Asia/Dubai" >Dubai</option>
								<option value="Africa/Cairo" >Cairo</option>
								<option value="Asia/Damascus" >Damascus</option>
								<option value="Africa/Khartoum" >Khartoum</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="password">Password</label>
						<div class="col-md-12">
							<input type="password" required name="password" class="form-control form-control-line password" id="password" placeholder="password" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="repassword">Re-peat Password</label>
						<div class="col-md-12">
							<input type="password" required name="repassword" class="form-control form-control-line repassword" id="repassword" placeholder="repassword" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="en_ar">English to Arabic</label>
						<div class="col-md-2 col-xs-3" >
							<input type="checkbox" name="en_ar" id="en_ar" value="1" checked class="js-switch en_ar" data-color="#f96262" />
						</div>
						<div class="col-md-10 col-xs-9">
							<input type="text" name="en_ar_salary" class="form-control form-control-line en_ar_salary" id="en_ar_salary" placeholder="English To Arabic fees per word" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="ar_en">Arabic to English</label>
						<div class="col-md-2 col-xs-3" >
							<input type="checkbox" name="ar_en" id="ar_en" value="1" checked class="js-switch ar_en" data-color="#f96262" />
						</div>
						<div class="col-md-10 col-xs-9">
							<input type="text" name="ar_en_salary" class="form-control form-control-line ar_en_salary" id="ar_en_salary" placeholder="Arabic To English fees per word" >
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-success">ADD</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>