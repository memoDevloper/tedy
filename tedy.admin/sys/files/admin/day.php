<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Jobs</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/files/new" class="btn btn-danger pull-right m-l-20 waves-effect waves-light CPB">New Job</a>
			<ol class="breadcrumb">
				<li><a href="/files" class="CPB" >Jobs</a></li>
				<li><a href="/files/<?php echo $year->name; ?>" class="CPB" ><?php echo $year->name; ?></a></li>
				<li class="active"><?php echo $month->name; ?></li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">GENERAL</div>
				<div class="table-responsive">
					<table class="table table-hover manage-u-table">
						<thead>
							<tr>
								<th>DAY</th>
								<th>JOBS</th>
							</tr>
						</thead>
						<tbody>
							<?php
                            $availabel_days = $wam->dbm->getData('projects', ['id', 'day'], [
                                'eq' => ['year' => $year->name, 'month' => $months_inverse[strtolower($month->name)]],
                                'not' => ['status' => 1],
                                'group' => ['day'],
                            ]);
                            foreach ($availabel_days as $key => $availabel_day) {
                                $days_to_load[] = sprintf("%02d", $availabel_day->day);
                            }
                            $days = $wam->dbm->getData('files A', [
                                'A.id',
                                'A.name',
                            ], [
                                'eq' => ['A.type' => 'day', 'A.main' => $month->id, 'A.name' => $days_to_load],
                                'order' => ['A.id'],
                            ]);
							foreach ($days as $key => $file) {
								$files = $wam->dbm->rows('projects', ['eq' => ['year' => $year->name, 'month' => $months_inverse[strtolower($month->name)], 'day' => $file->name], 'not' => ['status' => 1]]);
								?>
								<tr>
									<td><a href="/files/<?php echo $year->name; ?>/<?php echo $month->name ?>/<?php echo $file->name ?>" class="CPB" ><?php echo $file->name ?></a></td>
									<td><?php echo $files ?></td>
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