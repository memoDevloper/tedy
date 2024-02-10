<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">مدينة <?php echo $city->name_ar; ?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button class="btn btn-warning pull-right m-l-20 waves-effect waves-light DIM" actionName="COMPLEXES/item-new" actionItem="<?php echo $complex->id; ?>">عنصر جديد</button>
            <ol class="breadcrumb">
                <li><a href="/complexes" class="CPB" >المجمعات السكنية</a></li>
                <li><a href="/complexes/city/<?php  echo $city->id;?>" class="backButton CPB" ><?php echo $city->name_ar; ?></a></li>
                <li class="active">اسعار مجمع</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">ادارة الشقق <?php echo $city->name_ar; ?></div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                        <tr>
                            <th>عدد الغرف</th>
                            <th>السعر الابتدائي</th>
                            <th>السعر النهائي</th>
                            <th>المساحة الابتدائية</th>
                            <th>المساحة النهائية</th>
                            <th>نوع العقار</th>
                            <th>الادارة</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $items = $wam->dbm->getData('realestate_complexes_items A', [
                            'A.*',
                        ], [
                            'eq' => ['A.complex' => $complex->id],
                            'order' => ['A.rooms']
                        ]);
                        $types = [
                            'flat' => 'شقة سكنية',
                            'villa' => 'فيلا',
                            'duplex' => 'دوبلكس',
                            'office' => 'مكتب',
                            'store' => 'محل تجاري',
                            'home_office' => 'هوم أوفيس',
	                        'loft' => 'لوفت',
                        ];
                        foreach ($items as $key => $item) {
                            ?>
                            <tr class="item">
                                <td><?php echo $item->rooms ?></td>
                                <td><?php echo $item->price_start ?></td>
                                <td><?php echo $item->price_end ?></td>
                                <td><?php echo $item->area_start ?></td>
                                <td><?php echo $item->area_end ?></td>
                                <td><?php echo $types[$item->type]; ?></td>
                                <td>
                                    <button class="btn btn-info btn-circle waves-effect waves-light DIM" actionName="COMPLEXES/item-edit" actionItem="<?php echo $item->id; ?>" ><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_COMPLEX_ITEM" data-item-id="<?php echo $item->id; ?>" ><i class="ti-trash"></i></button>
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