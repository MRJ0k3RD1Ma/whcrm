<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>


<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Body Start-->
    <div class="container-fluid p-0">
        <div class="comingsoon">
            <div class="comingsoon-inner text-center"><img src="/cuba/assets/images/other-images/logo-login.png" alt="">
                <h5>Sayt tez kunda ishga tushadi demo versiyadan foydalanish uchun <b>Tizimga kirish</b> tugmasini bosing</h5>
                <h2><a class="btn btn-primary btn-lg" href="<?= Yii::$app->urlManager->createUrl(['/site/login'])?>">Tizimga kiring</a></h2>
                <h5>Tel: +998999670395</h5>
            </div>
        </div>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
