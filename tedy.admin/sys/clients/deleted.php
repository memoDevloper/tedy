<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Clients</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="/clients" class="CPB" >Clients</a></li>
                <li class="active">Deleted</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">MANAGE CLIENTS</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th width="70" class="text-center">#</th>
                            <th>NAME</th>
                            <th>TYPE</th>
                            <th>EMAIL</th>
                            <th>PHONE</th>
                            <th>Billing Date</th>
                            <th width="300">MANAGE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $clients = $wam->dbm->getData('clients A', [
                            'A.id',
                            'A.type',
                            'A.company',
                            'A.reference',
                            'A.name',
                            'A.lastname',
                            'A.email',
                            'A.phone',
                            'A.billing_date'
                        ], [
                            'eq' => ['A.active' => 0],
                            'order' => ['A.reference'],
                        ]);
                        foreach ($clients as $key => $client) {
                            ?>
                            <tr class="item" >
                                <td class="text-center"><?php echo $client->reference ?></td>
                                <td>
                                    <?php
                                    if($client->type == 1){
                                        echo "$client->name $client->lastname";
                                    }elseif($client->type == 2){
                                        ?>
                                        <b><?php echo $client->name ?></b>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($client->type == 1){
                                        echo "Client";
                                    }elseif($client->type == 2){
                                        ?>
                                        <b>Company</b>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $client->email ?></td>
                                <td><?php echo $client->phone; ?></td>
                                <td><?php echo $client->billing_date; ?></td>
                                <td>
                                    <button class="btn btn-info btn-outlin m-r-5 DIM" actionName="CLIENTS" actionItem="projects/<?php echo $client->id; ?>" data-toggle="tooltip" title="Projects" >Projects</button>
                                    <?php
                                    if($client->type == 1){
                                        ?>
                                        <a href="/clients/edit/<?php echo $client->id ?>" class="btn btn-info btn-outline btn-circle m-r-5 CPB"><i class="ti-pencil-alt"></i></a>
                                        <?php
                                    }elseif($client->type == 2){
                                        ?>
                                        <a href="/clients/edit-company/<?php echo $client->id ?>" class="btn btn-info btn-outline btn-circle m-r-5 CPB"><i class="ti-pencil-alt"></i></a>
                                        <?php
                                    }
                                    ?>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="RECOVER_CLIENT" data-item-id="<?php echo $client->id; ?>" ><i class="ti-trash"></i></button>
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