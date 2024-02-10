<form class="form-horizontal form-material form" >
    <div class="modal-header">
        <div class="row" >
            <div class="col-xs-12" >
                <h4 class="pull-left" >Add Note</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
        </div>
    </div>
    <div class="modal-body" >
        <div class="row" >
            <input type="hidden" name="actionName" value="NOTE_ADD" />
            <input type="hidden" name="section" value="files" />
            <input type="hidden" name="item" value="<?php echo $dir5 ?>" />
            <input type="hidden" name="mission" value="FINAL" />
            <div class="col-xs-12" >
                <div class="form-group" >
                    <label class="col-md-12" for="note">Note</label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <textarea name="note" class="form-control note" id="note" placeholder="Note"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer" >
        <button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="notes-files/<?php echo $dir5; ?>" >Cancel</button>
        <button type="submit" class="btn btn-success waves-effect waves-light">Add</button>
    </div>
</form>