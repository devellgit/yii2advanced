<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/jquery.loadingModal.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'
    ];
    public $js = [
        'js/ajax-modal-popup.js',
        'js/jquery.loadingModal.min.js',
        'js/mascaras.js',
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyA6Wz2SwRFLAEZJlzsSczhp07istHAdUlA&libraries=places',
        'js/jquery.geocomplete.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}
