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
                <li class="active">New Items</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material form" autocomplete="off">
                    <input type="hidden" name="actionName" value="NEW_ITEMS">
                    <input type="hidden" name="project" value="<?php echo $file->name; ?>">
                    <div class="form-group" >
                        <label class="col-md-12" for="xx">Files</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="file" multiple="multiple" name="items[]" class="form-control xx" id="xx" placeholder="Files">
                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            </div>
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