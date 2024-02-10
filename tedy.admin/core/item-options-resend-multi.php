<?php
$files = explode('-', $dir5);
$item = $wam->dbm->getData('project_items_translated', 'id, name', ['eq' => ['id' => $files[0]]]);
$item = $item[0];
$item_name = explode('-', $item->name);
$item_name = "$item_name[0]-$item_name[1]-$item_name[2]-$item_name[3]";
?>
<form class="form-horizontal form-material form" >
	<div class="modal-header">
		<div class="row" >
			<div class="col-xs-12" >
				<h4 class="pull-left" >Send Multi Task</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div class="row" >
			<input type="hidden" name="actionName" value="FILE_ITEM_OPTIONS_RESEND" />
			<?php
			foreach ($files as $key => $file) {
				?>
				<input type="hidden" name="files[]" value="<?php echo $file; ?>" />
				<?php
			}
			?>
			<div class="col-md-6" >
				<div class="form-group" >
					<label class="col-sm-12" for="mission">Select Task</label>
					<div class="col-sm-12">
						<select class="form-control form-control-line mission" id="mission" name="mission">
							<option value="compile" >Compile</option>
							<option value="review" >Review</option>
							<option value="check" >Check</option>
							<option value="format" >Format</option>
						</select>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-md-12" for="deadline">Deadline</label>
					<div class="col-md-12">
						<div class="input-group">
							<input type="text" name="deadline" class="form-control input-daterange-timepicker" data-mindate="<?php echo date('Y-m-d h:I A', $time); ?>" />
							<span class="input-group-addon"><i class="icon-calender"></i></span>
						</div>
					</div>
		        </div>
				<div class="form-group">
					<label class="col-md-12" for="pages">Pages</label>
					<div class="col-md-12">
						<input type="text" name="pages" class="form-control form-control-line pages" id="pages" placeholder="Pages" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12" for="message">Message</label>
					<div class="col-md-12">
						<textarea name="message" class="form-control form-control-line message" id="message" placeholder="Message" ></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-6" >
				<div class="form-group" >
					<label class="col-md-12" for="pages">Select Translator</label>
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
										<td width="20px" class="text-center" >
											<div class="form-check form-check-inline">
												<div class="custom-control custom-radio">
													<input type="radio" name="translator" value="<?php echo $translator->id ?>" class="custom-control-input" id="user_<?php echo $translator->id ?>">
												</div>
											</div>
										</td>
										<td width="60px" class="text-center" >
											<label for="user_<?php echo $translator->id ?>" >
												<img src="/files/avatars/<?php echo $translator->avatar ?>" class="img-circle" height="50px" width="50">
											</label>
										</td>
										<td>
											<label for="user_<?php echo $translator->id ?>" ><?php echo $translator->name ?> <?php echo $translator->lastname ?></label>
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
										<td width="20px" class="text-center" >
											<div class="form-check form-check-inline">
												<div class="custom-control custom-radio">
													<input type="radio" name="translator" value="<?php echo $translator->id ?>" class="custom-control-input" id="user_<?php echo $translator->id ?>">
												</div>
											</div>
										</td>
										<td width="60px" class="text-center" >
											<label for="user_<?php echo $translator->id ?>" >
												<img src="/files/avatars/<?php echo $translator->avatar ?>" class="img-circle" height="50px" width="50">
											</label>
										</td>
										<td>
											<label for="user_<?php echo $translator->id ?>" ><?php echo $translator->name ?> <?php echo $translator->lastname ?></label>
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
		<button type="submit" class="btn btn-success waves-effect waves-light">Send</button>
	</div>
</form>