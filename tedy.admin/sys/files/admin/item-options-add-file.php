<?php
$item = $wam->dbm->getData('project_items', 'id, name', ['eq' => ['name' => $dir5]]);
$item = $item[0];
?>
<form class="form-horizontal form-material form" >
	<div class="modal-header">
		<div class="row" >
			<div class="col-xs-12" >
				<h4 class="pull-left" >Add File For: <?php echo $item->name ?></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
		</div>
	</div>
	<div class="modal-body" >
		<div class="row" >
			<input type="hidden" name="actionName" value="FILE_ITEM_OPTIONS_ADD_FILE" />
			<input type="hidden" name="id" value="<?php echo $item->id; ?>" />
			<input type="hidden" name="mission" value="FINAL" />
			<div class="col-xs-12" >
				<div class="form-group" >
					<label class="col-md-12" for="file">File</label>
					<div class="col-md-12">
						<div class="input-group">
							<input type="file" name="file" class="form-control file" id="file" placeholder="File">
							<span class="input-group-addon"><i class="fa fa-file"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12" >
				<div class="form-group" >
					<label class="col-sm-12" for="mission">Select Task</label>
					<div class="col-sm-12">
						<select class="form-control form-control-line mission" id="mission" name="mission">
                            <option value="TRNS" >Translate</option>
							<option value="COMPILE" >Compile</option>
							<option value="REVIEW" >Review</option>
							<option value="EDIT" >Edit</option>
							<option value="FINAL" >Final</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-xs-12" >
				<div class="form-group">
					<label class="col-md-12" for="pages">Pages</label>
					<div class="col-md-12">
						<input type="text" name="pages" class="form-control form-control-line pages" id="pages" placeholder="Pages" >
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer" >
		<button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open/<?php echo $item->name; ?>" >Cancel</button>
		<button type="submit" class="btn btn-success waves-effect waves-light">Add</button>
	</div>
</form>