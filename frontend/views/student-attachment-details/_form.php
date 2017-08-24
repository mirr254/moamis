<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentAttachmentDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-attachment-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">

          <div class="box box-danger">
            
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
              <div class="form-group">

               <?= $form->field($model, 'createdBy')->textInput(['value'=>Yii::$app->user->identity->id, 'readonly'=>true]) ?>

              <?= $form->field($model, 'reg_no')->textInput(['maxlength' => true, 'value'=>Yii::$app->user->identity->username, 'readonly'=>true]) ?>

              <?=  $form->field($model, 'county_attached')->widget(Select2::classname(), [
                    'data' => ['Kiambu' => 'Kiambu', 'Nairobi' => 'Nairobi', 'Kitui' => 'Kitui', 'Mombasa' => 'Mombasa', 'Nyeri' => 'Nyeri', 'Meru' => 'Meru', 'Embu' => 'Embu', 'Makueni' => 'Makueni', 'Taita Taveta' => 'Taita Taveta', 'Machakos' => 'Machakos', 'Mandera' => 'Mandera', 'Garissa' => 'Garissa', 'Nakuru' => 'Nakuru', 'Nyamira' => 'Nyamira', 'kakamega' => 'Kakamega', 'Migori' => 'Migori'],
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select county  ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                 ]); 
              ?>
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
    
           <?= $form->field($model, 'closest_town')->textInput(['maxlength' => true]) ?>

           <?= $form->field($model, 'company_attached')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'company_phone_number')->textInput() ?>
           </div>
            <!-- /.box-body -->
          <!-- /.box -->
          </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->

            <?= $form->field($model, 'location_description')->textarea(['rows' => 6]) ?>
            
        
        

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
