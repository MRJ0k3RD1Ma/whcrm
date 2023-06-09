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


                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/store/warehouse'])?>"><i data-feather="archive"> </i><span>Омборхоналар</span></a></li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/store/come'])?>"><i class="fa fa-book"> </i><span>Кирим</span></a></li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/store/default/outlay'])?>"><i class="fa fa-folder-open-o"> </i><span>Чиқим</span></a></li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/store/sale'])?>"><i class="fa fa-dollar"> </i><span>Сотув</span></a></li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->