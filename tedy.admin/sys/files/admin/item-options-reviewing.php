<?php
$item = $wam->dbm->getData('project_items', 'id, translate_file, deadline, name', ['eq' => ['name' => $dir5]]);
$item = $item[0];
?>
<form class="form-horizontal form-material form" >
	<input type="hidden" name="actionName" value="FILE_ITEM_OPTIONS_SEND_AS_TASK" />
	<div class="modal-header">
		<div class="row" >
			<div class="col-xs-12" >
                <div class="col-md-6" >
                    <h4 class="pull-left" >File Options: <?php echo $dir5 ?></h4>
                </div>
                <div class="col-md-4" >
                    <h4 class="text-danger" >Deadline: <?php echo date('d M Y h:i A', $item->deadline); ?></h4>
                </div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
		</div>
		<div class="row" >
			<div class="col-xs-12" >
				<button type="button" class="btn btn-danger btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open/<?php echo $item->name; ?>">Assigned</button>
				<button type="button" class="btn btn-danger btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open-translating/<?php echo $item->name; ?>">Translated</button>
				<button type="button" class="btn btn-danger btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open-compiling/<?php echo $item->name; ?>">Compiled</button>
				<button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open-reviewing/<?php echo $item->name; ?>">Reviewed</button>
				<button type="button" class="btn btn-danger btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open-editing/<?php echo $item->name; ?>">Edited</button>
				<button type="button" class="btn btn-danger btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open-final/<?php echo $item->name; ?>">Final</button>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div class="row" >
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-hover manage-u-table" >
						<thead>
							<tr>
                                <th width="220px" >CODE</th>
                                <th width="150px" >Translator</th>
                                <th>Task</th>
                                <th>Part</th>
                                <th>Deadline</th>
                                <th>Sent</th>
                                <th>Received</th>
                                <th width="5%" >Viewed</th>
                                <th>MANAGE</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$files = $wam->dbm->getData(['project_items_missions A', 'project_items_translated B'], [
								'A.id',
								'A.project',
                                'A.date as sent',
                                'A.deadline',
								'A.translator',
								"A.direction",
								"(SELECT name FROM users WHERE id = A.translator) as translator_name",
								"(SELECT lastname FROM users WHERE id = A.translator) as translator_lastname",
								'A.item as name',
								'A.extension',
								'A.viewed',
								'A.mission',
                                'A.missions',
                                'A.notes',
								'A.message',
                                'A.pages',
								"B.id as mission_file",
                                'B.date as received',
							], [
								'join' => [
									'type' => 'right',
									'on' => ['A.id', 'B.mission_file']
								],
                                'eq' => ['B.mission' => 'REVIEW'],
								'li' => ['A.item' => $dir5, 'A.mission' => 'review'],
								'order' => ['A.deadline, A.item'],
							]);
							foreach ($files as $key => $file) {
								?>
								<tr class="item" >
									<td>
										<div class="checkbox checkbox-success">
											<input id="relied_<?php echo $file->id; ?>" name="files[]" value="<?php echo $file->id; ?>" type="checkbox">
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
                                            <label for="relied_<?php echo $file->id; ?>" ><?php echo "<b>" . $name . "</b>"; ?></label>
											<a  data-file="<?php echo $file->name; ?>-<?php echo $file->mission ?>" data-toggle="tooltip" title="Copy file code to Clipboard" ><i class="fa fa-clipboard"></i></a>
										</div>
									</td>
									<td><?php echo "$file->translator_name $file->translator_lastname"; ?></td>
                                    <td>
                                        <a href="#" message-present data-type="success" data-message="<?php echo $file->notes; ?>">
                                            <?php echo strtoupper(str_replace('[//]', '<br/>', $file->missions)); ?>
                                        </a>
                                    </td>
                                    <td><?php echo $file->pages; ?></td>
                                    <td><span class="text-info" ><?php echo date('d M Y h:i A', $file->deadline); ?></span></td>
                                    <td><?php echo date('d M Y h:i A', $file->sent); ?></td>
                                    <td><?php echo date('d M Y h:i A', $file->received); ?></td>
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
										<button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="MISSION_DELETE" data-item-id="<?php echo $file->id; ?>" data-toggle="tooltip" title="Delete File"><i class="ti-trash"></i></button>
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
		<button type="submit" class="btn btn-success waves-effect waves-light">Send As Task</button>
	</div>
</form>