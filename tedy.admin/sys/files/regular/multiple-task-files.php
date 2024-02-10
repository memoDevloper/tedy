<?php

if($wam->dbm->check('project_items_missions', ['eq' => ['mission' => 'MULTIPLE', 'id' => $dir5]]) || $wam->dbm->check('projects', ['li' => ['translators' => "[$user->id]"]])){
	$task = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission'], ['eq' => ['mission' => 'MULTIPLE', 'id' => $dir5]]);
	$task = $task[0];
	?>
	<div class="modal-header">
		<h3>Files List: <?php echo $task->item ?></h3>
	</div>
	<div class="modal-body">
		<div class="row" >
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-hover manage-u-table" >
						<thead>
							<tr>
								<th>File</th>
								<th width="300">MANAGE</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$files = $wam->dbm->getData('project_items_missions_files A', [
								'A.id',
							], [
								'li' => ['A.mission' => $task->id],
								'order' => ['A.id'],
							]);
							$i = 1;
							foreach ($files as $key => $file) {
								?>
								<tr class="item" >
									<td><?php echo 'File ' . $i; ?></td>
									<td>
										<button type="button" class="btn btn-info btn-outline btn-circle m-r-5" data-download-file="<?php echo $file->id; ?>" data-type="multiple" data-toggle="tooltip" title="Download File" ><i class="fa fa-download"></i></button>
									</td>
								</tr>
								<?php
								++$i;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
	<?php
}else{
	?>
	<div class="modal-body">
		<h3>You Don't Have the Permission to Access this Page.</h3>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
	<?php
}

?>