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
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- login page start-->
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card">
                <div>
                    <div><a class="logo" href="<?= Yii::$app->urlManager->createUrl(['/site/index'])?>">
                            <img class="img-fluid for-light" src="/cuba/assets/images/logo/login.png" alt="looginpage">
                            <img class="img-fluid for-dark" src="/cuba/assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
                    <div class="login-main">
                            <?php $form = \yii\widgets\ActiveForm::begin(['options'=>['class'=>'theme-form']])?>
                            <h4>Tizimga kirish</h4>
                            <p>Login va parolingizni kiritib kirish tugmasini bosing</p>
                            <div class="form-group">
                                <label class="col-form-label">Login</label>
                                <input class="form-control" type="text" name="LoginForm[username]" required="" placeholder="Loginingizni kiriting">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Parol</label>
                                <div class="form-input position-relative">
                                    <input class="form-control" type="password" name="LoginForm[password]" required="" placeholder="*********">
                                    <div class="show-hide"><span class="show"></span></div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox p-0">
                                    <input id="checkbox1" name="LoginForm[rememberMe]" type="checkbox">
                                    <label class="text-muted" for="checkbox1">Parolni eslab qolish</label>
                                </div>
                                <div class="text-end mt-3">
                                    <button class="btn btn-primary btn-block w-100" type="submit">Kirish</button>
                                </div>
                            </div>
                            <?php \yii\widgets\ActiveForm::end()?>
                            <p class="mt-4 mb-0 text-center">Saytda ro`yhatdan o'tganmisiz?<a class="ms-2" href="#">Ro'yhatdan o'tish</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
