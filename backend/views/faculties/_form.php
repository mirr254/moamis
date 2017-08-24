<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Faculties */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faculties-form">

<?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin([
        'id' => 'faculties_fid',
        'action' => ['create'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        
       ]); ?>

    <?= $form->field($model, 'faculty_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'faculty_initials')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  <?php Pjax::end(); ?>

</div>
   
	
	