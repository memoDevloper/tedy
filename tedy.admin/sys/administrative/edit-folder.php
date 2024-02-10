<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <h4 class="pull-left" >Edit Folder</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <?php
    $folder = $wam->dbm->getData('administrative_categories', '*', ['eq' => ['id' => $dir5]]);
    $folder = $folder[0];
    ?>
    <input type="hidden" name="actionName" value="ADMINISTRATIVE_EDIT_FOLDER" />
    <input type="hidden" name="id" value="<?php echo $folder->id ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-xs-12" >
                <div class="form-group">
                    <label class="col-md-12" for="name">Folder Name</label>
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control form-control-line name" id="name" placeholder="Folder Name" value="<?php echo $folder->name; ?>" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" >
                <div class="form-group">
                    <label class="col-md-12" for="code">Folder Code</label>
                    <div class="col-md-12">
                        <input type="text" name="code" class="form-control form-control-line name" id="code" placeholder="Folder Code" value="<?php echo $folder->code; ?>" >
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