<!-- Inner Banner Section -->
<section class="inner-banner">
    <div class="image-layer" style="background-image: url('/images/background/banner-image-4.jpg');"></div>
    <div class="auto-container">
        <div class="inner">
            <h1><span><?php echo $wam->lng->language['_MENU_'] ?></span></h1>
            <div class="pattern-image"><img src="/images/icons/separator.svg" alt="" title=""></div>
        </div>
    </div>
</section>
<!--End Banner Section -->

<!--We Offer Section-->
<section class="we-offer-section">
    <div class="left-bot-bg"><img src="/images/background/bg-1.png" alt="" title=""></div>
    <div class="right-top-bg"><img src="/images/background/bg-2.png" alt="" title=""></div>
    <div class="auto-container">
        <div class="title-box centered">
            <div class="subtitle"><span><?php echo $wam->lng->language['_FLAVORS_FOR_ROYALTY_']; ?></span></div>
            <div class="pattern-image"><img src="/images/icons/separator.svg" alt="" title=""></div>
            <h2><?php echo $wam->lng->language['_WE_OFFER_TOP_NOTCH_']; ?></h2>
        </div>
        <div class="row justify-content-center clearfix">
            <?php
            $categories = $wam->dbm->getData('categories A', [
                'A.id',
                'A.name_tr as name',
                'A.icon'
            ], [
                'order' => ['A.sort']
            ]);
            $ms = 0;
            foreach ($categories as $category) {
                if ($ms > 600) $ms = 0;
            ?>
            <!--Block-->
            <div class="offer-block col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="<?php echo $ms ?>ms">
                    <div class="image"><a href="/category/<?php echo $category->id; ?>"><img
                                src="<?php echo $category->icon ? $category->icon : '/images/resource/offer-image-1.jpg' ?>"
                                alt=""></a></div>
                    <h3><a href="/category/<?php echo $category->id; ?>"><?php echo $category->name ?></a></h3>
                    <div class="more-link"><a href="/category/<?php echo $category->id; ?>">view menu</a></div>
                </div>
            </div>
            <?php
                $ms += 300;
            }
            ?>

        </div>
    </div>
</section>
