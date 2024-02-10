<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <h4 class="pull-left" >New Folder</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="ADMINISTRATIVE_NEW_FOLDER" />
    <?php
    if($dir6 != 0){
        $currentFolder = $dir6;
        $subFolder = $wam->dbm->getData('administrative_categories', '*', ['eq' => ['id' => $currentFolder]]);
        $subFolder = $subFolder[0];
        $folderCode = $subFolder->code . "-";
        ?>
        <li><?php echo $folder->name ?></li>
        <?php
    }
    ?>
    <pre><?php print_r($subFolders); ?></pre>
    <input type="hidden" name="section" value="<?php echo $dir5; ?>" />
    <input type="hidden" name="folder" value="<?php echo $dir6; ?>" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-xs-12" >
                <div class="form-group">
                    <label class="col-md-12" for="name">Folder Name</label>
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control form-control-line name" id="name" placeholder="Folder Name" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" >
                <div class="form-group">
                    <label class="col-md-12" for="code">Folder Code</label>
                    <div class="col-md-12">
                        <input type="text" name="code" class="form-control form-control-line name" id="code" placeholder="Folder Code" value="<?php echo $folderCode; ?>" >
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