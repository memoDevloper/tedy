<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Deleted Employees</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Employees</li>
                <li class="active">Deleted</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">MANAGE USERS</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th width="70" class="text-center">#</th>
                            <th>NAME</th>
                            <th>EMPLOYMENT TYPE</th>
                            <th>POSITION</th>
                            <th width="300">MANAGE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $regular_users = $wam->dbm->getData('users A', [
                            'A.id',
                            'A.name',
                            'A.lastname',
                            'A.email',
                            'A.phone',
                            'A.timezone',
                            'A.skype',
                        ], [
                            'eq' => ['A.active' => 0],
                            'not' => ['A.id' => $user->id],
                        ]);
                        foreach ($regular_users as $key => $regular_user) {
                            ?>
                            <tr class="item" >
                                <td class="text-center"><?php echo $regular_user->id ?></td>
                                <td><?php echo $regular_user->name ?> <?php echo $regular_user->lastname ?></td>
                                <td><?php echo ($regular_user->type !== 3) ? 'Regular' : 'Freelance'; ?></td>
                                <td><?php echo $regular_user->position ?></td>
                                <td>
                                    <button class="btn btn-info btn-outlin m-r-5 DIM" actionName="EMPLOYEES" actionItem="tasks/<?php echo $regular_user->id; ?>" data-toggle="tooltip" title="Tasks" >Tasks</button>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5"><i class="ti-key"></i></button>
                                    <a href="/employees/regular/edit/<?php echo $regular_user->id ?>" class="btn btn-info btn-outline btn-circle m-r-5 CPB"><i class="ti-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="RECOVER_EMPLOYEE" data-item-id="<?php echo $regular_user->id; ?>" ><i class="ti-trash"></i></button>
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