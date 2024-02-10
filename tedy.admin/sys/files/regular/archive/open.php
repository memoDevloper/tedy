<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">File: <?php echo $file->name; ?></h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="/archive" class="CPB backButton" >Archive</a></li>
				<li><a href="/archive/<?php echo $file->year; ?>" class="CPB backButton" ><?php echo $file->year; ?></a></li>
				<li><a href="/archive/<?php echo $file->year; ?>/<?php echo $months_short[$file->month]; ?>" class="CPB backButton" ><?php echo $months_short[$file->month]; ?></a></li>
				<li><a href="/archive/<?php echo $file->year; ?>/<?php echo $months_short[$file->month]; ?>/<?php echo sprintf("%02d", $file->day); ?>" class="CPB backButton" ><?php echo sprintf("%02d", $file->day); ?></a></li>
				<li class="active"><?php echo $file->name; ?></li>
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
								<th width="160" >CODE</th>
								<th>TITLE</th>
								<th>TARGET</th>
								<th>PAGES</th>
								<th>DEADLINE</th>
								<th>PROGRESS</th>
                                <th>Source</th>
								<th>Final File</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$files = $wam->dbm->getData('project_items A', [
								'A.id',
								'A.name',
								'A.original_name',
								'A.pages',
                                'A.direction',
								'A.extension',
								'A.deadline',
                                'A.translate_file',
                                'A.progress_ratio',
							], [
								'eq' => ['A.project' => $file->id],
								'order' => ['A.name'],
							]);
							foreach ($files as $key => $file) {
								?>
								<tr class="item" >
									<td>
                                        <?php
                                        $name_parts = explode('-', $file->name);
                                        $name = $name_parts[0];
                                        $name .= "-";
                                        $name .= substr($name_parts[1], 0, 4);
                                        $dayname = substr($name_parts[1], 4, 5);
                                        $name .= substr_replace($name_parts[1], "<span style='color: red' >$dayname", 0);
                                        $name .= "-$name_parts[2]</span><span style='color: green;' >-$name_parts[3]</span>";
                                        echo $name;
                                        ?>
										<a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy file code to Clipboard" ><i class="fa fa-clipboard"></i></a>
									</td>
									<td><?php echo $file->original_name ?></td>
									<td><?php echo strtoupper($file->direction); ?></td>
									<td><?php echo $file->pages ?></td>
									<td><?php echo date('Y-m-d h:I A', $file->deadline); ?></td>
									<td>
                                        <span class="text-danger" ><?php echo number_format($file->progress_ratio, 1); ?>%</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo number_format($file->progress_ratio, 1); ?>%;">
                                                <span class="sr-only"><?php echo number_format($file->progress_ratio, 1); ?>% Complete</span>
                                            </div>
                                        </div>
									</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5" data-download-item="<?php echo $file->name; ?>" data-toggle="tooltip" title="Download File" ><i class="fa fa-download"></i></button>
                                    </td>
									<td>
										<?php
										if($file->translate_file){
											if($final = $wam->dbm->getData('project_items_translated', ['id'], ['eq' => ['mission_file' => $file->translate_file]])){
												$final = $final[0];
												?>
												<button type="button" class="btn btn-success btn-outline btn-circle m-r-5" data-toggle="tooltip" data-download-file="<?php echo $final->id; ?>" data-type="final" title="Downlaod Final File" ><i class="fa fa-download"></i></button>
												<?php
											}else{
												?>
												<button type="button" class="btn btn-success btn-outline btn-circle m-r-5 disabled" disabled data-toggle="tooltip" title="No Final File" ><i class="fa fa-download"></i></button>
												<?php
											}
										}else{
											?>
											<button type="button" class="btn btn-success btn-outline btn-circle m-r-5 disabled" disabled data-toggle="tooltip" title="No Final File" ><i class="fa fa-download"></i></button>
											<?php
										}
										?>
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