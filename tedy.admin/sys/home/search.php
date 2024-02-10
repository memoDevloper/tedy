<?php
$dir6 = trim($dir6);
?>
<form class="form">
    <div class="modal-header">
        <div class="row">
            <div class="col-xs-12">
                <h4 class="pull-left">Search: <?php echo $dir6 ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
        </div>
    </div>
    <div class="modal-body">
        <div class="row print-area">
            <div class="col-sm-12">
                <?php
                if($dir5 == 'jobs' || $dir5 == 'all'){
                    if($user->type == 1 || in_array('files_full_control', $user->permissions)){
                        $jobs = $wam->dbm->getData('projects A', [
                            'A.id',
                            'A.client',
                            '(SELECT name FROM clients WHERE id = A.client) as client_name',
                            '(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
                            'A.deadline',
                            'A.translators',
                            'A.direction',
                            'A.status',
                            'A.pages',
                            'A.name',
                            'A.progress_ratio',
                            'A.priority',
                            'A.accountant_acceptance',
                        ], [
                            'li' => ['A.name' => $dir6],
                            'order' => ['A.deadline'],
                        ]);
                    }elseif($user->type == 2){
                        $jobs = $wam->dbm->getData('projects A', [
                            'A.id',
                            'A.client',
                            '(SELECT name FROM clients WHERE id = A.client) as client_name',
                            '(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
                            'A.deadline',
                            'A.translators',
                            'A.direction',
                            'A.status',
                            'A.pages',
                            'A.name',
                            'A.progress_ratio',
                            'A.priority',
                            'A.accountant_acceptance',
                        ], [
                            'li' => ['translators' => "[$user->id]", 'A.name' => $dir6],
                            'order' => ['A.deadline'],
                        ]);
                    }
                    ?>
                    <h3>Jobs</h3>
                    <table class="table table-hover manage-u-table">
                        <thead>
                            <tr>
                                <th>CODE</th>
                                <th>MANAGER</th>
                                <th>CLIENT</th>
                                <th>STATUS</th>
                                <th>Priority</th>
                                <th>DEADLINE</th>
                                <th>TARGET</th>
                                <th>FILES</th>
                                <th>PROGRESS</th>
                                <th class="hidden-print" >MANAGE</th>
                                <th class="hidden-print" >NOTES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($jobs as $key => $file) {
                                ?>
                                <tr class="item" >
                                    <td>
                                        <a href="/files/open/<?php echo $file->name; ?>" class="CPB" data-dismiss="modal" >
                                            <?php
                                            $name = str_ireplace($dir6, "<span class='text-danger' >$dir6</span>", $file->name);
                                            echo "<b>" . $name . "</b>";
                                            ?>
                                        </a>
                                        <a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy File Code to Clipboard" ><i class="fa fa-clipboard"></i></a>
                                    </td>
                                    <td>
                                        <?php
                                        $translators = explode('[//]', $file->translators);
                                        foreach ($translators as $key => $translator) {
                                            $translator_id = str_replace(['[', ']'], ['', ''], $translator);
                                            $translator = $wam->dbm->getData('users', ['name', 'lastname'], ['eq' => ['id' => $translator_id]]);
                                            $translator = $translator[0];
                                            ?>
                                            <?php echo $translator->name ?> <?php echo $translator->lastname ?><br />
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $file->client_name ?> <?php echo $file->client_lastname ?></td>
                                    <td>
                                        <?php
                                        $status = [
                                            1 => 'Done',
                                            2 => 'Amend',
                                            3 => 'Pending',
                                            4 => 'Temp'
                                        ][$file->status];
                                        if($file->status == 1 && $file->accountant_acceptance){
                                            $status = 'Posted';
                                        }
                                        echo $status;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if(!empty($file->priority)){
                                            if($file->priority == "high"){
                                                ?>
                                                <i class="fa fa-flag" style="color:red;" ></i>
                                                <?php
                                            }else{
                                                ?>
                                                <i class="fa fa-flag" style="color:orange;" ></i>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo date('Y-m-d h:I A', $file->deadline); ?></td>
                                    <td><?php echo strtoupper($file->direction) ?></td>
                                    <td><?php echo $file->pages ?></td>
                                    <td>
                                        <b class="text-danger" ><?php echo number_format($file->progress_ratio, 1); ?>%</b>
                                    </td>
                                    <td class="hidden-print" >
                                        <a href="/files/edit/<?php echo $file->name; ?>" class="btn btn-info btn-outline btn-circle m-r-5 CPB" data-toggle="tooltip" title="Edit File" ><i class="ti-pencil-alt"></i></a>
                                    </td>
                                    <td class="hidden-print" >
                                        <button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="TRANSLATED_FILES" actionItem="notes-jobs/<?php echo $file->id; ?>" data-toggle="tooltip" title="Notes" ><i class="fa fa-comment"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                if($dir5 == 'file_inquiry' || $dir5 == 'all'){
                    if($user->type == 1 || in_array('files_full_control', $user->permissions)){
                        $files = $wam->dbm->getData('project_items_missions A', [
                            'A.id',
                            'A.project',
                            'A.date',
                            'A.deadline',
                            'A.translator',
                            'A.pages',
                            "A.direction",
                            "(SELECT name FROM users WHERE id = A.translator) as translator_name",
                            "(SELECT lastname FROM users WHERE id = A.translator) as translator_lastname",
                            'A.item as name',
                            'A.extension',
                            'A.viewed',
                            'A.mission',
                            'A.missions',
                            'A.message',
                            "(SELECT id FROM project_items_translated WHERE mission_file = A.id Limit 1) as mission_file",
                            "(SELECT date FROM project_items_translated WHERE mission_file = A.id Limit 1) as received",
                        ], [
                            'li' => ['A.item' => $dir6],
                            'order' => ['A.item'],
                        ]);
                    }
                    ?>
                    <h3>File Inquiry</h3>
                    <table class="table table-hover manage-u-table" >
                        <thead>
                            <tr>
                                <th width="18%" >CODE</th>
                                <th width="10%" >Translator</th>
                                <th width="5%" >Task</th>
                                <th width="5%" >Part</th>
                                <th width="15%" >Deadline</th>
                                <th width="15%" >Sent</th>
                                <th width="15%" >Received</th>
                                <th>Viewed</th>
                                <th class="hidden-print" >MANAGE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($files as $key => $file) {
                                $missions = explode('[//]', $file->missions);
                                    ?>
                                    <tr class="item" >
                                        <td>
                                            <!--<div class="radio radio-danger">
												<input type="radio" name="relied" id="relied_<?php echo $file->id; ?>" <?php echo ($item->translate_file == $file->id) ? 'checked' : ''; ?> value="<?php echo $file->id; ?>">
											</div>-->
                                            <?php
                                            $name = str_ireplace($dir6, "<span class='text-danger' >$dir6</span>", $file->name);
                                            ?>
                                            <label for="xxrelied_<?php echo $file->id; ?>" ><?php echo $name; ?></label>
                                            <a  data-file="<?php echo $file->name; ?>-<?php echo $file->mission ?>" data-toggle="tooltip" title="Copy file code to Clipboard" ><i class="fa fa-clipboard"></i></a>
                                        </td>
                                        <td><?php echo "$file->translator_name $file->translator_lastname"; ?></td>
                                        <td><?php echo strtoupper($file->mission); ?></td>
                                        <td><?php echo strtoupper($file->pages); ?></td>
                                        <td><span class="text-info" ><?php echo date('d M Y h:i A', $file->deadline); ?></span></td>
                                        <td><?php echo date('d M Y h:i A', $file->date); ?></td>
                                        <td><?php echo ($file->received > 0) ? date('d M Y h:i A', $file->received) : '-'; ?></td>
                                        <td>
                                            <?php
                                            if($file->viewed){
                                                if($file->viewed == 1){
                                                    ?>
                                                    <a href="#" message-present data-type="success" data-message="<?php echo $file->message ?>" ><i class="fa fa-check text-success"></i></a>
                                                    <?php
                                                }elseif($file->viewed == 2){
                                                    ?>
                                                    <a href="#" message-present data-type="error" data-message="<?php echo $file->message ?>" ><i class="fa fa-close text-danger"></i></a>
                                                    <?php
                                                }
                                            }else{
                                                ?>
                                                <i class="fa fa-circle"></i>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="hidden-print" >
                                            <?php
                                            if (count($missions) > 1) {
                                                ?>
                                                <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="TRANSLATED_FILES" actionItem="multiple-task-files/<?php echo $file->id; ?>" data-toggle="tooltip" title="Files List" ><i class="fa fa-list"></i></button>
                                                <?php
                                            }else{
                                                ?>
                                                <button type="button" class="btn btn-info btn-outline btn-circle m-r-5" data-download-file="<?php echo $file->id; ?>" data-type="<?php echo strtoupper($file->mission); ?>" data-toggle="tooltip" title="Download File" ><i class="fa fa-download"></i></button>
                                                <?php
                                            }
                                            if($file->mission_file){
                                                ?>
                                                <button type="button" class="btn btn-success btn-outline btn-circle m-r-5" data-download-file="<?php echo $file->mission_file; ?>" data-type="translated" data-toggle="tooltip" title="Download Worked File" ><i class="fa fa-download"></i></button>
                                                <?php
                                            }else{
                                                ?>
                                                <button type="button" class="btn btn-danger btn-outline btn-circle m-r-5 disabled" disabled="" data-toggle="tooltip" title="Download Worked File" ><i class="fa fa-download"></i></button>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                if($dir5 == 'laws' || $dir5 == 'all'){
                    ?>
                    <h3>Laws</h3>
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>CODE</th>
                            <th width="40%" >TITLE</th>
                            <th>EXTENSION</th>
                            <th>USER</th>
                            <th>DATE</th>
                            <th class="hidden-print" >MANAGE</th>
                            <th class="hidden-print" >NOTES</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $files = $wam->dbm->getData('administrative_files A', [
                                'A.id',
                                'A.category',
                                'A.section',
                                'A.name',
                                'A.file',
                                'A.extension',
                                'A.code',
                                'A.date',
                                '(SELECT name FROM users WHERE id = A.user) as user_name',
                                '(SELECT lastname FROM users WHERE id = A.user) as user_lastname',
                            ], ['eq' => ['A.section' => 'laws'], 'li' => ['A.name' => $dir6]]);
                            foreach ($files as $key => $file){
                                ?>
                                <tr>
                                    <td><a href="/<?php echo $file->file ?>" ><?php echo $file->code ?></a></td>
                                    <td><a href="/<?php echo $file->file ?>" ><?php echo $file->name ?></a></td>
                                    <td><?php echo $file->extension ?></td>
                                    <td><?php echo $file->user_name ?> <?php echo $file->user_lastname ?></td>
                                    <td><?php echo date('Y-m-d h:I A', $file->date); ?></td>
                                    <td class="hidden-print" >
                                        <button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="ADMINISTRATIVE_FILES" actionItem="edit-file/<?php echo $file->id; ?>" data-toggle="tooltip" title="Edit" ><i class="ti-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5" data-toggle="tooltip" title="Delete File"><i class="ti-trash"></i></button>
                                    </td>
                                    <td class="hidden-print" >
                                        <button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="ADMINISTRATIVE_FILES" actionItem="notes/<?php echo $file->id; ?>" data-toggle="tooltip" title="Notes" ><i class="fa fa-comment"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                if($dir5 == 'references' || $dir5 == 'all'){
                    ?>
                    <h3>References</h3>
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>CODE</th>
                            <th width="40%" >TITLE</th>
                            <th>EXTENSION</th>
                            <th>USER</th>
                            <th>DATE</th>
                            <th class="hidden-print" >MANAGE</th>
                            <th class="hidden-print" >NOTES</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $files = $wam->dbm->getData('administrative_files A', [
                            'A.id',
                            'A.category',
                            'A.section',
                            'A.name',
                            'A.file',
                            'A.extension',
                            'A.code',
                            'A.date',
                            '(SELECT name FROM users WHERE id = A.user) as user_name',
                            '(SELECT lastname FROM users WHERE id = A.user) as user_lastname',
                        ], ['eq' => ['A.section' => 'references'], 'li' => ['A.name' => $dir6]]);
                        foreach ($files as $key => $file){
                            ?>
                            <tr>
                                <td><a href="/<?php echo $file->file ?>" ><?php echo $file->code ?></a></td>
                                <td><a href="/<?php echo $file->file ?>" ><?php echo $file->name ?></a></td>
                                <td><?php echo $file->extension ?></td>
                                <td><?php echo $file->user_name ?> <?php echo $file->user_lastname ?></td>
                                <td><?php echo date('Y-m-d h:I A', $file->date); ?></td>
                                <td class="hidden-print" >
                                    <button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="ADMINISTRATIVE_FILES" actionItem="edit-file/<?php echo $file->id; ?>" data-toggle="tooltip" title="Edit" ><i class="ti-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5" data-toggle="tooltip" title="Delete File"><i class="ti-trash"></i></button>
                                </td>
                                <td class="hidden-print" >
                                    <button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="ADMINISTRATIVE_FILES" actionItem="notes/<?php echo $file->id; ?>" data-toggle="tooltip" title="Notes" ><i class="fa fa-comment"></i></button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                }
                if($dir5 == 'samples' || $dir5 == 'all'){
                    ?>
                    <h3>Samples</h3>
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>CODE</th>
                            <th width="40%" >TITLE</th>
                            <th>EXTENSION</th>
                            <th>USER</th>
                            <th>DATE</th>
                            <th class="hidden-print" >MANAGE</th>
                            <th class="hidden-print" >NOTES</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $files = $wam->dbm->getData('administrative_files A', [
                            'A.id',
                            'A.category',
                            'A.section',
                            'A.name',
                            'A.file',
                            'A.extension',
                            'A.code',
                            'A.date',
                            '(SELECT name FROM users WHERE id = A.user) as user_name',
                            '(SELECT lastname FROM users WHERE id = A.user) as user_lastname',
                        ], ['eq' => ['A.section' => 'samples'], 'li' => ['A.name' => $dir6]]);
                        foreach ($files as $key => $file){
                            ?>
                            <tr>
                                <td><a href="/<?php echo $file->file ?>" ><?php echo $file->code ?></a></td>
                                <td><a href="/<?php echo $file->file ?>" ><?php echo $file->name ?></a></td>
                                <td><?php echo $file->extension ?></td>
                                <td><?php echo $file->user_name ?> <?php echo $file->user_lastname ?></td>
                                <td><?php echo date('Y-m-d h:I A', $file->date); ?></td>
                                <td class="hidden-print" >
                                    <button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="ADMINISTRATIVE_FILES" actionItem="edit-file/<?php echo $file->id; ?>" data-toggle="tooltip" title="Edit" ><i class="ti-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5" data-toggle="tooltip" title="Delete File"><i class="ti-trash"></i></button>
                                </td>
                                <td class="hidden-print" >
                                    <button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="ADMINISTRATIVE_FILES" actionItem="notes/<?php echo $file->id; ?>" data-toggle="tooltip" title="Notes" ><i class="fa fa-comment"></i></button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                }
                if($dir5 == 'name_list_en' || $dir5 == 'all'){
                    ?>
                    <h3>Name List En</h3>
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Name Ar</th>
                            <th>Source</th>
                            <th>Type</th>
                            <th>User</th>
                            <th>Date</th>
                            <th class="hidden-print" >Notes</th>
                            <th class="hidden-print" >File</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $list = $wam->dbm->getData('name_list A', [
                            'A.id',
                            'A.name',
                            'A.name_ar',
                            'A.source',
                            'A.type',
                            '(SELECT name FROM users WHERE id = A.user) as user_name',
                            '(SELECT lastname FROM users WHERE id = A.user) as user_lastname',
                            'A.date',
                            'A.file',
                        ], [
                            'li' => ['A.name' => $dir6]
                        ]);
                        foreach ($list as $key => $item){
                            $item->name = str_ireplace($dir6, "<span class='text-danger'>$dir6</span>", $item->name);
                            ?>
                            <tr>
                                <td><?php echo $item->name ?></td>
                                <td><?php echo $item->name_ar ?></td>
                                <td><?php echo $item->source ?></td>
                                <td><?php echo $item->type ?></td>
                                <td><?php echo $item->user_name ?> <?php echo $item->user_lastname ?></td>
                                <td><?php echo date('Y-m-d h:I A', $item->date); ?></td>
                                <td class="hidden-print" >
                                    <button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="ADMINISTRATIVE_FILES" actionItem="notes/<?php echo $file->id; ?>" data-toggle="tooltip" title="Notes" ><i class="fa fa-comment"></i></button>
                                </td>
                                <td class="hidden-print" >
                                    <?php
                                    if(!empty($item->file)){
                                        ?>
                                        <a href="/<?php echo $item->file; ?>" class="btn btn-info btn-outline btn-circle m-r-5" data-toggle="tooltip" title="Donwload File" ><i class="fa fa-download"></i></a>
                                        <?php
                                    }else{
                                        ?>
                                        <button disabled class="btn btn-info btn-outline btn-circle m-r-5" data-toggle="tooltip" title="Donwload File" ><i class="fa fa-download"></i></button>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                }
                if($dir5 == 'name_list_ar' || $dir5 == 'all'){
                    ?>
                    <h3>Name List Ar</h3>
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Name Ar</th>
                            <th>Source</th>
                            <th>Type</th>
                            <th>User</th>
                            <th>Date</th>
                            <th class="hidden-print" >Notes</th>
                            <th class="hidden-print" >File</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $list = $wam->dbm->getData('name_list A', [
                            'A.id',
                            'A.name',
                            'A.name_ar',
                            'A.source',
                            'A.type',
                            '(SELECT name FROM users WHERE id = A.user) as user_name',
                            '(SELECT lastname FROM users WHERE id = A.user) as user_lastname',
                            'A.date',
                            'A.file',
                        ], [
                            'li' => ['A.name_ar' => $dir6]
                        ]);
                        foreach ($list as $key => $item){
                            $item->name_ar = str_ireplace($dir6, "<span class='text-danger'>$dir6</span>", $item->name_ar);
                            ?>
                            <tr>
                                <td><?php echo $item->name ?></td>
                                <td><?php echo $item->name_ar ?></td>
                                <td><?php echo $item->source ?></td>
                                <td><?php echo $item->type ?></td>
                                <td><?php echo $item->user_name ?> <?php echo $item->user_lastname ?></td>
                                <td><?php echo date('Y-m-d h:I A', $item->date); ?></td>
                                <td class="hidden-print" >
                                    <button class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="ADMINISTRATIVE_FILES" actionItem="notes/<?php echo $file->id; ?>" data-toggle="tooltip" title="Notes" ><i class="fa fa-comment"></i></button>
                                </td>
                                <td class="hidden-print" >
                                    <?php
                                    if(!empty($item->file)){
                                        ?>
                                        <a href="/<?php echo $item->file; ?>" class="btn btn-info btn-outline btn-circle m-r-5" data-toggle="tooltip" title="Donwload File" ><i class="fa fa-download"></i></a>
                                        <?php
                                    }else{
                                        ?>
                                        <button disabled class="btn btn-info btn-outline btn-circle m-r-5" data-toggle="tooltip" title="Donwload File" ><i class="fa fa-download"></i></button>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="modal-footer" >
        <button id="print" class="btn btn-default btn-outline" type="button" data-area="div.print-area"> <span><i class="fa fa-print"></i> Print</span> </button>
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    </div>
</form>