<?php

$employee = $wam->dbm->getData('users', [
    'id',
    'name',
    'lastname',
    'type'
], [
    'eq' => ['id' => $dir5]
]);
$employee = $employee[0];
if($dir6 == ''){
    $year = date('Y', $time);
    $month = date('m', $time);
    $day = date('d', $time);
}else{
    $date = explode('-', $dir6);
    $year = $date[0];
    $month = $date[1];
    $day = $date[2];
}
?>
<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>Employee: <?php echo $employee->name ?> <?php echo $employee->lastname ?></h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
    <div class="row">
        <?php
        $years = [2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026];
        foreach ($years as $key => $year_) {
            ?>
            <div class="col-md-1 col-xs-3"><a href="#" class="DIM <?php echo ($year == $year_) ? 'text-warning' : ''; ?>" actionName="EMPLOYEES/jobs" actionItem="<?php echo $employee->id ?>/<?php echo $year_ ?>-<?php echo $month; ?>" ><?php echo $year_; ?></a></div>
            <?php
        }
        ?>
    </div>
    <div class="row">
        <?php
        foreach ($months_short as $key => $month_) {
            ?>
            <div class="col-md-1 col-xs-3"><a href="#" class="DIM <?php echo ($month == $key) ? 'text-warning' : ''; ?>" actionName="EMPLOYEES/jobs" actionItem="<?php echo $employee->id ?>/<?php echo $year ?>-<?php echo $key; ?>" ><?php echo $month_; ?></a></div>
            <?php
        }
        ?>
    </div>
</div>
<form class="form-horizontal form-material form" >
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table" >
                        <thead>
                        <tr>
                            <th>CODE</th>
                            <th>CLIENT</th>
                            <th>STATUS</th>
                            <th>PRIORITY</th>
                            <th>DEADLINE</th>
                            <th>Delivery Date</th>
                            <th>TARGET</th>
                            <th>FILES</th>
                            <th>PROGRESS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $files = $wam->dbm->getData('projects A', [
                            'A.id',
                            'A.client',
                            '(SELECT name FROM clients WHERE id = A.client) as client_name',
                            '(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
                            'A.deadline',
                            'A.direction',
                            'A.status',
                            'A.pages',
                            'A.name',
                            'A.progress_ratio',
                            'A.priority',
                            'A.delivery_date',
                            'A.accountant_acceptance',
                        ], [
                            'eq' => ['year' => $year, 'month' => $month],
                            'li' => ['A.translators' => "[$employee->id]"],
                            'order' => ['A.deadline, A.name'],
                        ]);
                        foreach ($files as $key => $file) {
                            ?>
                            <tr class="item" >
                                <td>
                                    <a href="/files/open/<?php echo $file->name; ?>" class="CPB" >
                                        <?php
                                        $name_parts = explode('-', $file->name);
                                        $name = $name_parts[0];
                                        $name .= "-";
                                        $name .= substr($name_parts[1], 0, 4);
                                        $dayname = substr($name_parts[1], 4, 5);
                                        $name .= substr_replace($name_parts[1], "<span style='color: red' >$dayname", 0);
                                        $name .= "-$name_parts[2]</span>";
                                        echo "<b>" . $name . "</b>";
                                        ?>
                                    </a>
                                    <a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy File Code to Clipboard" ><i class="fa fa-clipboard"></i></a>
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
                                <td><?php echo $wam->act->makeBoldDeadline($file->deadline); ?></td>
                                <td><?php echo ($file->delivery_date) ? $wam->act->makeBoldDeadline($file->delivery_date) : '-'; ?></td>
                                <td><?php echo strtoupper($file->direction) ?></td>
                                <td><?php echo $file->pages ?></td>
                                <td>
                                    <span class="text-danger" ><?php echo number_format($file->progress_ratio, 1); ?>%</span>
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
    <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</form>