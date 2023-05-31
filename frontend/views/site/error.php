<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
    <!-- start blog area -->
    <section class="home1 blog p-120" style="padding-top:200px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <h2><?= Html::encode($this->title) ?></h2>
                        <p></p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="alert alert-danger">
                            <?= nl2br(Html::encode($message)) ?>
                        </div>

                        <p>
                            The above error occurred while the Web server was processing your request.
                        </p>
                        <p>
                            Please contact us if you think this is a server error. Thank you.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end blog area -->



