<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <a class="logo" href="#">
                <b>
                    <img src="/plugins/images/admin-logo.png" alt="home" class="dark-logo" />
                    <img src="/plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
                </b>
                <span class="hidden-xs">
                    <img src="/plugins/images/admin-text.png" alt="home" class="dark-logo" />
                    <img src="/plugins/images/admin-text-dark.png" alt="home" class="light-logo" />
                </span>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-left">
            <li>
                <a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs">
                    <i class="ti-close ti-menu"></i>
                </a>
            </li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    <img src="/files/avatars/<?php echo $user->avatar; ?>" alt="user-img" width="36" class="img-circle">
                    <b class="hidden-xs"><?php echo $user->lastname; ?></b>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-img"><img src="/files/avatars/<?php echo $user->avatar; ?>" alt="user" />
                            </div>
                            <div class="u-text">
                                <h4><?php echo $user->name ?> <?php echo $user->lastname ?></h4>
                                <p class="text-muted"><?php echo $user->email ?></p>
                                <a href="/profile" class="btn btn-rounded btn-danger btn-sm CPB">View Profile</a>
                            </div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/profile" class="CPB"><i class="ti-user"></i> الملف الشخصي</a></li>
                    <li><a href="/logout"><i class="fa fa-power-off"></i> تسجيل الخروج</a></li>
                </ul>
            </li>
            <li class="nav-ite">
                <a href="#" onclick="window.startScanning();">
                    <i class="fa fa-qrcode"></i>
                </a>
            </li>
            <li class="nav-ite">
                <a href="#" class="right-side-toggle-button">
                    <i class="ti-world"></i>
                    <div class="notifyEL"><span class="heartbit"></span><span class="point"></span></div>
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span></h3>
        </div>
        <ul class="nav" id="side-menu">
            <li class="user-pro">
                <a href="#profile" class="waves-effect">
                    <img src="/files/avatars/<?php echo $user->avatar; ?>" alt="user-img" class="img-circle">
                    <span class="hide-menu"> <?php echo $user->name ?>
                        <?php echo $user->lastname ?>
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                    <li>
                        <a href="/profile" class="CPB">
                            <i class="ti-user"></i>
                            <span class="hide-menu">الملف الشخصي</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="devider"></li>
            <li>
                <a href="/slider" class="waves-effect CPB">
                    <span class="hide-menu">السلايدر</span>
                </a>
            </li>
            <li>
                <a href="/products" class="waves-effect CPB">
                    <span class="hide-menu">المنتجات</span>
                </a>
            </li>
            <!-- <li>
                <a href="/works" class="waves-effect CPB">
                    <span class="hide-menu">أعمالنا</span>
                </a>
            </li>
            <li>
                <a href="/statistics" class="waves-effect CPB">
                    <span class="hide-menu">الإحصائيات</span>
                </a>
            </li>
            <li>
                <a href="/blog" class="waves-effect CPB">
                    <span class="hide-menu">المدونة</span>
                </a>
            </li>
            <li>
                <a href="/partners" class="waves-effect CPB">
                    <span class="hide-menu">شركاؤنا</span>
                </a>
            </li> -->
            <li>
                <a href="/employees" class="waves-effect CPB">
                    <span class="hide-menu">الموظفين</span>
                </a>
            </li>
            <li class="devider"></li>
            <li>
                <a href="/logout" class="waves-effect">
                    <i class="mdi mdi-logout fa-fw"></i>
                    <span class="hide-menu">تسجيل الخروج</span>
                </a>
            </li>
        </ul>
    </div>
</div>