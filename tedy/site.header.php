<!-- Main Header-->
<header class="main-header header-down">
    <div class="header-top">
        <div class="auto-container">
            <div class="inner clearfix">
                <div class="top-left clearfix">
                    <ul class="top-info clearfix">
                        <li>
                            <i class="icon far fa-map-marker-alt"></i>
                            Istanbul, Metrobüs Yenibosan İstasyonu
                        </li>
                        <li>
                            <i class="icon far fa-clock"></i>
                            Daily : 8.00 am to 10.00 pm
                        </li>
                    </ul>
                </div>
                <div class="top-right clearfix">
                    <ul class="top-info clearfix">
                        <li>
                            <a href="tel:+902128091297">
                                <i class="icon far fa-phone"></i>
                                <span dir="ltr">+90 (212) 809 12 97</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Upper -->
    <div class="header-upper">
        <div class="auto-container">
            <!-- Main Box -->
            <div class="main-box clearfix">
                <!--Logo-->
                <div class="logo-box">
                    <div class="logo">
                        <a href="/" title="Tedy">
                            <img src="/images/logo.webp" alt="Tedy" title="Tedy" height="50">
                        </a>
                    </div>
                </div>

                <div class="nav-box clearfix">
                    <!--Nav Outer-->
                    <div class="nav-outer clearfix">
                        <nav class="main-menu">
                            <ul class="navigation clearfix">
                                <li class="current"><a href="/"><?php echo $wam->lng->language['_HOME_'] ?></a>
                                </li>
                                <li class="dropdown">
                                    <a href="/menu">
                                        <?php echo $wam->lng->language['_PRODUCTS_'] ?>
                                    </a>
                                    <ul>
                                        <?php
                                        $subCategories = $wam->dbm->getData('categories A', [
                                            'A.id',
                                            "A." . $wam->lng->dbTitle['name'] . " as name",
                                            'A.name_tr as second_name'
                                        ], [
                                            'order' => ['A.sort'],
                                            'limit' => ['5']
                                        ]);
                                        foreach ($subCategories as $subCategory) {
                                        ?>
                                        <li>
                                            <a href="/category/<?php echo $subCategory->id; ?>">
                                                <?php echo $subCategory->name ? $subCategory->name : $subCategory->second_name; ?>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        <li>
                                            <a href="/menu">
                                                <?php echo $wam->lng->language['_MORE_']; ?>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="/about-us"><?php echo $wam->lng->language['_ABOUT_US_'] ?></a></li>
                                <li><a href="/contact-us"><?php echo $wam->lng->language['_CONTACT_US_'] ?></a></li>
                                <li class="dropdown">
                                    <a href="#">
                                        <i class="fas fa-language fa-2x"></i>
                                        <!-- <?php echo $wam->lng->language['_LANGUAGE_'] ?> -->
                                    </a>
                                    <ul>
                                        <?php
                                        $languages = [
                                            'en' => $wam->lng->language['_ENGLISH_'],
                                            'tr' => $wam->lng->language['_TURKISH_'],
                                            'ar' => $wam->lng->language['_ARABIC_'],
                                        ];
                                        foreach ($languages as $key => $language) {
                                        ?>
                                        <li>
                                            <a href="/ajax/change-language/<?php echo $key ?>">
                                                <?php echo $language; ?>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <!-- Main Menu End-->
                    </div>
                    <!--Nav Outer End-->

                    <!-- Hidden Nav Toggler -->
                    <div class="nav-toggler">
                        <div style="display: flex;width: 100px;gap: 50px;">
                            <div class="dropdown">
                                <a href="#">
                                    <i class="fas fa-language fa-2x"></i>
                                    <!-- <?php echo $wam->lng->language['_LANGUAGE_'] ?> -->
                                </a>
                                <ul>
                                    <?php
                                        $languages = [
                                            'en' => $wam->lng->language['_ENGLISH_'],
                                            'tr' => $wam->lng->language['_TURKISH_'],
                                            'ar' => $wam->lng->language['_ARABIC_'],
                                        ];
                                        foreach ($languages as $key => $language) {
                                        ?>
                                    <li>
                                        <a href="/ajax/change-language/<?php echo $key ?>">
                                            <?php echo $language; ?>
                                        </a>
                                    </li>
                                    <?php
                                        }
                                        ?>
                                </ul>
                            </div>
                            <button class="hidden-bar-opener">
                                <span class="hamburger">
                                    <span class="top-bun"></span>
                                    <span class="meat"></span>
                                    <span class="bottom-bun"></span>
                                </span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</header>
<!--End Main Header -->

<!--Menu Backdrop-->
<div class="menu-backdrop"></div>

<!-- Hidden Navigation Bar -->
<section class="hidden-bar">
    <!-- Hidden Bar Wrapper -->
    <div class="inner-box">
        <div class="cross-icon hidden-bar-closer"><span class="far fa-close"></span></div>
        <div class="logo-box"><a href="/" title="Tedy"><img src="/images/logo.webp" alt="" title="Tedy"></a></div>

        <!-- .Side-menu -->
        <div class="side-menu">
            <ul class="navigation clearfix">
                <li class="current"><a href="/"><?php echo $wam->lng->language['_HOME_'] ?></a>
                </li>
                <li class="dropdown">
                    <a href="/menu">
                        <?php echo $wam->lng->language['_PRODUCTS_'] ?>
                    </a>
                    <ul>
                        <?php
                        $subCategories = $wam->dbm->getData('categories A', [
                            'A.id',
                            "A." . $wam->lng->dbTitle['name'] . " as name",
                            'A.name_tr as second_name'
                        ], []);
                        foreach ($subCategories as $subCategory) {
                        ?>
                        <li>
                            <a href="/category/<?php echo $subCategory->id; ?>">
                                <?php echo $subCategory->name ? $subCategory->name : $subCategory->second_name; ?>
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                        <li>
                            <a href="/menu">
                                <?php echo $wam->lng->language['_MORE_']; ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li><a href="/about-us"><?php echo $wam->lng->language['_ABOUT_US_'] ?></a></li>
                <li><a href="/contact-us"><?php echo $wam->lng->language['_CONTACT_US_'] ?></a></li>
                <li class="dropdown">
                    <a href="#">
                        <i class="fas fa-language fa-2x"></i>
                        <?php echo $wam->lng->language['_LANGUAGE_'] ?>
                    </a>
                    <ul>
                        <?php
                        $languages = [
                            'en' => $wam->lng->language['_ENGLISH_'],
                            'tr' => $wam->lng->language['_TURKISH_'],
                            'ar' => $wam->lng->language['_ARABIC_'],
                        ];
                        foreach ($languages as $key => $language) {
                        ?>
                        <li>
                            <a href="/ajax/change-language/<?php echo $key ?>">
                                <?php echo $language; ?>
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </div><!-- /.Side-menu -->

        <h2>Visit Us</h2>
        <ul class="info">
            <li>
                Ataköy 7-8-9-10, KISIM
                <br />
                Mah. NEF 22 Sitesi
                <br />
                Metrobüs Yenibosan İstasyonu
                <br />
                Bakırköy, İstanbul
            </li>
        </ul>
        <div class="separator"><span></span></div>
        <div class="booking-info">
            <div class="bk-title"><?php echo $wam->lng->language['_BOOKING_REQUEST_']; ?></div>
            <div class="bk-no"><a href="tel:+902128091297" dir="ltr">+90 (212) 809 1297</a></div>
        </div>

    </div><!-- / Hidden Bar Wrapper -->
</section>
<!-- / Hidden Bar -->
