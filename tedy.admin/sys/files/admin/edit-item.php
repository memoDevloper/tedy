<?php
$item = $wam->dbm->getData('project_items', ['id', 'name', 'deadline', 'pages', 'direction', 'priority'], ['eq' => ['id' => $dir5]]);
$item = $item[0];
$item_name = explode('-', $item->name);
$item_name = "$item_name[0]-$item_name[1]-$item_name[2]-$item_name[3]";
?>
<form class="form-horizontal form-material form" >
	<div class="modal-header">
		<div class="row" >
			<div class="col-xs-12" >
				<h4 class="pull-left" >Edit File: <?php echo $item->name ?></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div class="row" >
			<input type="hidden" name="actionName" value="FILE_ITEM_EDIT" />
			<input type="hidden" name="id" value="<?php echo $item->id; ?>" />
			<div class="col-md-6" >
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
                <div class="form-group">
                    <label class="col-sm-12" for="priority">Priority</label>
                    <div class="col-sm-12">
                        <select class="form-control form-control-line priority" id="priority" name="priority">
                            <option value="" <?php echo ($file->priority == "") ? 'selected' : ''; ?>>None</option>
                            <option value="high" <?php echo ($item->priority == "high") ? 'selected' : ''; ?> >High</option>
                            <option value="low" <?php echo ($item->priority == "low") ? 'selected' : ''; ?> >Low</option>
                        </select>
                    </div>
                </div>
				<div class="form-group">
					<label class="col-sm-12" for="direction">Target Language</label>
					<div class="col-sm-12">
						<select class="form-control form-control-line direction" id="direction" name="direction">
							<option value="ar" <?php echo ($item->direction == 'ar') ? 'selected' : ''; ?> >AR</option>
							<option value="en" <?php echo ($item->direction == 'en') ? 'selected' : ''; ?> >EN</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
		<button type="submit" class="btn btn-success waves-effect waves-light">Edit</button>
	</div>
</form>