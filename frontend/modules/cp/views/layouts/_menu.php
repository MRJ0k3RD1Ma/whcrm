<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="<?= Yii::$app->urlManager->createUrl(['/cp'])?>"><img class="img-fluid for-light" src="/cuba/assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark" src="/cuba/assets/images/logo/logo_dark.png" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="<?= Yii::$app->urlManager->createUrl(['/cp'])?>"><img class="img-fluid" src="/cuba/assets/images/logo/logo-icon.png" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="<?= Yii::$app->urlManager->createUrl(['/cp'])?>" style="float: left"><img class="img-fluid" src="/cuba/assets/images/logo/logo-icon.png" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/cp/made'])?>"><i class="fa fa-bar-chart"> </i><span>Ишлаб чиқариш</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="box"></i><span class="lan-6">Маҳсулотлар</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/product'])?>">Маҳсулотлар</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/category'])?>">Категориялар</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/unit'])?>">Бирликлар</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="layers"></i><span class="lan-6">Мижозлар</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/c-legal'])?>">Мижозлар</a></li>
                            <li><a href="#">Лидлар</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="truck"></i><span class="lan-6">Етказувчилар</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/supplier'])?>">Етказиб берувчилар</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/deliverable'])?>">Маҳсулотлар</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="shopping-cart"></i><span class="lan-6">Буюртмалар</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="#">Буюртмалар</a></li>
                            <li><a href="#">Қарздорлик</a></li>
                            <li><a href="#">Тўловлар</a></li>
                        </ul>
                    </li>


                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="dollar-sign"></i><span class="lan-6">Харажатлар</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="#">Маҳсулот харажатномаси</a></li>
                            <li><a href="#">Ойлик маошлар</a></li>
                            <li><a href="#">Бошқа харажатлар</a></li>
                            <li><a href="#">Кирим/чиқим статистикаси</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="archive"></i><span class="lan-6">Omborxona</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/warehouse'])?>">Омборхоналар</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/come'])?>">Кирим</a></li>
                            <li><a href="#">Чиқим</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/cp/bank'])?>"><i class="fa fa-bank"> </i><span>Банклар</span></a></li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/cp/user'])?>"><i data-feather="users"> </i><span>Фойдаланувчилар</span></a></li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->