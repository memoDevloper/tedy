<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المنتجات</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM" actionName="PRODUCTS" actionItem="new-category">تصنيف جديد</button>
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM" actionName="PRODUCTS" actionItem="categories-sort">تعديل الترتيب</button>
            <ol class="breadcrumb">
                <li class="active">المنتجات</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel to-copy">
                <div class="panel-heading">إدارة المنتجات</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الاسم العربي</th>
                                <th width="300" class="hidden-print">الإدارة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $categories = $wam->dbm->getData('categories A', [
                                'A.id',
                                'A.name_tr as name',
                                'A.name_ar',
                                'A.icon',
                            ], [
                                'order' => ['A.sort'],
                            ]);
                            foreach ($categories as $key => $category) {
                            ?>
                                <tr class="item">
                                    <td class="text-center"><?php echo $category->name ?></td>
                                    <td class="text-center"><?php echo $category->name_ar ?></td>
                                    <td><img src="<?php echo $category->icon; ?>" height="40px" alt="<?php echo $category->name ?>"></td>
                                    <td class="hidden-print">
                                        <a href="/products/category/<?php echo $category->id; ?>" class="btn btn-info btn-outline btn-circle m-r-5 CPB"><i class="ti-view-list-alt"></i></a>
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="PRODUCTS/edit-category" actionItem="<?php echo $category->id; ?>"><i class="ti-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_CATEGORY" data-item-id="<?php echo $category->id; ?>"><i class="ti-trash"></i></button>
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