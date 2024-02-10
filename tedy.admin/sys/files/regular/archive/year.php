<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Archive</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li class="active">Archive</li>
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
								<th>YEAR</th>
								<th>JOBS</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$availabel_years = $wam->dbm->getData('projects', ['id', 'year'], [
							    'eq' => ['status' => 1, 'accountant_acceptance' => 1],
								//'li' => ['translators' => "[" . $user->id . "]"],
								'group' => ['year'],
							]);
							foreach ($availabel_years as $key => $availabel_year) {
								$years_to_load[] = $availabel_year->year;
							}
							$years = $wam->dbm->getData('files A', [
								'A.id',
								'A.name',
							], [
								'eq' => ['A.type' => 'year', 'A.main' => 0],
								'order' => ['A.name'],
							]);
							foreach ($years as $key => $file) {
								$files = $wam->dbm->rows('projects', ['eq' => ['year' => $file->name, 'status' => 1, 'accountant_acceptance' => 1]]);
								?>
								<tr>
									<td><a href="/archive/<?php echo $file->name; ?>" class="CPB" ><?php echo $file->name ?></a></td>
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