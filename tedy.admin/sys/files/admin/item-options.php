<?php
$item = $wam->dbm->getData('project_items', 'id, translate_file, deadline, visior_confirmation, teamleader_confirmation, is_compiled, is_reviewed, is_edited, is_translated, name', ['eq' => ['name' => $dir5]]);
$item = $item[0];
?>
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
			<button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open/<?php echo $item->name; ?>">Assigned</button>
			<button type="button" class="btn btn-danger btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open-translating/<?php echo $item->name; ?>">Translated</button>
			<button type="button" class="btn btn-danger btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open-compiling/<?php echo $item->name; ?>">Compiled</button>
			<button type="button" class="btn btn-danger btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open-reviewing/<?php echo $item->name; ?>">Reviewed</button>
			<button type="button" class="btn btn-danger btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open-editing/<?php echo $item->name; ?>">Edited</button>
			<button type="button" class="btn btn-danger btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open-final/<?php echo $item->name; ?>">Final</button>
			<div class="pull-right" >
				<button type="button" class="btn btn-success btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="add-file/<?php echo $item->name; ?>"><i class="fa fa-plus" ></i> Add File</button>
				<button type="button" class="btn btn-success btn-outline waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="add-translator/<?php echo $item->name; ?>"><i class="fa fa-plus" ></i> Add Translators</button>
			</div>
		</div>
	</div>
</div>
<form class="form-horizontal form-material form" >
	<div class="modal-body">
		<div class="row" >
			<input type="hidden" name="actionName" value="FILE_ITEM_OPTIONS" />
			<input type="hidden" name="file" value="<?php echo $item->name; ?>" />
			<div class="col-md-9">
				<div class="table-responsive">
					<table class="table table-hover manage-u-table" >
						<thead>
							<tr>
								<th width="20%" >CODE</th>
								<th width="10%" >Translator</th>
								<th width="5%" >Task</th>
								<th width="5%" >Part</th>
								<th width="18%" >Deadline</th>
                                <th width="18%" >Sent</th>
								<th>Viewed</th>
								<th width="300">MANAGE</th>
							</tr>
						</thead>
						<tbody>
							<!--<tr class="item" >
								<td>
									<div class="radio radio-danger">
										<input type="radio" name="relied" id="relied_0" <?php echo ($item->translate_file == 0) ? 'checked' : ''; ?> value="0">
										<label for="relied_0" >No Approved File</label>
									</div>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>-->
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
								'A.item as name',
								'A.extension',
								'A.viewed',
								'A.mission',
                                'A.missions',
                                'A.notes',
								'A.message',
								"(SELECT id FROM project_items_translated WHERE mission_file = A.id Limit 1) as mission_file",
							], [
								'li' => ['A.item' => $dir5],
								'order' => ['A.deadline, A.item'],
							]);
							foreach ($files as $key => $file) {
								if(!$file->mission_file){
									?>
									<tr class="item" >
										<td>
											<!--<div class="radio radio-danger">
												<input type="radio" name="relied" id="relied_<?php echo $file->id; ?>" <?php echo ($item->translate_file == $file->id) ? 'checked' : ''; ?> value="<?php echo $file->id; ?>">
											</div>-->
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
												<label for="xxrelied_<?php echo $file->id; ?>" ><?php echo $name; ?></label>
												<a  data-file="<?php echo $file->name; ?>-<?php echo $file->mission ?>" data-toggle="tooltip" title="Copy file code to Clipboard" ><i class="fa fa-clipboard"></i></a>
										</td>
										<td><?php echo "$file->translator_name $file->translator_lastname"; ?></td>
										<td>
                                            <a href="#" message-present data-type="success" data-message="<?php echo $file->notes; ?>">
                                                <?php echo strtoupper(str_replace('[//]', '<br/>', $file->missions)); ?>
                                            </a>
                                        </td>
										<td><?php echo $file->pages; ?></td>
                                        <td><span class="text-info" ><?php echo date('d M Y h:i A', $file->deadline); ?></span></td>
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
											?>
											<button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="MISSION_DELETE" data-item-id="<?php echo $file->id; ?>" data-toggle="tooltip" title="Delete File"><i class="ti-trash"></i></button>
										</td>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-3" >
				<h4>File Steps:</h4>
				<div class="form-group" >
					<input type="checkbox" class="js-switch" name="teamleader_confirmation" id="teamleader_confirmation" <?php echo ($item->teamleader_confirmation) ? 'checked' : ''; ?> data-color="#f96262" />
					<label for="teamleader_confirmation" >Team Leader Confirmation</label>
				</div>
				<div class="form-group" >
					<input type="checkbox" class="js-switch" name="visior_confirmation" id="visior_confirmation" <?php echo ($item->visior_confirmation) ? 'checked' : ''; ?> data-color="#f96262" />
					<label for="visior_confirmation" >Manager Confirmation</label>
				</div>
                <div class="form-group" >
                    <input type="checkbox" class="js-switch" name="is_translated" id="is_translated" <?php echo ($item->is_translated) ? 'checked' : ''; ?> data-color="#f96262" />
                    <label for="is_translated" >Translated</label>
                </div>
                <div class="form-group" >
                    <input type="checkbox" class="js-switch" name="is_compiled" id="is_compiled" <?php echo ($item->is_compiled) ? 'checked' : ''; ?> data-color="#f96262" />
                    <label for="is_compiled" >Compiled</label>
                </div>
                <div class="form-group" >
                    <input type="checkbox" class="js-switch" name="is_reviewed" id="is_reviewed" <?php echo ($item->is_reviewed) ? 'checked' : ''; ?> data-color="#f96262" />
                    <label for="is_reviewed" >Reviewed</label>
                </div>
				<div class="form-group" >
					<input type="checkbox" class="js-switch" name="is_edited" id="is_edited" <?php echo ($item->is_edited) ? 'checked' : ''; ?> data-color="#f96262" />
					<label for="is_edited" >Edited</label>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
		<button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
	</div>
</form>