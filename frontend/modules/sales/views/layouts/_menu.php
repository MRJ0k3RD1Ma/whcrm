<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="<?= Yii::$app->urlManager->createUrl(['/sales'])?>"><img class="img-fluid for-light" src="/cuba/assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark" src="/cuba/assets/images/logo/logo_dark.png" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="<?= Yii::$app->urlManager->createUrl(['/sales'])?>"><img class="img-fluid" src="/cuba/assets/images/logo/logo-icon.png" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="<?= Yii::$app->urlManager->createUrl(['/sales'])?>" style="float: left"><img class="img-fluid" src="/cuba/assets/images/logo/logo-icon.png" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/sales/order'])?>"><i data-feather="shopping-cart"></i><span>Буюртмалар</span></a></li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i class="fa fa-money"></i><span class="lan-6">Тўловлар</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/sales/default/debt'])?>">Қарздорлик</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/sales/order-paid'])?>">Тўловлар</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/sales/sale'])?>"><i class="fa fa-bar-chart"> </i><span>Ҳисоботлар</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="layers"></i><span class="lan-6">Мижозлар</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/sales/c-legal'])?>">Мижозлар</a></li>
                            <li><a href="#">Лидлар</a></li>
                        </ul>
                    </li>



                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->