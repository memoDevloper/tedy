<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Archive</h4>
        </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="/archive" class="CPB" >Archive</a></li>
				<li class="active"><?php echo $year->name; ?></li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">ARCHIVE FILES</div>
				<div class="table-responsive">
					<table class="table table-hover manage-u-table">
						<thead>
							<tr>
								<th>MONTH</th>
								<th>FILES</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$months_ = $wam->dbm->getData('files A', [
								'A.id',
								'A.name',
							], [
								'eq' => ['type' => 'month', 'main' => $year->id],
								'order' => ['A.id'],
							]);
							foreach ($months_ as $key => $file) {
								$files = $wam->dbm->rows('projects', ['eq' => ['year' => $year->name, 'month' => $months_inverse[strtolower($file->name)], 'status' => 1, 'accountant_acceptance' => 1]]);
								?>
								<tr>
									<td><a href="/archive/<?php echo $year->name; ?>/<?php echo $file->name ?>" class="CPB" ><?php echo $file->name ?></a></td>
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