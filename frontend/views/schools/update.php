<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Schools */

$this->title = 'Update Schools: ' . $model->school_id;
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->school_id, 'url' => ['view', 'id' => $model->school_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="schools-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
