<?php

$employee = $wam->dbm->getData('users', [
	'id',
	'name',
	'lastname',
	'type'
], [
	'eq' => ['id' => $dir5]
]);
$employee = $employee[0];
if($dir6 == ''){
    $year = date('Y', $time);
    $month = date('m', $time);
    $day = date('d', $time);
}else{
    $date = explode('-', $dir6);
    $year = $date[0];
    $month = $date[1];
    $day = $date[2];
}
?>
<div class="modal-header">
	<div class="row" >
		<div class="col-xs-12" >
			<div class="pull-left" >
				<h4>Employee: <?php echo $employee->name ?> <?php echo $employee->lastname ?></h4>
				<h4>
					Employment Type:
					<?php
					if($employee->type == 2 || $employee->type == 1){
						echo 'Regular';
					}elseif($employee->type == 3){
						echo 'Freelance';
					}
					?>
				</h4>
			</div>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		</div>
	</div>
    <div class="row">
        <?php
        $years = [2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026];
        foreach ($years as $key => $year_) {
            ?>
            <div class="col-md-1 col-xs-3"><a href="#" class="DIM <?php echo ($year == $year_) ? 'text-warning' : ''; ?>" actionName="EMPLOYEES/tasks" actionItem="<?php echo $employee->id ?>/<?php echo $year_ ?>-<?php echo $month; ?>" ><?php echo $year_; ?></a></div>
            <?php
        }
        ?>
    </div>
    <div class="row">
        <?php
        foreach ($months_short as $key => $month_) {
            ?>
            <div class="col-md-1 col-xs-3"><a href="#" class="DIM <?php echo ($month == $key) ? 'text-warning' : ''; ?>" actionName="EMPLOYEES/tasks" actionItem="<?php echo $employee->id ?>/<?php echo $year ?>-<?php echo $key; ?>" ><?php echo $month_; ?></a></div>
            <?php
        }
        ?>
    </div>
</div>
<form class="form-horizontal form-material form" >
	<div class="modal-body">
		<div class="row" >
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-hover manage-u-table" >
						<thead>
							<tr>
								<th width="220" >CODE</th>
								<th>Job Manager</th>
								<th>Task</th>
								<th>Part</th>
								<th>Deadline</th>
                                <th>Sent</th>
								<th>Viewed</th>
                                <th>Received</th>
								<th width="150">MANAGE</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$files = $wam->dbm->getData('project_items_missions A', [
								'A.id',
								'A.project',
								'A.date',
								'A.deadline',
								'A.translator',
								'A.pages',
								"A.direction",
								"(SELECT name FROM users WHERE id = A.translator) as translator_name",
								"(SELECT lastname FROM users WHERE id = A.translator) as translator_lastname",
								'(SELECT translators FROM projects WHERE id = A.project) as job_managers',
								'A.item as name',
								'A.extension',
								'A.viewed',
								'A.mission',
                                'A.missions',
                                'A.notes',
								'A.message',
								"(SELECT id FROM project_items_translated WHERE mission = A.mission AND mission_file = A.id Limit 1) as mission_file",
                                "(SELECT date FROM project_items_translated WHERE mission = A.mission AND mission_file = A.id Limit 1) as received",
							], [
								'eq' => ['A.translator' => $dir5, 'A.year' => $year, 'A.month' => $month],
								'order' => ['A.deadline'],
							]);
							foreach ($files as $key => $file) {
                                unset($job_managersIDS);
                                $job_managers = explode('[//]', $file->job_managers);
                                foreach ($job_managers as $key => $job_manager){
                                    $job_managersIDS[] = str_ireplace(['[', ']'], ['', ''], $job_manager);
                                }
                                $job_managers = $wam->dbm->getData('users', 'name, lastname', ['eq' => ['id' => $job_managersIDS]]);
                                $missions = explode('[//]', $file->missions);
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
										//$name = "$name_parts[0]-<span style='color: red' >$name_parts[1]-$name_parts[2]-$name_parts[3]</span>-$name_parts[4]";
										?>
										<label for="relied_<?php echo $file->id; ?>" ><?php echo $name; ?></label>
										<a  data-file="<?php echo "$name_parts[0]-$name_parts[1]-$name_parts[2]-$name_parts[3]"; ?>" data-toggle="tooltip" title="Copy file code to Clipboard" ><i class="fa fa-clipboard"></i></a>
									</td>
                                    <td>
                                        <?php
                                        foreach ($job_managers as $key => $job_manager){
                                            echo "$job_manager->name $job_manager->lastname<br />";
                                        }
                                        ?>
                                    </td>
                                    <td><a href="#" message-present data-type="success" data-message="<?php echo $file->notes; ?>"><?php foreach($missions as $key => $mission){echo strtoupper($mission);} ?></a></td>
									<td><?php echo strtoupper($file->pages); ?></td>
                                    <td><?php echo $wam->act->makeBoldDeadline($file->deadline); ?></td>
                                    <td><?php echo date('d M Y h:i A', $file->date); ?></td>
									<td>
										<?php
										if($file->viewed){
											if($file->viewed == 1){
												?>
												<a href="#" message-present data-type="success" data-message="<?php echo $file->message ?>" ><i class="fa fa-check text-success"></i></a>
												<?php
											}elseif($file->viewed == 2){
												?>
												<a href="#" message-present data-type="error" data-message="<?php echo $file->message ?>" ><i class="fa fa-close text-danger"></i></a>
												<?php
											}
										}else{
											?>
											<i class="fa fa-circle"></i>
											<?php
										}
										?>
									</td>
                                    <td><?php echo ($file->received) ? date('d M Y h:i A', $file->received) : ''; ?></td>
									<td>
										<button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="TRANSLATED_FILES" actionItem="task-edit/<?php echo $file->id; ?>" data-toggle="tooltip" title="Edit Task" ><i class="ti-pencil-alt"></i></button>
                                        <?php
                                        if ($wam->dbm->check('project_items_missions_files', ['eq' => ['mission' => $file->id]])) {
                                            ?>
                                            <div class="btn-group" style="position: absolute;" >
                                                <button aria-expanded="false" style="z-index: 99999999;" data-toggle="dropdown" class="btn btn-info btn-outline btn-circle dropdown-toggle waves-effect waves-light" type="button">
                                                    <i class="fa fa-list"></i>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <?php
                                                    $items = $wam->dbm->getData('project_items_missions_files A', [
                                                        'A.id',
                                                    ], [
                                                        'li' => ['A.mission' => $file->id],
                                                        'order' => ['A.id'],
                                                    ]);
                                                    $i = 1;
                                                    foreach ($items as $key => $subItem) {
                                                        ?>
                                                        <li><a href="#" data-download-file="<?php echo $subItem->id; ?>" data-type="multiple">File <?php echo $i; ?></a></li>
                                                        <?php
                                                        ++$i;
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info btn-outline btn-circle dropdown-toggle waves-effect waves-light" type="button">
                                                <i class="fa fa-list"></i>
                                            </button>
                                            <?php
                                        }else{
                                            ?>
                                            <button type="button" class="btn btn-info btn-outline btn-circle m-r-5" data-download-file="<?php echo $file->id; ?>" data-type="<?php echo $file->mission; ?>" data-toggle="tooltip" title="Download File" ><i class="fa fa-download"></i></button>
                                            <?php
                                        }
                                        if($file->mission_file){
                                            ?>
                                            <button type="button" class="btn btn-success btn-outline btn-circle m-r-5" data-download-file="<?php echo $file->mission_file; ?>" data-type="translated" data-toggle="tooltip" title="Download Worked File" ><i class="fa fa-download"></i></button>
                                            <?php
                                        }else{
                                            ?>
                                            <button type="button" class="btn btn-danger btn-outline btn-circle m-r-5 disabled" disabled="" data-toggle="tooltip" title="Download Worked File" ><i class="fa fa-download"></i></button>
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
	<div class="modal-footer">
		<button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</form>