<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">New Client</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="/clients" class="CPB backButton" >Clients</a></li>
				<li class="active">New Client</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="white-box">
				<form class="form-horizontal form-material form" autocomplete="off">
					<input type="hidden" name="actionName" value="NEW_CLIENT">
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
						<label class="col-sm-12" for="company">Company</label>
						<div class="col-sm-12">
							<select class="form-control form-control-line company" id="company" name="company">
								<option value="0" >No Company</option>
								<?php
								$companies = $wam->dbm->getData('clients', ['id', 'name'], ['eq' => ['type' => 2], 'order' => ['reference']]);
								foreach ($companies as $key => $company) {
									?>
									<option value="<?php echo $company->id ?>" ><?php echo $company->name; ?></option>
									<?php
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="reference">Reference Number</label>
						<div class="col-md-12">
							<div>
								<input type="number" name="reference" class="form-control form-control-line reference" id="reference" placeholder="Reference Number" >
							</div>
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
							<input type="text" name="birthdate" class="form-control form-control-line birthdate mydatepicker" id="birthdate" placeholder="Birth Date" value="<?php echo date('Y-m-d', $time); ?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="email">Email</label>
						<div class="col-md-12">
							<input type="text" name="email" class="form-control form-control-line email" id="email" placeholder="Email" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="phone">Phone</label>
						<div class="col-md-12">
							<input type="text" name="phone" class="form-control form-control-line phone" id="phone" placeholder="Phone Number" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="address">Address</label>
						<div class="col-md-12">
							<textarea rows="5" name="address" class="form-control form-control-line address" id="address" placeholder="Address"></textarea>
						</div>
					</div>
                    <div class="form-group">
                        <label class="col-sm-12" for="billing_date">Billing Date</label>
                        <div class="col-sm-12">
                            <select name="billing_date" id="billing_date" class="billing_date" >
                                <?php
                                for ($d = 1; $d < 32; ++$d){
                                    ?>
                                    <option value="<?php echo $d ?>" ><?php echo $d ?></option>
                                    <?php
                                }
                                ?>
                            </select>
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