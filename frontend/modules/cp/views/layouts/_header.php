<div class="page-header">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="<?= Yii::$app->urlManager->createUrl(['/cp/'])?>"><img class="img-fluid" src="/cuba/assets/images/logo/logo.png" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
        </div>

        <div class="nav-right col-12 pull-right right-header p-0">
            <ul class="nav-menus pull-right">
                <li><span class="header-search"><i data-feather="search"></i></span></li>

                <li class="profile-nav onhover-dropdown p-0 me-0">
                    <div class="media profile-media"><img class="b-r-10" src="/cuba/assets/images/dashboard/profile.jpg" alt="">
                        <div class="media-body"><span><?= Yii::$app->user->identity->name?></span>
                            <p class="mb-0 font-roboto"><?= Yii::$app->user->identity->role->name ?> <i class="middle fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li><a href="#"><i data-feather="user"></i><span>Аккоунт </span></a></li>
                        <li><a href="#"><i data-feather="settings"></i><span>Созламалар</span></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/logout'])?>" data-method="post"><i data-feather="log-in"> </i><span>Чиқиш</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</div>