<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Jobs</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button class="btn btn-info pull-right m-l-20 waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="done-tasks" type="button" ><span>Done Tasks</span></button>
			<a href="/files/new" class="btn btn-danger pull-right m-l-20 waves-effect waves-light CPB">New Job</a>
			<ol class="breadcrumb">
				<li class="active">Jobs</li>
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
								<th>YEAR</th>
								<th>JOBS</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$years = $wam->dbm->getData('files A', [
								'A.id',
								'A.name',
							], [
								'eq' => ['type' => 'year', 'main' => 0],
								'order' => ['A.name'],
							]);
							foreach ($years as $key => $file) {
								$files = $wam->dbm->rows('projects', ['eq' => ['year' => $file->name], 'not' => ['status' => 1]]);
								?>
								<tr>
									<td><a href="/files/<?php echo $file->name; ?>" class="CPB" ><?php echo $file->name ?></a></td>
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
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <?php
                $jobs = $wam->dbm->rows('projects A', [
                    'eq' => ['A.accountant_acceptance' => 0, ],
                    'not' => ['A.status' => 1],
                    'li' => ['A.translators' => "[$user->id]"],
                    'order' => ['A.deadline, A.name'],
                ]);
                ?>
                <div class="panel-heading">JOBS (<?php echo $jobs; ?>)</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>CODE</th>
                            <th>CLIENT</th>
                            <th>STATUS</th>
                            <th>PRIORITY</th>
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
                            'A.direction',
                            'A.status',
                            'A.pages',
                            'A.name',
                            'A.progress_ratio',
                            'A.priority',
                            'A.accountant_acceptance',
                        ], [
                            'eq' => ['A.accountant_acceptance' => 0, ],
                            'not' => ['A.status' => 1],
                            'li' => ['A.translators' => "[$user->id]"],
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
                                    <button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="PROJECTS" actionItem="options/<?php echo $file->id; ?>" data-toggle="tooltip" title="File Options" ><i class="fa fa-gear"></i></button>
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
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <?php
                $tasks = $wam->dbm->rowsQuery("SELECT 
                                                      A.id
                                                  FROM project_items_missions A
                                                  LEFT OUTER JOIN project_items_translated B
                                                  ON A.id = B.mission_file
                                                  WHERE B.id IS NULL AND A.translator = $user->id AND A.viewed != 2");
                ?>
                <div class="panel-heading">TASKS (<?php echo $tasks ?>)</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>CODE</th>
                            <th width="200" >TITLE</th>
                            <th>JOB MANAGER</th>
                            <th>TARGET</th>
                            <th>ACTION</th>
                            <th>PAGES</th>
                            <th>TYPE</th>
                            <th>DEADLINE</th>
                            <th width="120">Accept / Deny</th>
                            <th width="100">MANAGE</th>
                            <th>Source</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $files = $wam->dbm->query("SELECT 
                                                            A.id,
                                                            A.item as name,
                                                            A.mission,
                                                            A.missions,
                                                            A.direction,
                                                            A.extension,
                                                            A.deadline,
                                                            A.viewed,
                                                            A.message,
                                                            A.notes,
                                                            A.pages,
                                                            (SELECT translators FROM projects WHERE id = A.project) as job_managers
                                                      FROM project_items_missions A
                                                      LEFT OUTER JOIN project_items_translated B
                                                      ON A.id = B.mission_file
                                                      WHERE B.id IS NULL AND A.translator = $user->id AND A.viewed != 2
                                                      ORDER BY A.deadline");
                        foreach ($files as $key => $file) {
                                unset($job_managersIDS);
                                $job_managers = explode('[//]', $file->job_managers);
                                foreach ($job_managers as $key => $job_manager){
                                    $job_managersIDS[] = str_ireplace(['[', ']'], ['', ''], $job_manager);
                                }
                                $job_managers = $wam->dbm->getData('users', 'name, lastname', ['eq' => ['id' => $job_managersIDS]]);
                                $missions = explode('[//]', $file->missions);
                                $name_explode = explode('-', $file->name);
                                $name_parts = explode('-', $file->name);
                                $oName = "$name_parts[0]-$name_parts[1]-$name_parts[2]-$name_parts[3]";
                                $oName = $wam->dbm->getData('project_items', 'original_name as name', ['eq' => ['name' => $oName]]);
                                $oName = $oName[0]->name;
                                ?>
                                <tr class="item">
                                    <td>
                                        <?php
                                        $name_parts = explode('-', $file->name);
                                        $name = $name_parts[0];
                                        $name .= "-";
                                        $name .= substr($name_parts[1], 0, 4);
                                        $dayname = substr($name_parts[1], 4, 5);
                                        $name .= substr_replace($name_parts[1], "<span style='color: red' >$dayname", 0);
                                        $name .= "-$name_parts[2]</span><span style='color: green;' >-$name_parts[3]</span>";
                                        echo "<b>" . $name . "</b>";
                                        ?>
                                        <a href="#"
                                           data-file="<?php echo "$name_parts[0]-$name_parts[1]-$name_parts[2]-$name_parts[3]"; ?>"
                                           data-toggle="tooltip" title="Copy File Code to Clipboard"><i
                                                    class="fa fa-clipboard"></i></a>
                                    </td>
                                    <td><?php echo $oName; ?></td>
                                    <td>
                                        <?php
                                        foreach ($job_managers as $key => $job_manager){
                                            echo "$job_manager->name $job_manager->lastname<br />";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo strtoupper($file->direction); ?></td>
                                    <td><a href="#" message-present data-type="success" data-message="<?php echo $file->notes; ?>"><?php foreach($missions as $key => $mission){echo strtoupper($mission);} ?></a></td>
                                    <td><?php echo $file->pages ?></td>
                                    <td><?php echo strtoupper($file->extension); ?></td>
                                    <td><?php echo $wam->act->makeBoldDeadline($file->deadline); ?></td>
                                    <td style="text-align: center;">
                                        <?php
                                        if (!$file->viewed) {
                                            ?>
                                            <button type="button"
                                                    class="btn btn-success btn-outline btn-circle m-r-5"
                                                    data-toggle="modal" data-target=".accept-deny-modal" accept-deny
                                                    data-id="<?php echo $file->id; ?>" data-value="1"
                                                    data-title="Accept"><i class="fa fa-check"></i></button>
                                            <button type="button"
                                                    class="btn btn-danger btn-outline btn-circle m-r-5"
                                                    data-toggle="modal" data-target=".accept-deny-modal" accept-deny
                                                    data-id="<?php echo $file->id; ?>" data-value="2"
                                                    data-title="Deny"><i class="fa fa-close"></i></button>
                                            <?php
                                        } else {
                                            if ($file->viewed == 1) {
                                                ?>
                                                <a href="#" message-present data-type="success"
                                                   data-message="<?php echo $file->message ?>"><i
                                                            class="fa fa-check text-success"></i></a>
                                                <?php
                                            } elseif ($file->viewed == 2) {
                                                ?>
                                                <a href="#" message-present data-type="error"
                                                   data-message="<?php echo $file->message ?>"><i
                                                            class="fa fa-close text-danger"></i></a>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($wam->dbm->check('project_items_missions_files', ['eq' => ['mission' => $file->id]])) {
                                            ?>
                                            <button type="button"
                                                    class="btn btn-info btn-outline btn-circle m-r-5 DIM"
                                                    actionName="TRANSLATED_FILES"
                                                    actionItem="multiple-task-files/<?php echo $file->id; ?>"
                                                    data-toggle="tooltip" title="Files List"><i
                                                        class="fa fa-list"></i></button>
                                            <?php
                                        } else {
                                            ?>
                                            <button type="button" class="btn btn-info btn-outline btn-circle m-r-5"
                                                    data-download-file="<?php echo $file->id; ?>"
                                                    data-type="<?php echo strtoupper($file->mission); ?>"
                                                    data-toggle="tooltip" title="Download File"><i
                                                        class="fa fa-download"></i></button>
                                            <?php
                                        }
                                        ?>
                                        <button type="button" class="btn btn-danger btn-outline btn-circle m-r-5"
                                                data-toggle="tooltip" title="Upload File"
                                                data-file-upload="<?php echo $file->name; ?>-<?php echo $file->mission ?>-<?php echo $file->id ?>">
                                            <i class="fa fa-upload"></i></button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5" data-download-item="<?php echo "$name_explode[0]-$name_explode[1]-$name_explode[2]-$name_explode[3]"; ?>" data-toggle="tooltip" title="Download File" ><i class="fa fa-download"></i></button>
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
<div><?php echo mysql_error(); ?></div>
<div class="modal accept-deny-modal fade in" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="form" >
                <input type="hidden" name="actionName" value="ACCEPT_DENY_FILE" />
                <input type="hidden" name="id" id="acceptDenyId" value="" />
                <input type="hidden" name="viewed" id="acceptDenyView" value="" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="acceptDenyTitle"></h4>
                </div>
                <div class="modal-body">
                    <div class="row" >
                        <div class="col-xs-12" >
                            <div class="form-group">
                                <label class="col-md-12" for="message">Message</label>
                                <div class="col-md-12">
                                    <textarea required name="message" class="form-control form-control-line message" id="message" placeholder="Message" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>