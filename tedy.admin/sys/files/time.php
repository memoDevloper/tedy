<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">New File</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="/files" class="CPB backButton" >Files</a></li>
				<li class="active">New File</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="white-box">
				<form class="form-horizontal form-material form" autocomplete="off">
					<input type="hidden" name="actionName" value="TIME_TEST">
					<div class="form-group" >
						<label class="col-md-12" for="deadline">Deadline</label>
						<div class="col-md-12">
							<div class="input-group">
								<input type="text" name="deadline" class="form-control input-daterange-timepicker" value="<?php echo date('d/m/Y h:I A', $time); ?>" data-maxdate="01-03-2019 03:40" />
								<span class="input-group-addon"><i class="icon-calender"></i></span>
							</div>
						</div>
	                </div>
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-success">ADD</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>