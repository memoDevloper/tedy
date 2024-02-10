<?php
$file = $wam->dbm->getData('projects A',
    [
        'A.id',
        'A.client',
        '(SELECT name FROM clients WHERE id = A.client) as client_name',
        '(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
        'A.date',
        'A.deadline',
        'A.direction',
        'A.status',
        'A.received_from_client',
        'A.is_distributed',
        'A.deliverd_to_client',
        'A.accountant_acceptance',
        'A.progress_ratio',
        'A.name',
    ], [
        'eq' => ['A.id' => $dir5]
    ]
);
$file = $file[0];
?>
<form class="form" >
    <div class="modal-header">
        <div class="row" >
            <div class="col-xs-12" >
                <h4 class="pull-left" >Project Options: <?php echo $file->name ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
        </div>
    </div>
    <div class="modal-body" >
        <div class="row" >
            <div class="col-sm-12" >
                <table width="100%" >
                    <tr>
                        <td width="20%" ><b>Client:</b></td>
                        <td><?php echo $file->client_name ?> <?php echo $file->client_lastname ?></td>
                    </tr>
                    <tr>
                        <td width="20%" ><b>Date:</b></td>
                        <td><?php echo date('d / m / Y', $file->date); ?></td>
                    </tr>
                    <tr>
                        <td width="20%" ><b>Deadline:</b></td>
                        <td><?php echo date('d / m / Y', $file->deadline); ?></td>
                    </tr>
                    <tr>
                        <td width="20%" ><b>Target:</b></td>
                        <td><?php echo strtoupper($file->direction); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-4 col-sm-12" >
                <input type="hidden" name="actionName" value="PROJECT_OPTIONS" />
                <input type="hidden" name="project" value="<?php echo $file->id; ?>" />
                <div class="form-group" >
                    <div class="row" >
                        <label class="col-sm-12" for="status">Select Status: </label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line status" id="status" name="status">
                                <option value="0" <?php echo ($file->status == 0) ? 'selected' : ''; ?> >Not Set</option>
                                <option value="0" <?php echo ($file->status == 1) ? 'selected' : ''; ?> >Done</option>
                                <option value="2" <?php echo ($file->status == 2) ? 'selected' : ''; ?> >Amend</option>
                                <option value="3" <?php echo ($file->status == 3) ? 'selected' : ''; ?> >Pending</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer" >
        <button type="submit" class="btn btn-danger">Save</button>
    </div>
</form>