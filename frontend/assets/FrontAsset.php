<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class FrontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/front';
    public $css = [
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap',
        'assets/css/all.min.css',
        'assets/css/flaticon.css',
        'assets/css/bootstrap.min.css',
        'assets/css/menu.css',
        'assets/css/venobox.css',
        'assets/css/magnific-popup.css',
        'assets/css/swiper-bundle.min.css',
        'assets/css/animate.css',
        'assets/css/style.css',
        'assets/css/responsive.css',
    ];
    public $js = [
//        'assets/js/jquery-3.4.1.min.js',
        'assets/js/bootstrap.bundle.min.js',
        'assets/js/menu.min.js',
        'assets/js/venobox.min.js',
        'assets/js/jquery.magnific-popup.min.js',
        'assets/js/mixitup.min.js',
        'assets/js/swiper-bundle.min.js',
        'assets/js/waypoint.js',
        'assets/js/jquery.counterup.min.js',
        'assets/js/wow.min.js',
        "https://maps.googleapis.com/maps/api/js?key=AIzaSyCjkssBA3hMeFtClgslO2clWFR6bRraGz0",
        'assets/js/script.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
