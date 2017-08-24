<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'MUST attachment MIS';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Hallo!</h1>

        <p class="lead">Welcome to MUST attachment MIS. </p>

         

        <p>
        <a class="btn btn-lg btn-success" href="<?= Yii::$app->urlManagerBackend->createAbsoluteUrl(['site/index']); ?>">Go to Staff Portal</a>
        </p>

        <p><a class="btn btn-lg btn-success" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['site/frontend-index']); ?>">Go to Students Portal</a></p>
    </div>

</div>
