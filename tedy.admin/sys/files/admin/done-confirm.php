<?php
if($file = $wam->dbm->getData('projects', 'id, name, status', ['eq' => ['id' => $dir5]])) {
    $file = $file[0];
    ?>
    <form class="form">
        <input type="hidden" name="actionName" value="PROJECT_DONE_CONFIRMATION">
        <input type="hidden" name="project" value="<?php echo $dir5; ?>">
        <div class="modal-header">
            <div class="row">
                <div class="col-xs-12">
                    <h4 class="pull-left">Confirm Project: <?php echo $file->name ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success" >Confirm</button>
                    <button type="button" class="btn btn-danger DIM" actionName="PROJECTS" actionItem="options/<?php echo $file->id; ?>" >Cancel</button>
                </div>
            </div>
        </div>
    </form>
    <?php
}
?>