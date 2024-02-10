<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">File: <?php echo $file->name; ?></h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="/files" class="CPB backButton" >Files</a></li>
                <li><a href="/files/<?php echo $file->year; ?>" class="CPB backButton" ><?php echo $file->year; ?></a></li>
                <li><a href="/files/<?php echo $file->year; ?>/<?php echo $months_short[$file->month]; ?>" class="CPB backButton" ><?php echo $months_short[$file->month]; ?></a></li>
                <li><a href="/files/<?php echo $file->year; ?>/<?php echo $months_short[$file->month]; ?>/<?php echo sprintf("%02d", $file->day); ?>" class="CPB backButton" ><?php echo sprintf("%02d", $file->day); ?></a></li>
                <li><a href="/files/open/<?php echo $file->name; ?>" class="CPB backButton" ><?php echo $file->name; ?></a></li>
                <li class="active">New Item</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material form" autocomplete="off">
                    <input type="hidden" name="actionName" value="NEW_ITEM">
                    <input type="hidden" name="project" value="<?php echo $file->name; ?>">
                    <div class="form-group" >
                        <label class="col-md-12" for="file">File</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="file" name="file" class="form-control file" id="file" placeholder="File">
                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-12" for="deadline">Deadline</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" name="deadline" class="form-control input-daterange-timepicker" value="<?php echo date('Y-m-d H:I A', $file->deadline); ?>" data-mindate="<?php echo date('Y-m-d H:I A', $time); ?>" />
                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="direction">Target Language</label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line direction" id="direction" name="direction">
                                <option value="ar" <?php echo ($file->direction == 'ar') ? 'selected' : ''; ?> >AR</option>
                                <option value="en" <?php echo ($file->direction == 'en') ? 'selected' : ''; ?> >EN</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="pages">Pages</label>
                        <div class="col-md-12">
                            <input type="number" required name="pages" min="1" class="form-control form-control-line pages" id="pages" placeholder="Pages" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="priority">Priority</label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line priority" id="priority" name="priority">
                                <option value="">None</option>
                                <option value="high" >High</option>
                                <option value="low" >Low</option>
                            </select>
                        </div>
                    </div>
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
                                                            <input type="text" name="deadline_translator[<?php echo $translator->id; ?>]" class="form-control input-daterange-timepicker" value="<?php echo date('Y-m-d H:I A', $file->deadline); ?>"  data-mindate="<?php echo date('Y-m-d H:I A', $time); ?>"  />
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
                                                            <input type="text" name="deadline_translator[<?php echo $translator->id; ?>]" class="form-control input-daterange-timepicker" value="<?php echo date('Y-m-d H:I A', $file->deadline); ?>"  data-mindate="<?php echo date('Y-m-d H:I A', $time); ?>"  />
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
                                                            <input type="text" name="deadline_translator[<?php echo $translator->id; ?>]" class="form-control input-daterange-timepicker" value="<?php echo date('Y-m-d h:I A', $file->deadline); ?>"  data-mindate="<?php echo date('Y-m-d H:I A', $time); ?>"  />
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
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">ADD</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>