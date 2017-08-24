<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Counties */

$this->title = 'Update Counties: ' . $model->county_id;
$this->params['breadcrumbs'][] = ['label' => 'Counties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->county_id, 'url' => ['view', 'id' => $model->county_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="counties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
