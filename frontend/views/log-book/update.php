<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\LogBook */

$this->title = 'Update Log Book: ' . $model->record_no;
$this->params['breadcrumbs'][] = ['label' => 'Log Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->record_no, 'url' => ['view', 'id' => $model->record_no]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="log-book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
