<html>
<head>
    <title>360 Virtual Tour PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Alrawi 360"/>
    <meta charset="UTF-8">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link href="/sources/css/owl.carousel.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/sources/css/style.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/sources/css/animate.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/sources/css/loaders.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/sources/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/sources/js/jquery-1.12.2.min.js"></script>
    <script>
        /* If you want to stop starting auto scroll panorama  just change 'false' value below. */
        var autoScrol = true;
    </script>
</head>
<body>
<input id="photosId" type="hidden" value="<?php echo $dir2; ?>">
<div class="panorama-body">
    <div id="panorama">
        <div id="pan-canvas"></div>
        <div class="panos-menu">
            <div id="panos-list">
                <ul id="menu-show">
                    <div class="menu-centered">
                        <div class="owl-carousel">

                        </div>
                    </div>
                </ul>

                <div class="pan-description"></div>
                <i id="rotate" class="menu-button fa fa-chevron-down" aria-hidden="true"></i>
                <span id="fullScreenMode" >
                    <span id="fullscreenPan">
                        <img id="fullscreen-icon" src="/sources/img/fullscreen.png">
                    </span>
                </span>
                <div id="loader-pan" class="fadeInLeft animated">
                    <div class="wrapper">
                        <div class="cssload-loader"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="loader-wrapper">
            <div class="first-wrapper">
                <div class="first-cssload-loader"></div>
            </div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
    </div>
    <div class="top_buttons"></div>

    <div class="keys">
        <div class="zoom_conrol">
            <span id="zoom_in"><img class="zoom" src="/sources/img/zoom-in.png"></span>
            <span id="zoom_out"><img class="zoom" src="/sources/img/zoom-out.png"></span>
        </div>

        <div class="control-key">
            <img class="control_keys" id="left_key" src="/sources/img/left_button.PNG">
            <img class="control_keys" id="right_key" src="/sources/img/right_button.PNG">
            <img class="control_keys" id="up_key" src="/sources/img/up_button.PNG">
            <img class="control_keys" id="down_key" src="/sources/img/down_button.PNG">
            <img class="control_keys" id="elipse_key" src="/sources/img/elipse.PNG">
        </div>
    </div>

    <script src="/sources/js/three.min.js"></script>
    <script src="/sources/js/jquery.fullscreen.js"></script>
    <script src="/sources/js/DeviceOrientationControls.js"></script>
    <script src="/sources/js/mousehold.js"></script>
    <script src="/sources/js/owl.carousel.min.js"></script>
    <script src="/sources/js/mousetrap.min.js"></script>
    <script src="/sources/js/jquery.touch.js"></script>
    <script src="/sources/js/360.virtual.tour.js"></script>
</div>
<input id="source-url" type="hidden" value="/sources/">
</body>
</html>
