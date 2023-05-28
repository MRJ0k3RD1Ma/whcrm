<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-3 risk-col xl-100 box-col-12">
            <div class="card total-users">
                <div class="card-header card-no-border">
                    <h5>Maqsad</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa-spin fa-cog"></i></li>
                            <li><i class="view-html fa fa-code"></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                            <li><i class="icofont icofont-error close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="apex-chart-container goal-status text-center row">
                        <div class="rate-card col-xl-12">
                            <div class="goal-chart">
                                <div id="riskfactorchart"></div>
                            </div>
                            <div class="goal-end-point">
                                <ul>
                                    <li class="mt-0 pt-0">
                                        <h6 class="font-primary">MUDDAT</h6>
                                        <h6 class="f-w-400"><?= date('d').' '.Yii::$app->params['date'][date('m')].' '.date('Y') ?></h6>
                                    </li>
                                    <li>
                                        <h6 class="mb-2 f-w-400">Belgilangan maqsad</h6>
                                        <h5 class="mb-0">290 000 000 so'm</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <ul class="col-xl-12">
                            <li>
                                <div class="goal-detail">
                                    <h6> <span class="font-primary">Umumiy erishilgan: </span>91 000 000</h6>
                                    <div class="progress sm-progress-bar progress-animate">
                                        <div class="progress-gradient-primary" role="progressbar" style="width: 60%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="goal-detail mb-0">
                                    <h6><span class="font-primary">Oxirgi muddat: </span><?= '31 '.Yii::$app->params['date'][12].' '.date('Y') ?></h6>
                                    <div class="progress sm-progress-bar progress-animate">
                                        <div class="progress-gradient-primary" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="btn-download btn btn-gradient f-w-500">Yuklab olish <span class="text-warning">.xlsx</span> </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-9 xl-100 dashboard-sec box-col-12">
            <div class="card earning-card">
                <div class="card-body p-0">
                    <div class="row m-0">
                        <div class="col-xl-3 earning-content p-0">
                            <div class="row m-0 chart-left">
                                <div class="col-xl-12 p-0 left_side_earning">
                                    <h5>Статистикалар</h5>
                                    <p class="font-roboto"><?= Yii::$app->params['date'][date('m')]?> ойдаги тушумлар статистикаси</p>
                                </div>
                                <div class="col-xl-12 p-0 left_side_earning">
                                    <h5><?= intval(\common\models\OrderPaid::find()->where('date like "%'.date('Y-m-').'%"')->sum('price')) ?> сўм </h5>
                                    <p class="font-roboto">Бу ойдаги тушум</p>
                                </div>
                                <div class="col-xl-12 p-0 left_side_earning">
                                    <h5><?= intval(\common\models\Order::find()->where('date like "%'.date('Y-m-').'%"')->count('id'))?></h5>
                                    <p class="font-roboto">Бу ойдаги умумий буюртмалар</p>
                                </div>
                                <div class="col-xl-12 p-0 left_side_earning">
                                    <h5>90%</h5>
                                    <p class="font-roboto">Режага энришилганлик фоизи</p>
                                </div>
                                <div class="col-xl-12 p-0 left-btn"><a class="btn btn-gradient" href="<?= Yii::$app->urlManager->createUrl(['/sales/sale'])?>">Батафсил</a></div>
                            </div>
                        </div>
                        <div class="col-xl-9 p-0">
                            <div class="chart-right">
                                <div class="row m-0 p-tb">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-0">
                                        <div class="inner-top-left">
                                            <ul class="d-flex list-unstyled">
                                                <li class="disabled"><a href="#">Бугун</a></li>
                                                <li><a href="#">Ҳафталик</a></li>
                                                <li><a href="#">Ойлик</a></li>
                                                <li><a href="#">Йиллик</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row border-top m-0">
                                <div class="col-xl-6 ps-0 col-md-6 col-sm-6">
                                    <div class="media p-0">
                                        <div class="media-left bg-success"><i class="icofont icofont-check-alt"></i></div>
                                        <div class="media-body">
                                            <h6>Тасдиқланган тўловлар</h6>
                                            <p><?= intval(\common\models\OrderPaid::find()->where('date like "%'.date('Y-m-').'%"')->andWhere(['status_id'=>3])->sum('price'))?> сўм</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                    <div class="media p-0">
                                        <div class="media-left bg-warning"><i class="icofont icofont-credit-card text-dark"></i></div>
                                        <div class="media-body">
                                            <h6>Тасдиқланмаган тўловлар</h6>
                                            <p><?= intval(\common\models\OrderPaid::find()->where('date like "%'.date('Y-m-').'%"')->andWhere('status_id in (1,2)')->sum('price'))?> сўм</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row border-top m-0" style="border-top:0 solid !important;">
                                <div class="col-xl-6 col-md-12 pe-0">
                                    <div class="media p-0">
                                        <div class="media-left"><i class="icofont icofont-cur-dollar-plus"></i></div>
                                        <div class="media-body">
                                            <h6>Кутилаётган тўловлар</h6>
                                            <p>0 сўм</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12 pe-0">
                                    <div class="media p-0">
                                        <div class="media-left bg-danger"><i class="icofont icofont-warning"></i></div>
                                        <div class="media-body">
                                            <h6>Муддати ўтган тўловлар</h6>
                                            <p>0 сўм</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card offer-box">
                <div class="card-body p-0">
                    <div class="offer-slider">
                        <div class="carousel slide" id="carouselExampleCaptions" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="selling-slide row">
                                        <div class="col-xl-4 col-md-6">
                                            <div class="d-flex">
                                                <div class="left-content">
                                                    <p>1-o'rinda sotilayotgan mahsulot</p>
                                                    <h4 class="f-w-600">Plita</h4><span class="badge badge-white rounded-pill">40% sotuv</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-12">
                                            <div class="center-img"><img class="img-fluid" src="/cuba/assets/images/dashboard-2/offer-shoes-3.png" alt="..."></div>
                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="d-flex">
                                                <div class="right-content">
                                                    <p>1-o'rinda sotilayotgan mahsulot</p>
                                                    <h4 class="f-w-600">Plita</h4><span class="badge badge-white rounded-pill">100 000 so'm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="selling-slide row">
                                        <div class="col-xl-4 col-md-6">
                                            <div class="d-flex">
                                                <div class="left-content">
                                                    <p>2-o'rinda sotilayotgan mahsulot</p>
                                                    <h4 class="f-w-600">Kalodes koltsasi</h4><span class="badge badge-white rounded-pill">28% sotuv</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-12">
                                            <div class="center-img"><img class="img-fluid" src="/cuba/assets/images/dashboard-2/offer-shoes-3.png" alt="..."></div>
                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="d-flex">
                                                <div class="right-content">
                                                    <p>2-o'rinda sotilayotgan mahsulot</p>
                                                    <h4 class="f-w-600">Kalodes koltsasi</h4><span class="badge badge-white rounded-pill">80 000 so'm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="selling-slide row">
                                        <div class="col-xl-4 col-md-6">
                                            <div class="d-flex">
                                                <div class="left-content">
                                                    <p>3-o'rinda sotilayotgan mahsulot</p>
                                                    <h4 class="f-w-600">Truba (100 lik)</h4><span class="badge badge-white rounded-pill">22% sotuv</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-12">
                                            <div class="center-img"><img class="img-fluid" src="/cuba/assets/images/dashboard-2/offer-shoes-3.png" alt="..."></div>
                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="d-flex">
                                                <div class="right-content">
                                                    <p>3-o'rinda sotilayotgan mahsulot</p>
                                                    <h4 class="f-w-600">Truba (100 lik)</h4><span class="badge badge-white rounded-pill">160 000 so'm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
                        </div>
                    </div>
                </div>
            </div>


        </div>



        <div class="col-xl-12 xl-100 chart_data_left box-col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row m-0 chart-main">
                        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                            <div class="media align-items-center">
                                <div class="hospital-small-chart">
                                    <div class="small-bar">
                                        <div class="small-chart flot-chart-container"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="right-chart-content">
                                        <h4><?= \common\models\CLegal::find()->where('created like "%'.date('Y-m-').'%"')->count('*')?></h4><span>Янги мижозлар </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                            <div class="media align-items-center">
                                <div class="hospital-small-chart">
                                    <div class="small-bar">
                                        <div class="small-chart1 flot-chart-container"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="right-chart-content">
                                        <h4>1005</h4><span>Бугун тайёрланган маҳсулотлар</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                            <div class="media align-items-center">
                                <div class="hospital-small-chart">
                                    <div class="small-bar">
                                        <div class="small-chart2 flot-chart-container"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="right-chart-content">
                                        <h4>100</h4><span>Тайёр маҳсулотлар</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                            <div class="media border-none align-items-center">
                                <div class="hospital-small-chart">
                                    <div class="small-bar">
                                        <div class="small-chart3 flot-chart-container"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="right-chart-content">
                                        <h4><?= \common\models\Order::find()->where(['status_id'=>3])->count('id')?></h4><span>Етказишга тайёр буёртмалар</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-6 xl-100">
            <h5>Solishtirma hisobot</h5>
            <p><span class="text-danger"><b>*</b></span> Solishtirma hisobotda ko'rsatilgan davr va undan oldigi davr bilan solishtirilgan!</p>

            <div class="widget-joins card widget-arrow">
                <div class="row">
                    <div class="col-sm-6 pe-0">
                        <div class="media border-after-xs">
                            <div class="align-self-center me-3 text-start"><span class="mb-1">Sotuv</span>
                                <h5 class="mb-0">Bugun</h5>
                            </div>
                            <div class="media-body align-self-center"><i class="font-primary" data-feather="arrow-down"></i></div>
                            <div class="media-body">
                                <h5 class="mb-0"><span class="counter">25698 so'm</span></h5><span class="mb-1">-2658(36%) so'm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 ps-0">
                        <div class="media">
                            <div class="align-self-center me-3 text-start"><span class="mb-1">Sale</span>
                                <h5 class="mb-0">Oylik</h5>
                            </div>
                            <div class="media-body align-self-center"><i class="font-primary" data-feather="arrow-up"></i></div>
                            <div class="media-body ps-2">
                                <h5 class="mb-0"><span class="counter">6954 so'm</span></h5><span class="mb-1">+369(15%) so'm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 pe-0">
                        <div class="media border-after-xs">
                            <div class="align-self-center me-3 text-start"><span class="mb-1">Sotuv</span>
                                <h5 class="mb-0">Haftalik</h5>
                            </div>
                            <div class="media-body align-self-center"><i class="font-primary" data-feather="arrow-up"></i></div>
                            <div class="media-body">
                                <h5 class="mb-0"><span class="counter">63147 so'm</span></h5><span class="mb-1">+69(65%) so'm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 ps-0">
                        <div class="media">
                            <div class="align-self-center me-3 text-start"><span class="mb-1">Sotuv</span>
                                <h5 class="mb-0">Yillik</h5>
                            </div>
                            <div class="media-body align-self-center ps-3"><i class="font-primary" data-feather="arrow-up"></i></div>
                            <div class="media-body ps-2">
                                <h5 class="mb-0"><span class="counter">963198 so'm</span></h5><span class="mb-1">+3654(90%) so'm</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Тўловлар графиги</h5>
                </div>
                <div class="card-body">
                    <div id="mixed-chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div>

        </div>

        <div class="col-xl-6 xl-100">
            <div class="card">
                <div class="card-body">
                    <?= edofre\fullcalendar\Fullcalendar::widget([

                        'events' => [],
                        'clientOptions'=>[
                            'timeFormat'=> 'H:mm',
                        ]

                    ]);
                    ?>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Container-fluid Ends-->


<?php

$this->registerJsFile('/cuba/assets/js/chart/chartist/chartist.js');
$this->registerJsFile('/cuba/assets/js/chart/chartist/chartist-plugin-tooltip.js');
$this->registerJsFile('/cuba/assets/js/chart/knob/knob.min.js');
$this->registerJsFile('/cuba/assets/js/chart/knob/knob-chart.js');
$this->registerJsFile('/cuba/assets/js/chart/apex-chart/apex-chart.js');

$this->registerJsFile('/cuba/assets/js/chart/apex-chart/stock-prices.js');

$this->registerJs("
// Risk factor chart
var options4 = {
    series: [70],
    chart: {
        height: 350,
        type: 'radialBar',
        offsetY: -10,
    },

    plotOptions: {
        radialBar: {
            startAngle: -135,
            endAngle: 135,
            inverseOrder: true,
            hollow: {
                margin: 5,
                size: '60%',
                image: '/cuba/assets/images/dashboard-2/radial-image.png',
                imageWidth: 140,
                imageHeight: 140,
                imageClipped: false,
            },
            track: {
                opacity: 0.4,
                colors: CubaAdminConfig.primary
            },
            dataLabels: {
                enabled: false,
                enabledOnSeries: undefined,
                formatter: function (val, opts) {
                    return val + \"%\"
                },
                textAnchor: 'middle',
                distributed: false,
                offsetX: 0,
                offsetY: 0,

                style: {
                    fontSize: '14px',
                    fontFamily: 'Helvetica, Arial, sans-serif',
                    fill:['#2b2b2b'],

                },
            },
        }
    },

    fill: {
        type: 'gradient',
        gradient: {
            shade: 'light',
            shadeIntensity: 0.15,
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100],
            gradientToColors: ['#a927f9'],
            type: 'horizontal'
        },
    },
    stroke: {
        dashArray: 15,
        strokecolor: ['#ffffff']
    },

    labels: ['Erishilgan natija'],
    colors: [ CubaAdminConfig.primary ],
};
var chart4 = new ApexCharts(document.querySelector(\"#riskfactorchart\"),
    options4
);

chart4.render();
");


$this->registerJs("
      var options = {
    series: [{
        name: \"Tasdiqlangan\",
        type: \"column\",
        data: [124655000,141910000,88400000,0,0,0,0,0,0,0,0,0]
    }, 
    {
    name: \"Muddatli to`lov\", 
    type: \"area\", 
    data: [154350000,171710000,192605000,138165000,83570000,66120000,45440000,22790000,11340000,11340000,11340000,11340000]}],
    chart: {height: 350, type: \"line\", stacked: !1, toolbar: {show: !1}},
    stroke: {width: [0, 1, 1], dashArray: [0, 0, 5], curve: \"smooth\"},
    plotOptions: {bar: {columnWidth: \"18%\"}},
    legend: {show: !1},
    fill: {
        opacity: [.85, .25, 1],
        gradient: {
            inverseColors: !1,
            shade: \"light\",
            type: \"vertical\",
            opacityFrom: .85,
            opacityTo: .55,
            stops: [0, 100, 100, 100]
        }
    },
    labels: [\"Yanvar\",\"Fevral\",\"Mart\",\"Aprel\",\"May\",\"Iyun\",\"Iyul\",\"Avgust\",\"Sentabr\",\"Oktyabr\",\"Noyabr\",\"Dekabr\"],
    markers: {size: 0},
    colors: [\"#7366ff\", \"#f73164\"],
},
    chart = new ApexCharts(document.querySelector(\"#mixed-chart\"), options);
    chart.render();

")
?>