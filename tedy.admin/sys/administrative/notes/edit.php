<?php
$note = $wam->dbm->getData('notes', '*', ['eq' => ['id' => $dir5]]);
$note = $note[0];
?>
<form class="form-horizontal form-material form" >
    <div class="modal-header">
        <div class="row" >
            <div class="col-xs-12" >
                <h4 class="pull-left" >Edit Note</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
        </div>
    </div>
    <div class="modal-body" >
        <div class="row" >
            <input type="hidden" name="actionName" value="NOTE_EDIT" />
            <input type="hidden" name="id" value="<?php echo $note->id ?>" />
            <div class="col-xs-12" >
                <div class="form-group" >
                    <label class="col-md-12" for="note">Note</label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <textarea name="note" class="form-control note" id="note" placeholder="Note"><?php echo $note->note; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer" >
        <button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="ADMINISTRATIVE_FILES" actionItem="notes/<?php echo $note->item; ?>" >Cancel</button>
        <button type="submit" class="btn btn-success waves-effect waves-light">Edit</button>
    </div>
</form>