<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StaffDetails */

$this->title = 'Update Staff Details: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Staff Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="staff-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
