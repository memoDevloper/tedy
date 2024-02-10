<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Freelance Employees</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/employees/freelance/new" class="btn btn-danger pull-right m-l-20 waves-effect waves-light CPB">New Employee</a>
			<ol class="breadcrumb">
				<li>Employees</li>
				<li class="active">Freelance</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">MANAGE USERS</div>
				<div class="table-responsive">
					<table class="table table-hover manage-u-table">
						<thead>
							<tr>
								<th width="70" class="text-center">#</th>
								<th>NAME</th>
								<th>TIMEZONE</th>
								<th>PHONE</th>
								<th>SKYPE</th>
								<th>EMAIL</th>
								<th width="300">MANAGE</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$freelance_users = $wam->dbm->getData(['users A', 'employees_freelance B'], [
								'A.id',
								'A.name',
								'A.lastname',
								'A.email',
								'A.phone',
								'A.timezone',
								'A.skype',
							], [
								'join' => [
									'on' => ['A.id', 'B.user'],
									'type' => 'right'
								],
								'eq' => ['A.type' => 3, 'A.active' => 1],
								'not' => ['A.id' => $user->id],
							]);
							foreach ($freelance_users as $key => $freelance_user) {
								?>
								<tr class="item" >
									<td class="text-center"><?php echo $freelance_user->id ?></td>
									<td><?php echo $freelance_user->name ?> <?php echo $freelance_user->lastname ?></td>
									<td>
										<?php 
										$city = explode('/', $freelance_user->timezone);
										echo $city[1];
										?>
									</td>
									<td><?php echo $freelance_user->phone ?></td>
									<td><?php echo $freelance_user->skype ?></td>
									<td><?php echo $freelance_user->email ?></td>
									<td>
										<button class="btn btn-info btn-outlin m-r-5 DIM" actionName="EMPLOYEES" actionItem="tasks/<?php echo $freelance_user->id; ?>" data-toggle="tooltip" title="Tasks" >Tasks</button>
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="EMPLOYEES/change-password" actionItem="<?php echo $freelance_user->id; ?>"><i class="ti-key"></i></button>
										<a href="/employees/freelance/edit/<?php echo $freelance_user->id ?>" class="btn btn-info btn-outline btn-circle m-r-5 CPB"><i class="ti-pencil-alt"></i></a>
										<button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_EMPLOYEE" data-item-id="<?php echo $freelance_user->id; ?>"><i class="ti-trash"></i></button>
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