<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Department;
use backend\models\Counties;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\StaffDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $depart_data = Department::find()->all();
        $depart_data = ArrayHelper::map( $depart_data, 'faculty_id','department_name' );

        $county_data = Counties::find()->all();
        $county_data = ArrayHelper::map( $county_data, 'county_id', 'county_name' );

        
     ?>

    <div class="row">
        <div class="col-md-6">

          <div class="box box-danger">
            
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
              <div class="form-group">

            <?= $form->field($model, 'staff_id')->textInput() ?>

            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

             <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

        </div>
              <!-- /.form group -->
           </div>
            <!-- /.box-body -->
           </div>
          </div>
          <!-- /.box -->

          <!-- /.col (left) -->

          <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-body">

         <?= $form->field($model, 'county_id')->widget(Select2::classname(),[ 
                  'name' =>'county_di',
                  'value'=>'',
                  'data' =>$county_data,
                  'options'=>['placeholder' => 'Select county', 'id'=>'select2-countyid',
                               'label'=>'County']
              ]); 
            ?>

            <?= $form->field($model, 'department_id')->widget(Select2::classname(),[ 
                  'name' =>'department_id',
                  'value'=>'',
                  'data' =>$depart_data,
                  'options'=>['placeholder' => 'Select Department', 'id'=>'select2-deps',
                               'label'=>'Department']
              ]); 
            ?>

             

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

            </div>
            <!-- /.box-body -->
          <!-- /.box -->
          </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
