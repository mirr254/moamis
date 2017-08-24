<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Assessment */

$this->title = 'Update Assessment: ' . $model->assessment_no;
$this->params['breadcrumbs'][] = ['label' => 'Assessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->assessment_no, 'url' => ['view', 'id' => $model->assessment_no]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assessment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
