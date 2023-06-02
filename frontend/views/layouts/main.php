<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\FrontAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

FrontAsset::register($this);
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



<!-- start preloader area -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="line line-1"></div>
        <div class="line line-2"></div>
        <div class="line line-3"></div>
        <div class="line line-4"></div>
        <div class="line line-5"></div>
    </div>
</div>
<!-- end preloader area -->


<!-- start top-tp button area -->
<button class="top-btn">
    <i class="fas fa-chevron-up"></i>
</button>
<!-- end top-tp button area -->

<!-- start header area -->
<header>
    <!-- start menubar area -->
    <section class="menubar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="menu-bg">
                        <nav class="navbar p-0">
                            <a class="navbar-brand p-0" href="/">
                                <img src="/logo.png" alt="Logo" style="width: 200px;" />
                            </a>
                            <div class="header-menu position-static">
                                <ul class="menu">
                                    <li class="active">
                                        <a href="/">Bosh sahifa</a>
                                    </li>
                                    <li><a href="#">Biz haqimizda</a></li>
                                    <li>
                                        <a href="#">Xizmatlar</a>
                                        <ul>
                                            <li><a href="#">Ishlab chiqarish</a></li>
                                            <li><a href="#">Qurilish</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Qilingan ishlar</a>
                                    </li>
                                    <li>
                                        <a href="#">Yangiliklar</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="right-part">
                                <a href="<?= Yii::$app->urlManager->createUrl(['/site/login'])?>" class="button-style">Kirish <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end menubar area -->
</header>
<!-- end header area -->


<?= $content?>



<!-- start footer area -->
<footer data-img="/front/assets/images/footer-bg.jpg">
    <!-- start footer-top area -->
    <section class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="content">
                        <div class="title">
                            <h5>get in touch</h5>
                        </div>
                        <ul class="address">
                            <li class="d-flex align-items-center">
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <p>(800) 123 456 789</p>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <p>+1 800 123 4567</p>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="icon">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <p> example@mail.com</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="content">
                        <div class="title">
                            <h5>about us</h5>
                        </div>
                        <ul class="links">
                            <li><a href="blog.html"><p>blog & articles</p></a></li>
                            <li><a href="service-detail.html"><p>exterior</p></a></li>
                            <li><a href="service-detail.html"><p>industrial</p></a></li>
                            <li><a href="service-detail.html"><p>residential</p></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="content">
                        <div class="title">
                            <h5>working hours</h5>
                        </div>
                        <div class="time-slider swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <ul class="times">
                                        <li>
                                            <p>monday</p>
                                            <p>10:00 - 11:00</p>
                                        </li>
                                        <li>
                                            <p>tuesday</p>
                                            <p>09:00 - 12:00</p>
                                        </li>
                                        <li>
                                            <p>thusrday</p>
                                            <p>10:30 - 11:30</p>
                                        </li>
                                        <li>
                                            <p>sunday</p>
                                            <p>10:00 - 11:00</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="swiper-slide">
                                    <ul class="times">
                                        <li>
                                            <p>monday</p>
                                            <p>10:00 - 11:00</p>
                                        </li>
                                        <li>
                                            <p>tuesday</p>
                                            <p>09:00 - 12:00</p>
                                        </li>
                                        <li>
                                            <p>thusrday</p>
                                            <p>10:30 - 11:30</p>
                                        </li>
                                        <li>
                                            <p>sunday</p>
                                            <p>10:00 - 11:00</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6">
                    <div class="content newsletter">
                        <div class="title">
                            <h5>newsletter</h5>
                        </div>
                        <p>Fill their seed open meat. Sea you great Saw image stl</p>
                        <div class="form-area">
                            <input type="email" placeholder="email address" class="inputs">
                            <button type="submit">subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end footer-top area -->

    <!-- start footer-bottom area -->
    <section class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg">
                        <div class="row">
                            <div class="col-lg-6">
                                <p>Copyright &copy; 2021, Themes-Land All Rights Reserved.</p>
                            </div>
                            <div class="col-lg-6">
                                <ul class="d-flex justify-content-end">
                                    <li><a href="about.html">about us</a></li>
                                    <li><a href="service.html">service</a></li>
                                    <li><a href="#!">privacy policy</a></li>
                                    <li><a href="contact.html">contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end footer-bottom area -->
</footer>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
