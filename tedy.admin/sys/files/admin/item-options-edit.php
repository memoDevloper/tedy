<?php
$item = $wam->dbm->getData('project_items_missions', ['id', 'item', 'deadline', 'translator', 'pages', 'mission', 'missions', 'notes', 'status', 'viewed', 'message'], ['eq' => ['id' => $dir5]]);
$item = $item[0];
$item_name = explode('-', $item->item);
$item_name = "$item_name[0]-$item_name[1]-$item_name[2]-$item_name[3]";
?>
<form class="form-horizontal form-material form" >
	<div class="modal-header">
		<div class="row" >
			<div class="col-xs-12" >
				<h4 class="pull-left" >Edit File: <?php echo $item->item ?></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div class="row" >
			<input type="hidden" name="actionName" value="FILE_ITEM_OPTIONS_EDIT" />
			<input type="hidden" name="id" value="<?php echo $item->id; ?>" />
			<div class="col-md-6" >
                <?php
                $missions = explode('[//]', $item->missions);
                ?>
                <div class="form-group m-l-10" >
                    <input type="checkbox" class="js-switch" name="mission[]" value="TRNS" id="mission_trns" <?php echo (in_array('TRNS', $missions)) ? 'checked' : ''; ?> />
                    <label for="mission_compile" >Translae</label>
                </div>
                <div class="form-group m-l-10" >
                    <input type="checkbox" class="js-switch" name="mission[]" value="COMPILE" id="mission_compile" <?php echo (in_array('COMPILE', $missions)) ? 'checked' : ''; ?> />
                    <label for="mission_compile" >Compile</label>
                </div>
                <div class="form-group m-l-10" >
                    <input type="checkbox" class="js-switch" name="mission[]" value="REVIEW" id="mission_review" <?php echo (in_array('REVIEW', $missions)) ? 'checked' : ''; ?> />
                    <label for="mission_review" >Review</label>
                </div>
                <div class="form-group m-l-10" >
                    <input type="checkbox" class="js-switch" name="mission[]" value="EDIT" id="mission_edit" <?php echo (in_array('EDIT', $missions)) ? 'checked' : ''; ?> />
                    <label for="mission_edit" >Edit</label>
                </div>
				<div class="form-group" >
					<label class="col-md-12" for="deadline">Deadline</label>
					<div class="col-md-12">
						<div class="input-group">
							<input type="text" name="deadline" class="form-control input-daterange-timepicker" data-mindate="<?php echo date('Y-m-d H:I A', $time); ?>" value="<?php echo date('Y-m-d H:I A', $item->deadline); ?>" />
							<span class="input-group-addon"><i class="icon-calender"></i></span>
						</div>
					</div>
		        </div>
				<div class="form-group">
					<label class="col-md-12" for="pages">Pages</label>
					<div class="col-md-12">
						<input type="text" name="pages" class="form-control form-control-line pages" id="pages" placeholder="Pages" value="<?php echo $item->pages ?>" >
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-12" for="status">Upload Translated File Availability</label>
					<div class="col-sm-12">
						<select class="form-control form-control-line status" id="status" name="status">
							<option value="1" <?php echo ($item->status == 1) ? 'selected' : ''; ?> >Available</option>
							<option value="0" <?php echo ($item->status == 0) ? 'selected' : ''; ?> >Unavailable</option>
						</select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-12" for="viewed">Acceptance Status</label>
					<div class="col-sm-12">
						<select class="form-control form-control-line viewed" id="viewed" name="viewed">
							<option value="0" <?php echo ($item->viewed == 0) ? 'selected' : ''; ?> >Reset</option>
							<?php
							if($item->viewed == 1){
								?>
								<option value="1" <?php echo ($item->viewed == 1) ? 'selected' : ''; ?> >Accepted</option>
								<?php
							}elseif($item->viewed == 2){
								?>
								<option value="2" <?php echo ($item->viewed == 2) ? 'selected' : ''; ?> >Denied</option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-md-12" for="notes">Note</label>
					<div class="col-md-12">
						<textarea rows="3" cols="30" style="resize: none;" name="notes" id="notes" class="notes" ><?php echo $item->notes; ?></textarea>
					</div>
		        </div>
			</div>
			<div class="col-md-6" >
				<div class="form-group" >
					<label class="col-md-12" for="pages">Select Translators</label>
				</div>
				<div class="row" >
					<div class="col-md-12">
						<label class="col-md-12" for="pages">Regular</label>
						<table class="table table-hover manage-u-table" width="100%" >
							<tbody>
								<?php
								$regular_translators = $wam->dbm->getData(['users A', 'employees_regular B'], [
									'A.id',
									'A.name',
									'A.lastname',
									'A.avatar',
									'A.gender',
								], [
									'join' => [
										'type' => 'right',
										'on' => ['A.id', 'B.user']
									],
									'order' => ['A.name, A.lastname']
								]);
								foreach ($regular_translators as $key => $translator) {
									$MRS  = ($translator->gender == 1) ? 'Mr.' : 'Ms.';
									?>
									<tr>
										<td>
											<div class="radio radio-danger">
												<input type="radio" name="translator" value="<?php echo $translator->id ?>" class="custom-control-input" data-translator-checkbox="message_<?php echo $translator->id; ?>" <?php echo ($translator->id == $item->translator) ? 'checked' : ''; ?> id="user_<?php echo $translator->id ?>">
												<label for="user_<?php echo $translator->id ?>" ><?php echo $translator->name ?> <?php echo $translator->lastname ?></label>
											</div>
										</td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<label class="col-md-12" for="pages">Freelance</label>
						<table class="table table-hover manage-u-table" width="100%" >
							<tbody>
								<?php
								$regular_translators = $wam->dbm->getData(['users A', 'employees_freelance B'], [
									'A.id',
									'A.name',
									'A.lastname',
									'A.avatar',
									'A.gender',
								], [
									'join' => [
										'type' => 'right',
										'on' => ['A.id', 'B.user']
									],
									'order' => ['A.name, A.lastname']
								]);
								foreach ($regular_translators as $key => $translator) {
									?>
									<tr>
										<td>
											<div class="radio radio-danger">
												<input type="radio" name="translator" value="<?php echo $translator->id ?>" class="custom-control-input" data-translator-checkbox="message_<?php echo $translator->id; ?>" <?php echo ($translator->id == $item->translator) ? 'checked' : ''; ?> id="user_<?php echo $translator->id ?>">
												<label for="user_<?php echo $translator->id ?>" ><?php echo $translator->name ?> <?php echo $translator->lastname ?></label>
											</div>
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
	<div class="modal-footer">
		<button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open/<?php echo $item_name; ?>" >Cancel</button>
		<button type="submit" class="btn btn-success waves-effect waves-light">Edit</button>
	</div>
</form>