<?php
$item = $wam->dbm->getData('project_items', 'id, name, deadline', ['eq' => ['name' => $dir5]]);
$item = $item[0];
?>
<form class="form-horizontal form-material form" >
	<div class="modal-header">
		<div class="row" >
			<div class="col-xs-12" >
                <div class="col-md-6" >
                    <h4 class="pull-left" >Add Translators For: <?php echo $item->name ?></h4>
                </div>
                <div class="col-md-4" >
                    <h4 class="text-danger" >Deadline: <?php echo date('d M Y h:i A', $item->deadline); ?></h4>
                </div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
		</div>
	</div>
	<div class="modal-body" >
		<div class="row" >
			<input type="hidden" name="actionName" value="FILE_ITEM_OPTIONS_ADD_TRANSLATORS" />
			<input type="hidden" name="id" value="<?php echo $item->id; ?>" />
			<input type="hidden" name="mission" value="TRNS" />
            <div class="row" >
                <div class="col-md-12" >
                    <h4>Translators: Regular</h4>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12" >
                    <div class="vtabs">
                        <ul class="nav tabs-vertical">
                            <?php
                            $managers_translators = $wam->dbm->getData('users A', [
                                'A.id',
                                'A.name',
                                'A.lastname',
                                'A.avatar',
                                'A.gender',
                            ], [
                                'eq' => ['A.type' => 1],
                                'order' => ['A.name, A.lastname']
                            ]);
                            $regular_translators = $wam->dbm->getData(['users A', 'employees_regular B'], [
                                'A.id',
                                'A.name',
                                'A.lastname',
                                'A.avatar',
                                'A.gender',
                            ], [
                                'join' => [
                                    'type' => 'right',
                                    'on' => ['A.id', 'B.user']
                                ],
                                'order' => ['A.name, A.lastname']
                            ]);
                            $t = 1;
                            foreach ($managers_translators as $key => $translator) {
                                $MRS  = ($translator->gender == 1) ? 'Mr.' : 'Ms.';
                                ?>
                                <li class="tab <?php echo ($t == 1) ? 'active' : ''; ?>" >
                                    <a data-toggle="tab" href="#home<?php echo $translator->id; ?>" aria-expanded="true">
                                        <input type="checkbox" class="js-switch" name="translators[]" id="user_<?php echo $translator->id ?>" value="<?php echo $translator->id ?>" data-color="#f96262" />
                                        <label for="user_<?php echo $translator->id ?>" ><?php echo $translator->name ?> <?php echo $translator->lastname; ?></label>
                                    </a>
                                </li>
                                <?php
                                ++$t;
                            }
                            foreach ($regular_translators as $key => $translator) {
                                $MRS  = ($translator->gender == 1) ? 'Mr.' : 'Ms.';
                                ?>
                                <li class="tab <?php echo ($t == 1) ? 'active' : ''; ?>" >
                                    <a data-toggle="tab" href="#home<?php echo $translator->id; ?>" aria-expanded="true">
                                        <input type="checkbox" class="js-switch" name="translators[]" id="user_<?php echo $translator->id ?>" value="<?php echo $translator->id ?>" data-color="#f96262" />
                                        <label for="user_<?php echo $translator->id ?>" ><?php echo $translator->name ?> <?php echo $translator->lastname; ?></label>
                                    </a>
                                </li>
                                <?php
                                ++$t;
                            }
                            ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                            $t = 1;
                            foreach ($managers_translators as $key => $translator) {
                                ?>
                                <div id="home<?php echo $translator->id; ?>" class="tab-pane  <?php echo ($t == 1) ? 'active' : ''; ?>">
                                    <div class="col-md-12">
                                        <h3><?php echo $translator->name ?> <?php echo $translator->lastname ?></h3>
                                    </div>
                                    <div class="col-md-12 pull-right">
                                        <div class="form-group" >
                                            <label class="col-md-12" for="deadline_translator_<?php echo $translator->id; ?>">Deadline</label>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input type="text" name="deadline[<?php echo $translator->id; ?>]" class="form-control input-daterange-timepicker" value="<?php echo date('Y-m-d H:I A', $time); ?>" data-mindate="<?php echo date('Y-m-d H:I A', $time); ?>" />
                                                    <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12" for="part_<?php echo $translator->id; ?>">Part</label>
                                            <div class="col-md-12">
                                                <input type="text" name="part[<?php echo $translator->id ?>]" class="form-control form-control-line part" id="part_<?php echo $translator->id; ?>" placeholder="Part" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12" for="notes_<?php echo $translator->id; ?>">Notes</label>
                                            <div class="col-md-12">
                                                <textarea rows="3" cols="30" style="resize: none;" id="notes_<?php echo $translator->id; ?>" name="message[<?php echo $translator->id ?>]" placeholder="Notes" class="form-control" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                ++$t;
                            }
                            foreach ($regular_translators as $key => $translator) {
                                ?>
                                <div id="home<?php echo $translator->id; ?>" class="tab-pane  <?php echo ($t == 1) ? 'active' : ''; ?>">
                                    <div class="col-md-12">
                                        <h3><?php echo $translator->name ?> <?php echo $translator->lastname ?></h3>
                                    </div>
                                    <div class="col-md-12 pull-right">
                                        <div class="form-group" >
                                            <label class="col-md-12" for="deadline_translator_<?php echo $translator->id; ?>">Deadline</label>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input type="text" name="deadline[<?php echo $translator->id; ?>]" class="form-control input-daterange-timepicker" value="<?php echo date('Y-m-d H:I A', $time); ?>" data-mindate="<?php echo date('Y-m-d H:I A', $time); ?>" />
                                                    <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12" for="part_<?php echo $translator->id; ?>">Part</label>
                                            <div class="col-md-12">
                                                <input type="text" name="part[<?php echo $translator->id ?>]" class="form-control form-control-line part" id="part_<?php echo $translator->id; ?>" placeholder="Part" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12" for="notes_<?php echo $translator->id; ?>">Notes</label>
                                            <div class="col-md-12">
                                                <textarea rows="3" cols="30" style="resize: none;" id="notes_<?php echo $translator->id; ?>" name="message[<?php echo $translator->id ?>]" placeholder="Notes" class="form-control" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                ++$t;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12" >
                    <h4>Translators: Freelance</h4>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12" >
                    <div class="vtabs">
                        <ul class="nav tabs-vertical">
                            <?php
                            $freelance_translators = $wam->dbm->getData(['users A', 'employees_freelance B'], [
                                'A.id',
                                'A.name',
                                'A.lastname',
                                'A.avatar',
                                'A.gender',
                            ], [
                                'join' => [
                                    'type' => 'right',
                                    'on' => ['A.id', 'B.user']
                                ],
                                'order' => ['A.name, A.lastname']
                            ]);
                            $t = 1;
                            foreach ($freelance_translators as $key => $translator) {
                                $MRS  = ($translator->gender == 1) ? 'Mr.' : 'Ms.';
                                ?>
                                <li class="tab <?php echo ($t == 1) ? 'active' : ''; ?>" >
                                    <a data-toggle="tab" href="#home<?php echo $translator->id; ?>" aria-expanded="true">
                                        <input type="checkbox" class="js-switch" name="translators[]" id="user_<?php echo $translator->id ?>" value="<?php echo $translator->id ?>" data-color="#f96262" />
                                        <label for="user_<?php echo $translator->id ?>" ><?php echo $translator->name ?> <?php echo $translator->lastname; ?></label>
                                    </a>
                                </li>
                                <?php
                                ++$t;
                            }
                            ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                            $t = 1;
                            foreach ($freelance_translators as $key => $translator) {
                                ?>
                                <div id="home<?php echo $translator->id; ?>" class="tab-pane  <?php echo ($t == 1) ? 'active' : ''; ?>">
                                    <div class="col-md-12">
                                        <h3><?php echo $translator->name ?> <?php echo $translator->lastname ?></h3>
                                    </div>
                                    <div class="col-md-12 pull-right">
                                        <div class="form-group" >
                                            <label class="col-md-12" for="deadline_translator_<?php echo $translator->id; ?>">Deadline</label>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input type="text" name="deadline[<?php echo $translator->id; ?>]" class="form-control input-daterange-timepicker" value="<?php echo date('Y-m-d H:I A', $time); ?>" data-mindate="<?php echo date('Y-m-d H:I A', $time); ?>" />
                                                    <span class="input-group-addon"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12" for="part_<?php echo $translator->id; ?>">Part</label>
                                            <div class="col-md-12">
                                                <input type="text" name="part[<?php echo $translator->id ?>]" class="form-control form-control-line part" id="part_<?php echo $translator->id; ?>" placeholder="Part" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12" for="notes_<?php echo $translator->id; ?>">Notes</label>
                                            <div class="col-md-12">
                                                <textarea rows="3" cols="30" style="resize: none;" id="notes_<?php echo $translator->id; ?>" name="message[<?php echo $translator->id ?>]" placeholder="Notes" class="form-control" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                ++$t;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<div class="modal-footer" >
		<button type="button" class="btn btn-danger waves-effect waves-light DIM" actionName="TRANSLATED_FILES" actionItem="open/<?php echo $item->name; ?>" >Cancel</button>
		<button type="submit" class="btn btn-success waves-effect waves-light">Add</button>
	</div>
</form>