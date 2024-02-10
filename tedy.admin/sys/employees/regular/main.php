<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">الموظفين</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/employees/new" class="btn btn-danger pull-right m-l-20 waves-effect waves-light CPB">موظف جديد</a>
			<ol class="breadcrumb">
				<li>الموظفين</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">ادارة الموظفين</div>
				<div class="table-responsive">
					<table class="table table-hover manage-u-table">
						<thead>
							<tr>
								<th>الاسم</th>
								<th>نوع التوظيف</th>
								<th>رقم الهاتف</th>
								<th>الايميل</th>
								<th>إدارة</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$regular_users = $wam->dbm->getData('users A', [
								'A.id',
								'A.name',
								'A.type',
								'A.lastname',
								'A.email',
								'A.phone',
							], [
								'eq' => ['A.type' => [1, 2, 3, 4, 5]],
							]);
							foreach ($regular_users as $key => $regular_user) {
								?>
								<tr class="item" >
									<td><?php echo $regular_user->name ?> <?php echo $regular_user->lastname ?></td>
									<td><?php echo $employment_types[$regular_user->type]; ?></td>
									<td><?php echo $regular_user->phone ?></td>
									<td><?php echo $regular_user->email ?></td>
									<td>
										<button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="EMPLOYEES/change-password" actionItem="<?php echo $regular_user->id; ?>"><i class="ti-key"></i></button>
										<a href="/employees/edit/<?php echo $regular_user->id ?>" class="btn btn-info btn-outline btn-circle m-r-5 CPB"><i class="ti-pencil-alt"></i></a>
										<button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_EMPLOYEE" data-item-id="<?php echo $regular_user->id; ?>" ><i class="ti-trash"></i></button>
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