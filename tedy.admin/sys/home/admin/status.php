<div class="modal-header">
	<div class="row" >
		<div class="col-xs-12" >
			<h4 class="pull-left" ><?php echo ucfirst($dir5); ?></h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		</div>
	</div>
</div>
<div class="modal-body">
	<div class="table-responsive">
		<table class="table table-hover manage-u-table">
			<thead>
				<tr>
					<th>CODE</th>
					<th>CLIENT</th>
					<th>DEADLINE</th>
					<th>TARGET</th>
					<th>PAGES</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($dir5 == 'new'){
					$q['not']['A.status'] = [1, 2, 3, 4];
				}else{
					$status = [
						'done' => 1,
						'amend' => 2,
						'pending' => 3,
						'temp' => 4
					][$dir5];
					$q['eq']['A.status'] = $status;
				}
				$q['order'] = ['A.name'];
				$files = $wam->dbm->getData('projects A', [
					'A.id',
					'A.client',
					'(SELECT name FROM clients WHERE id = A.client) as client_name',
					'(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
					'A.deadline',
					'A.direction',
					'A.status',
					'A.pages',
					'A.name',
				], $q);
				foreach ($files as $key => $file) {
					?>
					<tr class="item" >
						<td>
							<a href="/files/open/<?php echo $file->name; ?>" class="CPB" ><?php echo $file->name ?></a>
							<a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy File Code to Clipboard" ><i class="fa fa-clipboard"></i></a>
						</td>
						<td><?php echo $file->client_name ?> <?php echo $file->client_lastname ?></td>
						<td><?php echo date('Y-m-d h:I A', $file->deadline); ?></td>
						<td><?php echo strtoupper($file->direction) ?></td>
						<td><?php echo $file->pages ?></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>