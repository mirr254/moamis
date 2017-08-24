<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Faculties;
use backend\models\Department;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentRegDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-reg-details-form">

    <?php $form = ActiveForm::begin(['id'=>'reg-details-form']); ?>

    <?php
        $faculties_data = Faculties::find()->all();
        $faculties_data = ArrayHelper::map( $faculties_data, 'faculty_id','faculty_name' );

        
     ?>
    <div class="row">
            <div class="col-md-6">

              <div class="box box-danger">
               
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'last_name')->textInput() ?>

                 <?= $form->field($model, 'phone_number')->textInput() ?>

                <?= Select2::widget([
                  'name' =>'faculty_id',
                  'value'=>'',
                  'data' =>$faculties_data,
                  'options'=>['placeholder' => 'Select faculty', 'id'=>'select2-faculties',
                               'label'=>'Faculty']
                  ]);
                  ?>                

                <?= $form->field($model,'department_id')->widget(DepDrop::classname(), [ 
                        //'type'=>DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                        'depends'=>['select2-faculties'], // the id for faculty_id attribute
                        'placeholder'=>'Select department...',
                        'url'=> Url::to(['student-reg-details/subcat'])  
                        ]
                    ]); 
                  ?>
                
                </div><!-- /.box -->
           </div><!-- /.col (left) -->

           <div class="col-md-6">
              <div class="box box-primary">
                

                <?= $form->field($model, 'reg_no')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'year_of_study')->dropDownList([ 'one' => 'One', 'two' => 'Two', 'three' => 'Three', 'four' => 'Four', ], ['prompt' => '']) ?>

                <?= $form->field($model, 'current_semester')->dropDownList([ 1 => '1', 2 => '2', ], ['prompt' => '']) ?>

                <?= $form->field($model, 'course')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>




            </div><!-- /.box -->
            </div><!-- /.col (right) -->
         </div><!-- /.row --> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
