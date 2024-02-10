<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <h4 class="pull-left" >New File</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="ADMINISTRATIVE_NEW_FILE" />
    <input type="hidden" name="section" value="<?php echo $dir5; ?>" />
    <input type="hidden" name="category" value="<?php echo $dir6; ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-xs-12" >
                <div class="form-group">
                    <label class="col-md-12" for="name">File Name</label>
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control form-control-line name" id="name" placeholder="File Name" >
                    </div>
                </div>
            </div>
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
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
        <button type="submit" class="btn btn-success waves-effect waves-light">Add</button>
    </div>
</form>