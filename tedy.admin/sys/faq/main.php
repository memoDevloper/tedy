<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">الأسئلة الشائعة</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-warning pull-right m-l-20 waves-effect waves-light DIM" actionName="FAQ" actionItem="new">سؤال جديد</button>
            <ol class="breadcrumb">
                <li class="active">الأسئلة الشائعة</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">ادارة الأسئلة</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>السؤال</th>
                            <th>الخيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $questions = $wam->dbm->getData('faq A', [
                            'A.id',
                            'A.question',
                        ], [
                            'order' => ['A.question'],
                        ]);
                        foreach ($questions as $key => $question) {
                            ?>
                            <tr class="item" >
                                <td><?php echo $question->question ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-circle waves-effect waves-light DIM" actionName="FAQ/edit" actionItem="<?php echo $question->id; ?>"><i class="fa fa-pencil" ></i></button>
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
</div>