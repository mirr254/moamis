<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use backend\models\Faculties;
use yii\helpers\arrayHelper;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Departments */ 
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form">

	<?php Pjax::begin() ?>
    <?php $form = ActiveForm::begin(['type'=> ActiveForm::TYPE_VERTICAL]); ?>

    <?php
        $facultiesData = Faculties::find()->all();
        $facultiesData = ArrayHelper::map( $facultiesData, 'faculty_id','faculty_name' );       

     ?>

    

    <?=  $form->field($model, 'faculty_id')->widget(Select2::classname(), [
        'data' => $facultiesData,
        'language' => 'en',
        'options' => ['placeholder' => 'Select faculty name ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
     ]); 
  ?>


    <?= $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>

</div>
