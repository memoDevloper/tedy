<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Edit File</h4> </div>
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
		<div class="col-xs-12">
			<div class="white-box">
				<form class="form-horizontal form-material form" autocomplete="off">
					<input type="hidden" name="actionName" value="EDIT_FILE">
					<input type="hidden" name="id" value="<?php echo $file->id ?>">
					<div class="form-group" >
						<label class="col-md-12" for="deadline">Client</label>
						<div class="col-md-12">
							<select class="select2 form-control custom-select" name="client" style="width: 100%; height:36px;">
								<?php
								$clients = $wam->dbm->getData('clients', [
									'id',
									'name',
									'lastname'
								]);
								foreach ($clients as $key => $client) {
									?>
									<option value="<?php echo $client->id ?>" <?php echo ($client->id == $file->client) ? 'selected' : ''; ?> ><?php echo $client->id ?> - <?php echo $client->name ?> <?php echo $client->lastname; ?></option>
									<?php
								}
								?>
							</select>
                        </div>
					</div>
					<div class="form-group" >
						<label class="col-md-12" for="deadline">Deadline</label>
						<div class="col-md-12">
							<div class="input-group">
								<input type="text" name="deadline" class="form-control input-daterange-timepicker" value="<?php echo date('Y-m-d h:I A', $file->deadline); ?>" />
								<span class="input-group-addon"><i class="icon-calender"></i></span>
							</div>
						</div>
	                </div>
					<div class="form-group">
						<label class="col-sm-12" for="direction">Target Language</label>
						<div class="col-sm-12">
							<select class="form-control form-control-line direction" id="direction" name="direction">
								<option value="ar" <?php echo ($file->direction == 'ar') ? 'selected' : ''; ?> >AR</option>
								<option value="en" <?php echo ($file->direction == 'en') ? 'selected' : ''; ?> >EN</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12" for="pages">Files</label>
						<div class="col-md-12">
							<input type="number" required name="pages" class="form-control form-control-line pages" id="pages" placeholder="Files" value="<?php echo $file->pages; ?>" >
						</div>
					</div>
					<div class="row">
						<label class="col-md-12" for="pages">Translators</label>
						<div class="col-md-6">
							<label class="col-md-12" for="pages">Regular</label>
							<table class="table table-hover manage-u-table">
								<tbody>
									<?php
									$translators = explode('[//]', $file->translators);
									$regular_translators = $wam->dbm->getData(['users A', 'employees_regular B'], [
										'A.id',
										'A.name',
										'A.lastname',
										'A.avatar',
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
													<div class="custom-control custom-checkbox">
														<input type="checkbox" name="translators[]" value="<?php echo $translator->id ?>" class="custom-control-input" id="user_<?php echo $translator->id ?>" <?php echo (in_array("[$translator->id]", $translators)) ? 'checked' : ''; ?>>
													</div>
												</div>
											</td>
											<td width="60px" class="text-center" >
												<label for="user_<?php echo $translator->id ?>" >
													<img src="/files/avatars/<?php echo $translator->avatar ?>" class="img-circle" height="50px" width="50">
												</label>
											</td>
											<td><label for="user_<?php echo $translator->id ?>" ><?php echo $translator->name ?> <?php echo $translator->lastname ?></label></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-success">EDIT</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>