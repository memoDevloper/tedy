<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Archive</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="/archive" class="CPB" >Archive</a></li>
				<li><a href="/archive/<?php echo $year->name; ?>" class="CPB" ><?php echo $year->name; ?></a></li>
				<li class="active"><?php echo $month->name; ?></li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">ARCHIVE JOBS</div>
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
                            $days = $wam->dbm->getData('files A', [
                                'A.id',
                                'A.name',
                            ], [
                                'eq' => ['type' => 'day', 'main' => $month->id],
                                'order' => ['A.id'],
                            ]);
							foreach ($days as $key => $file) {
								$files = $wam->dbm->rows('projects', ['eq' => ['year' => $year->name, 'month' => $months_inverse[strtolower($month->name)], 'day' => $file->name, 'status' => 1, 'accountant_acceptance' => 1]]);
								?>
								<tr>
									<td><a href="/archive/<?php echo $year->name; ?>/<?php echo $month->name ?>/<?php echo $file->name ?>" class="CPB" ><?php echo $file->name ?></a></td>
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