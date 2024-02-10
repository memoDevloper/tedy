<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Edit Job</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="/files" class="CPB backButton" >Jobs</a></li>
				<li><a href="/files/<?php echo $file->year; ?>" class="CPB backButton" ><?php echo $file->year; ?></a></li>
				<li><a href="/files/<?php echo $file->year; ?>/<?php echo $months_short[$file->month]; ?>" class="CPB backButton" ><?php echo $months_short[$file->month]; ?></a></li>
				<li><a href="/files/<?php echo $file->year; ?>/<?php echo $months_short[$file->month]; ?>/<?php echo sprintf("%02d", $file->day); ?>" class="CPB backButton" ><?php echo sprintf("%02d", $file->day); ?></a></li>
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
								<input type="text" name="deadline" class="form-control input-daterange-timepicker" value="<?php echo date('Y-m-d H:I A', $file->deadline); ?>" />
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
							<input type="number" required name="pages" min="1" class="form-control form-control-line pages" id="pages" placeholder="Files" value="<?php echo $file->pages; ?>" >
						</div>
					</div>
                    <div class="form-group">
                        <label class="col-sm-12" for="priority">Priority</label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line priority" id="priority" name="priority">
                                <option value="" <?php echo ($file->priority == "") ? 'selected' : ''; ?>>None</option>
                                <option value="high" <?php echo ($file->priority == "high") ? 'selected' : ''; ?> >High</option>
                                <option value="low" <?php echo ($file->priority == "low") ? 'selected' : ''; ?> >Low</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="quotation" value="1" class="custom-control-input job_quotation quotation" <?php echo ($file->quotation) ? 'checked' : ''; ?> id="quotation">
                                    <label for="quotation" >Quotation</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group <?php echo (!$file->quotation) ? 'hidden' : ''; ?> hidden_job_quotation_ls">
                        <div class="col-sm-12">
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="ls" value="1" class="custom-control-input job_quotation_ls ls" <?php echo ($file->is_quotation_ls) ? 'checked' : ''; ?> id="ls">
                                    <label for="ls" >Quotation LS</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group <?php echo ($file->quotation && $file->is_quotation_ls) ? '' : 'hidden'; ?> hidden_quotation_ls">
                        <label class="col-md-12" for="quotation_ls">Quotation LS</label>
                        <div class="col-md-12">
                            <input type="text" name="quotation_ls" class="form-control form-control-line quotation_ls" id="quotation_ls" placeholder="Quotation LS" value="<?php echo $file->quotation_ls ?>" >
                        </div>
                    </div>
                    <div class="form-group <?php echo ($file->quotation && !$file->is_quotation_ls) ? '' : 'hidden'; ?> hidden_quotation_quantity">
                        <label class="col-md-12" for="quotation_quantity">Quotation Quantity</label>
                        <div class="col-md-12">
                            <input type="number" name="quotation_quantity" class="form-control form-control-line quotation_quantity" id="quotation_quantity" placeholder="Quotation Quantity" value="<?php echo $file->quotation_quantity ?>" >
                        </div>
                    </div>
                    <div class="form-group <?php echo ($file->quotation && !$file->is_quotation_ls) ? '' : 'hidden'; ?> hidden_quotation_unit_price">
                        <label class="col-md-12" for="quotation_unit_price">Quotation Unit Price</label>
                        <div class="col-md-12">
                            <input type="text" name="quotation_unit_price" class="form-control form-control-line quotation_unit_price" id="quotation_unit_price" placeholder="Quotation Unit Price" value="<?php echo $file->quotation_unit_price ?>" >
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
									$regular_translators = $wam->dbm->getData('users A', [
										'A.id',
										'A.name',
										'A.lastname',
										'A.avatar',
									], [
                                        'eq' => ['A.type' => [1, 2]],
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