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

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="box"></i><span class="lan-6">Mahsulotlar</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/product'])?>">Mahsulotlar</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/category'])?>">Kategoriyalar</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/unit'])?>">Birliklar</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="layers"></i><span class="lan-6">Mijozlar</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/c-individual'])?>">Jismoniy shaxslar</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/c-legal'])?>">Yuridik shaxslar</a></li>
                            <li><a href="#">Lidlar</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="truck"></i><span class="lan-6">Yetkazuvchilar</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/supplier'])?>">Mahsulot yetkazuvchilar</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/deliverable'])?>">Mahsulotlar</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="shopping-cart"></i><span class="lan-6">Buyurtmalar</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="#">Buyurtmalar</a></li>
                            <li><a href="#">Qarzdorlik</a></li>
                            <li><a href="#">To`lovlar</a></li>
                        </ul>
                    </li>


                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="dollar-sign"></i><span class="lan-6">Xarajatlar</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="#">Mahsulot xarajatnomasi</a></li>
                            <li><a href="#">Oylik maoshlar</a></li>
                            <li><a href="#">Boshqa xarajatlar</a></li>
                            <li><a href="#">Kirim/chiqim statistikasi</a></li>
                        </ul>
                    </li>


                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/cp/warehouse'])?>"><i data-feather="archive"> </i><span>Omborxona</span></a></li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/cp/bank'])?>"><i class="fa fa-bank"> </i><span>Banklar</span></a></li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= Yii::$app->urlManager->createUrl(['/cp/user'])?>"><i data-feather="users"> </i><span>Foydalanuvchilar</span></a></li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->