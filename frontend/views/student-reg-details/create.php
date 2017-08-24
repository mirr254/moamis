<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\StudentRegDetails */

$this->title = 'Create Student Reg Details';
$this->params['breadcrumbs'][] = ['label' => 'Student Reg Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-reg-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
