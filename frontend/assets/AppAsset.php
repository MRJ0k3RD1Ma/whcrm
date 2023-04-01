<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/cuba';
    public $css = [
        'https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap',
        'https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap',
        'assets/css/font-awesome.css',
        'assets/css/vendors/icofont.css',
        'assets/css/vendors/themify.css',
        'assets/css/vendors/flag-icon.css',
        'assets/css/vendors/feather-icon.css',
        'assets/css/vendors/scrollbar.css',
        'assets/css/vendors/animate.css',
        'assets/css/vendors/chartist.css',
        'assets/css/vendors/select2.css',
        'assets/css/style.css',
        'assets/css/color-1.css',
        'assets/css/responsive.css',
    ];
    public $js = [
        'assets/js/bootstrap/bootstrap.bundle.min.js',
        'assets/js/icons/feather-icon/feather.min.js',
        'assets/js/icons/feather-icon/feather-icon.js',
        'assets/js/scrollbar/simplebar.js',
        'assets/js/select2/select2.full.min.js',
        'assets/js/scrollbar/custom.js',
        'assets/js/config.js',
        'assets/js/sidebar-menu.js',
        'assets/js/notify/bootstrap-notify.min.js',
//        'assets/js/dashboard/default.js',
//        'assets/js/notify/index.js',
//        'assets/js/typeahead/handlebars.js',
//        'assets/js/typeahead/typeahead.bundle.js',
//        'assets/js/typeahead/typeahead.custom.js',
//        'assets/js/typeahead-search/handlebars.js',
//        'assets/js/typeahead-search/typeahead-custom.js',
        'assets/js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
