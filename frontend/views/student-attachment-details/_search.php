<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentAttachmentDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-attachment-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'createdBy') ?>

    <?= $form->field($model, 'reg_no') ?>

    <?= $form->field($model, 'county_attached') ?>

    <?= $form->field($model, 'closest_town') ?>

    <?= $form->field($model, 'company_attached') ?>

    <?php // echo $form->field($model, 'company_phone_number') ?>

    <?php // echo $form->field($model, 'is_assessed') ?>

    <?php // echo $form->field($model, 'location_description') ?>

    <?php // echo $form->field($model, 'department_id') ?>

    <?php // echo $form->field($model, 'allocated_staff_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
