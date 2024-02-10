<!-- Inner Banner Section -->
<section class="inner-banner">
    <div class="image-layer" style="background-image: url('images/background/banner-image-4.jpg');"></div>
    <div class="auto-container">
        <div class="inner">
            <h1><span><?php echo $wam->lng->language['_CONTACT_US_'] ?></span></h1>
            <div class="pattern-image"><img src="images/icons/separator.svg" alt="" title=""></div>
        </div>
    </div>
</section>
<!--End Banner Section -->

<!--Map Section-->
<div class="contact-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d24092.280358684886!2d28.83497400000001!3d40.991661!3m2!1i1024!2i768!4f13.1!5e0!3m2!1str!2str!4v1683441869353!5m2!1str!2str" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<!--Contact Info Section-->
<section class="contact-page">
    <div class="left-bg"><img src="images/background/bg-25.png" alt="" title=""></div>
    <div class="right-bg"><img src="images/background/bg-6.png" alt="" title=""></div>
    <!--location Section-->
    <div class="location-center">
        <div class="auto-container">
            <div class="cinfo-box">
                <div class="row clearfix justify-content-center">
                    <!--Block-->
                    <div class="contactinfo-block col-lg-4 col-md-4 col-sm-12">
                        <div class="inner-box cp-seprator wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                            <h4><?php echo $wam->lng->language['_CONTACT_INFO_']; ?></h4>
                            <div class="text">
                                Restaurant St, Delici City, London 9578, UK
                                <br>
                                Email: booking@domainname.com
                            </div>
                            <div class="more-link">
                                <a href="tel:+902128091297">
                                    Booking : <span dir="ltr">+90 (212) 809 12 97</span>
                                </a>
                            </div>
                            <div class="more-link">
                                <a href="tel:+905550207207">
                                    Booking : <span dir="ltr">+90 (555) 020 72 07</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Location form Section-->
    <div class="auto-container">
        <div class="c-page-form-box">
            <div class="row clearfix">
                <!--form Section-->
                <div class="loc-block col-lg-6 col-md-12 col-sm-12">
                    <div class="title-box centered">
                        <h2><?php echo $wam->lng->language['_WRITE_MESSAGE_'] ?></h2>
                        <div class="text desc"><?php echo $wam->lng->language['_CONTACT_DESC_'] ?></div>
                    </div>
                    <div class="default-form reservation-form">
                        <form method="post" action="index.html">
                            <div class="clearfix">
                                <div class="form-group">
                                    <div class="field-inner">
                                        <input type="text" name="name" value="" placeholder="<?php echo $wam->lng->language['_NAME_'] ?>" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="field-inner">
                                        <input type="text" name="email" value="" placeholder="<?php echo $wam->lng->language['_EMAIL_'] ?>" required="">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="field-inner">
                                        <input type="text" name="phone" value="" placeholder="<?php echo $wam->lng->language['_PHONE_'] ?>" required="">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="field-inner">
                                        <textarea name="message" placeholder="<?php echo $wam->lng->language['_MESSAGE_'] ?>" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn-style-one clearfix">
                                        <span class="btn-wrap">
                                            <span class="text-one"><?php echo $wam->lng->language['_SEND_'] ?></span>
                                            <span class="text-two"><?php echo $wam->lng->language['_SEND_'] ?></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!--form image Section-->
                <div class="loc-block col-lg-6 col-md-12 col-sm-12">
                    <img src="images/resource/restaurant.png" alt="">
                </div>
            </div>
        </div>
    </div>

</section>