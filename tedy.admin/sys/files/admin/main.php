<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Jobs</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/files/new" class="btn btn-danger pull-right m-l-20 waves-effect waves-light CPB">New Job</a>
			<ol class="breadcrumb">
				<li><a href="/files" class="CPB" >Jobs</a></li>
				<li><a href="/files/<?php echo $year->name; ?>" class="CPB" ><?php echo $year->name; ?></a></li>
				<li><a href="/files/<?php echo $year->name; ?>/<?php echo $month->name; ?>" class="CPB" ><?php echo $month->name; ?></a></li>
				<li class="active"><?php echo $day->name; ?></li>
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
								<th>CODE</th>
								<th>MANAGER</th>
								<th>CLIENT</th>
								<th>STATUS</th>
                                <th>Priority</th>
								<th>DEADLINE</th>
								<th>TARGET</th>
								<th>FILES</th>
                                <th>PROGRESS</th>
								<th>MANAGE</th>
                                <th>NOTES</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$files = $wam->dbm->getData('projects A', [
								'A.id',
								'A.client',
								'(SELECT name FROM clients WHERE id = A.client) as client_name',
								'(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
								'A.deadline',
								'A.translators',
								'A.direction',
								'A.status',
								'A.pages',
								'A.name',
                                'A.progress_ratio',
                                'A.priority',
                                'A.accountant_acceptance',
							], [
								'eq' => ['A.year' => $year->name, 'A.month' => $months_inverse[strtolower($month->name)], 'A.day' => $day->name],
								'not' => ['A.status' => 1],
								'order' => ['A.deadline, A.name'],
							]);
							foreach ($files as $key => $file) {
								?>
								<tr class="item" >
									<td>
										<a href="/files/open/<?php echo $file->name; ?>" class="CPB" >
											<?php
											$name_parts = explode('-', $file->name);
											$name = $name_parts[0];
											$name .= "-";
											$name .= substr($name_parts[1], 0, 4);
											$dayname = substr($name_parts[1], 4, 5);
											$name .= substr_replace($name_parts[1], "<span style='color: red' >$dayname", 0);
											$name .= "-$name_parts[2]</span>";
                                            echo "<b>" . $name . "</b>";
											?>
										</a>
										<a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy File Code to Clipboard" ><i class="fa fa-clipboard"></i></a>
									</td>
									<td>
										<?php
										$translators = explode('[//]', $file->translators);
										foreach ($translators as $key => $translator) {
											$translator_id = str_replace(['[', ']'], ['', ''], $translator);
											$translator = $wam->dbm->getData('users', ['name', 'lastname'], ['eq' => ['id' => $translator_id]]);
											$translator = $translator[0];
											?>
											<?php echo $translator->name ?> <?php echo $translator->lastname ?><br />
											<?php
										}
										?>
									</td>
									<td><?php echo $file->client_name ?> <?php echo $file->client_lastname ?></td>
									<td>
										<?php
										$status = [
											1 => 'Done',
											2 => 'Amend',
											3 => 'Pending',
											4 => 'Temp'
										][$file->status];
                                        if($file->status == 1 && $file->accountant_acceptance){
                                            $status = 'Posted';
                                        }
										echo $status;
										?>
									</td>
                                    <td>
                                        <?php
                                        if(!empty($file->priority)){
                                            if($file->priority == "high"){
                                                ?>
                                                <i class="fa fa-flag" style="color:red;" ></i>
                                                <?php
                                            }else{
                                                ?>
                                                <i class="fa fa-flag" style="color:orange;" ></i>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $wam->act->makeBoldDeadline($file->deadline); ?></td>
									<td><?php echo strtoupper($file->direction) ?></td>
									<td><?php echo $file->pages ?></td>
                                    <td>
                                        <span class="text-danger" ><?php echo number_format($file->progress_ratio, 1); ?>%</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo number_format($file->progress_ratio, 1); ?>%;">
                                                <span class="sr-only"><?php echo number_format($file->progress_ratio, 1); ?>% Complete</span>
                                            </div>
                                        </div>
                                    </td>
									<td>
										<a href="/files/edit/<?php echo $file->name; ?>" class="btn btn-info btn-outline btn-circle m-r-5 CPB" data-toggle="tooltip" title="Edit File" ><i class="ti-pencil-alt"></i></a>
										<button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="PROJECTS" actionItem="options/<?php echo $file->id; ?>" data-toggle="tooltip" title="File Options" ><i class="fa fa-gear"></i></button>
										<button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_PROJECT" data-item-id="<?php echo $file->id; ?>" data-toggle="tooltip" title="Delete File"><i class="ti-trash"></i></button>
									</td>
                                    <td>
                                        <button class="btn <?php echo ($wam->dbm->check('notes', ['eq' => ['section' => 'jobs', 'item' => $file->id]])) ? 'btn-danger' : 'btn-info'; ?> btn-outline btn-circle m-r-5 DIM" actionName="TRANSLATED_FILES" actionItem="notes-jobs/<?php echo $file->id; ?>" data-toggle="tooltip" title="Notes" ><i class="fa fa-comment"></i></button>
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