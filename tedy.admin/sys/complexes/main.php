<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المجمعات السكنية</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active">المجمعات السكنية</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">المدن</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>المدينة</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $cities = $wam->dbm->getData('realestate_complexes A', [
                            'A.id',
                            'A.city',
                            '(SELECT name_ar FROM cities WHERE id = A.city) as name',
                        ], [
                            'group' => ['A.city']
                        ]);
                        foreach ($cities as $key => $city) {
                            ?>
                            <tr>
                                <td><a href="/complexes/city/<?php echo $city->city; ?>" class="CPB" ><?php echo $city->name ?></a></td>
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