<?php
$category = $wam->dbm->getData('categories', '*', [
    'eq' => ['id' => $dir4]
]);
$category = $category[0];
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?php echo $category->name_tr ?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM" actionName="PRODUCTS" actionItem="new-product/<?php echo $category->id; ?>">منتج جديد</button>
            <button type="button" class="btn btn-danger pull-right m-l-20 waves-effect waves-light DIM" actionName="PRODUCTS" actionItem="products-sort/<?php echo $category->id; ?>">تعديل الترتيب</button>
            <ol class="breadcrumb">
                <li>
                    <a href="/produtcs" class="CPB">المنتجات</a>
                </li>
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
                            $products = $wam->dbm->getData('products A', [
                                'A.id',
                                'A.name_tr as name',
                                'A.name_ar',
                                'A.icon',
                            ], [
                                'eq' => [
                                    'A.category' => $category->id,
                                ],
                                'order' => ['A.sort'],
                            ]);
                            foreach ($products as $key => $product) {
                            ?>
                                <tr class="item">
                                    <td class="text-center"><?php echo $product->name ?></td>
                                    <td class="text-center"><?php echo $product->name_ar ?></td>
                                    <td><img src="<?php echo $product->icon; ?>" height="40px" alt="<?php echo $product->name ?>"></td>
                                    <td class="hidden-print">
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 DIM" actionName="PRODUCTS/edit-product" actionItem="<?php echo $product->id; ?>"><i class="ti-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-info btn-outline btn-circle m-r-5 CPDB" data-action="DELETE_PRODUCT" data-item-id="<?php echo $product->id; ?>"><i class="ti-trash"></i></button>
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