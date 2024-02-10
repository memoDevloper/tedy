<form class="form-horizontal form-material form" >
    <div class="modal-header">
        <div class="row" >
            <div class="col-xs-12" >
                <h4 class="pull-left" >Notes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
        </div>
    </div>
    <div class="modal-body" >
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                        <table class="table table-hover manage-u-table">
                            <thead>
                            <tr>
                                <th width="60%" >Note</th>
                                <th width="20%" >Date</th>
                                <th width="10%" >User</th>
                                <th width="10%" >Options</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $notes = $wam->dbm->getData('notes A', [
                                  'A.id',
                                  'A.date',
                                  'A.note',
                                  'A.user',
                                  '(SELECT name FROM users WHERE id = A.user) as user_name',
                                  '(SELECT lastname FROM users WHERE id = A.user) as user_lastname',
                                ], ['eq' => ['section' => 'files', 'item' => $dir5]]);
                                foreach ($notes as $key => $note) {
                                    ?>
                                    <tr class="item" >
                                        <td><?php echo $note->note ?></td>
                                        <td><?php echo date('d-M-Y h:i A', $note->date); ?></td>
                                        <td><?php echo $note->user_name ?> <?php echo $note->user_lastname; ?></td>
                                        <td>
                                            <?php
                                            if($user->id == $note->user) {
                                                ?>
                                                <button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="TRANSLATED_FILES" actionItem="notes-files-edit/<?php echo $note->id; ?>" ><i class="ti-pencil-alt"></i></button>
                                                <?php
                                            }
                                            ?>
                                            <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_NOTE" data-item-id="<?php echo $note->id; ?>" data-toggle="tooltip" title="Delete File"><i class="ti-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    <div class="modal-footer" >
        <button type="button" class="btn btn-success waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="notes-files-new/<?php echo $dir5; ?>" >New</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</form>