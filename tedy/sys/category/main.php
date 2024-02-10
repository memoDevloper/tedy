<!-- Inner Banner Section -->
<section class="inner-banner">
    <div class="image-layer" style="background-image: url('<?php echo $category->cover ? $category->cover : '/images/background/banner-image-2.jpg'; ?>');">
    </div>
    <div class="auto-container">
        <div class="inner">
            <div class="subtitle"><span>delicious & amazing</span></div>
            <div class="pattern-image"><img src="/images/icons/separator.svg" alt="" title=""></div>
            <h1><span><?php echo $category->name; ?></span></h1>
        </div>
    </div>
</section>
<!--End Banner Section -->

<!--Special Offer Section-->
<section class="special-offer-two">
    <div class="left-bg"><img src="/images/background/bg-20.png" alt="" title=""></div>
    <div class="right-bg"><img src="/images/background/bg-19.png" alt="" title=""></div>
    <div class="auto-container">
        <div class="title-box centered">
            <div class="pattern-image"><img src="/images/icons/separator.svg" alt="" title=""></div>
        </div>
        <div class="row clearfix">
            <?php
            $products = $wam->dbm->getData('products A', [
                'A.id',
                'A.name_tr as name',
                'A.desc_tr as description',
                'A.icon',
                'A.price'
            ], [
                'eq' => [
                    'A.category' => $category->id
                ],
                'order' => ['A.sort'],
            ]);
            $ms = 0;
            foreach ($products as $product) {
                $message = 'Merhaba, ' . $product->name . ' ürünü hakkında bilgi almak istiyorum.';
                $link = 'https://wa.me/905550207207?text=' . $message;
                $link = '#';
                if ($ms > 800) $ms = 0;
            ?>
                <!--Item-->
                <div class="offer-block-three col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="<?php echo $ms; ?>ms">
                        <div class="image">
                            <!-- <a href="<?php echo $link; ?>"> -->
                            <img src="<?php echo $product->icon ? $product->icon : '/images/resource/offer-image-3.jpg' ?>" alt="">
                            <!-- </a> -->
                        </div>
                        <h4>
                            <!-- <a href="<?php echo $link; ?>"> -->
                            <?php echo $product->name; ?>
                            <!-- </a> -->
                        </h4>
                        <div class="text desc">
                            <?php
                            if ($product->description) {
                                echo $product->description;
                            } else {
                                echo 'lorem ipsum dolor sit amet consectetur adipisicing elit.';
                            }
                            ?>
                        </div>
                        <div class="price"><?php echo number_format($product->price, 2); ?>TL</div>
                    </div>
                </div>
            <?php
                $ms += 200;
            }
            ?>
        </div>
    </div>
</section>