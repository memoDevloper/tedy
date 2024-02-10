<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Edit Company</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="/clients" class="CPB backButton" >Clients</a></li>
				<li class="active">Edit Company</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="white-box">
				<form class="form-horizontal form-material form" autocomplete="off">
					<input type="hidden" name="actionName" value="EDIT_COMPANY">
					<input type="hidden" name="id" value="<?php echo $client->id ?>">
					<div class="form-group">
						<label class="col-md-12" for="name">Company Name</label>
						<div class="col-md-12">
							<div>
								<input type="text" required name="name" class="form-control form-control-line name" required="" id="name" placeholder="Company Name" value="<?php echo $client->name ?>" >
							</div>
						</div>
					</div>
                    <div class="form-group">
                        <label class="col-md-12" for="reference">Reference Number</label>
                        <div class="col-md-12">
                            <div>
                                <input type="number" name="reference" class="form-control form-control-line reference" id="reference" placeholder="Reference Number" value="<?php echo $client->reference ?>" >
                            </div>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-12" for="email">Email</label>
						<div class="col-md-12">
							<input type="text" name="email" class="form-control form-control-line email" id="email" placeholder="Email" value="<?php echo $client->email ?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="phone">Phone</label>
						<div class="col-md-12">
							<input type="text" name="phone" class="form-control form-control-line phone" id="phone" placeholder="Phone Number" value="<?php echo $client->phone ?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="address">Address</label>
						<div class="col-md-12">
							<textarea rows="5" name="address" class="form-control form-control-line address" id="address" placeholder="Address"><?php echo $client->address ?></textarea>
						</div>
					</div>
                    <div class="form-group">
                        <label class="col-sm-12" for="billing_date">Billing Date</label>
                        <div class="col-sm-12">
                            <select name="billing_date" id="billing_date" class="billing_date" >
                                <?php
                                for ($d = 1; $d < 32; ++$d){
                                    ?>
                                    <option value="<?php echo $d ?>" <?php echo ($client->billing_date == $d) ? 'selected' : ''; ?> ><?php echo $d ?></option>
                                    <?php
                                }
                                ?>
                            </select>
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