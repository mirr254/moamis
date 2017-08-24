<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentRegDetails */

$this->title = 'Update Student Reg Details: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Student Reg Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-reg-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
