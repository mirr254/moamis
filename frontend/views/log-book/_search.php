<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LogBookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'student_reg_no') ?>

    <?= $form->field($model, 'faculty_id') ?>

    <?= $form->field($model, 'department_id') ?>

    <?= $form->field($model, 'week_number') ?>

    <?php // echo $form->field($model, 'date_from') ?>

    <?php // echo $form->field($model, 'date_to') ?>

    <?php // echo $form->field($model, 'day') ?>

    <?php // echo $form->field($model, 'tasks_done') ?>

    <?php // echo $form->field($model, 'record_no') ?>

    <?php // echo $form->field($model, 'day_overdue') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
