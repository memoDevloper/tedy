<?php
$statisticsData = $wam->dbm->getData('statistics', '*', []);
$statistics = [];
foreach ($statisticsData as $key => $statistic) {
    $statistics[$statistic->name] = $statistic->value;
}
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">تعديل تدوينة</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>الإحصائيات</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material form" autocomplete="off">
                    <input type="hidden" name="actionName" value="EDIT_STATISTICS">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="sessions">جلسات تم تنظيمها</label>
                                <div class="col-md-12">
                                    <div>
                                        <input type="number" required name="statistics[sessions]"
                                            class="form-control form-control-line sessions text-count" id="sessions"
                                            placeholder="جلسات تم تنظيمها"
                                            value="<?php echo $statistics['sessions']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="videos">فيديوهات تم إنتاجها</label>
                                <div class="col-md-12">
                                    <div>
                                        <input type="number" required name="statistics[videos]"
                                            class="form-control form-control-line videos text-count" id="videos"
                                            placeholder="فيديوهات تم إنتاجها"
                                            value="<?php echo $statistics['videos']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="projects">مشاريع تم تسليمها</label>
                                <div class="col-md-12">
                                    <div>
                                        <input type="number" required name="statistics[projects]"
                                            class="form-control form-control-line projects text-count" id="projects"
                                            placeholder="مشاريع تم تسليمها"
                                            value="<?php echo $statistics['projects']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="clients">عملاؤونا</label>
                                <div class="col-md-12">
                                    <div>
                                        <input type="number" required name="statistics[clients]"
                                            class="form-control form-control-line clients text-count" id="clients"
                                            placeholder="عملاؤونا" value="<?php echo $statistics['clients']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">تعديل</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
