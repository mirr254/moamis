<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Faculties */

$this->title = 'Update Faculties: ' . $model->faculty_id;
$this->params['breadcrumbs'][] = ['label' => 'Faculties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->faculty_id, 'url' => ['view', 'id' => $model->faculty_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="faculties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
