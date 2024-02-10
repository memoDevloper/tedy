<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title">Translated Files: <?php echo $dir5 ?></h4>
</div>
<?php
$projectNameExplode = explode('-', $dir5);
$projectName = $projectNameExplode[0] . '-' . $projectNameExplode[1] . '-' . $projectNameExplode[2];
if($wam->dbm->check('projects', ['eq' => ['name' => $projectName], 'li' => ['translators' => '[' . $user->id . ']']])){
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-hover manage-u-table" data-toggle="table" data-height="280">
					<thead>
						<tr>
							<th>NAME</th>
							<th>TYPE</th>
							<th>Date</th>
							<th width="300">MANAGE</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$files = $wam->dbm->getData('project_items_translated A', [
							'A.project',
							'A.date',
							'A.user',
							'A.name',
							'A.extension',
						], [
							'eq' => ['A.item' => $dir5],
							'order' => ['A.date DESC'],
						]);
						foreach ($files as $key => $file) {
							?>
							<tr class="item" >
								<td><?php echo $file->name ?></td>
								<td><?php echo strtoupper($file->extension); ?></td>
								<td><?php echo date('d M Y', $file->date); ?></td>
								<td>
									<button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy file code to Clipboard" ><i class="fa fa-clipboard"></i></button>
									<button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5" data-download-tanslated-item="<?php echo $file->name; ?>" data-toggle="tooltip" title="Download File" ><i class="fa fa-download"></i></button>
									<button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5" data-toggle="tooltip" title="Delete File"><i class="ti-trash"></i></button>
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
	<?php
}else{
	?>
	<div class="row">
		<div class="col-md-12">
			<h4>You don't have the permissions to manage this file.</h4>
		</div>
	</div>
	<?php
}
?>