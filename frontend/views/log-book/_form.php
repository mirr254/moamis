<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\LogBook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-book-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">

          <div class="box box-danger">
            
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
              <div class="form-group">

            <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id, 'readonly'=>true])->label(false) ?>

            <?= $form->field($model, 'student_reg_no')->hiddenInput(['maxlength' => true, 'value'=>Yii::$app->user->identity->username, 'readonly'=>true])->label(false) ?>

            <?=  $form->field($model, 'week_number')->widget(Select2::classname(), [
                    'data' => [ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 12 => '12'],
                    'language' => 'en',
                    'options' => ['placeholder' => 'Week number...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                 ]); 
              ?>

          
            <?= $form->field($model, 'date_to')->widget(DatePicker::classname(),
                  [
                    'options' => ['placeholder' => 'Week Ending ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose'=>true
                    ]
                  ]); ?>

             <?=  $form->field($model, 'day')->widget(Select2::classname(), [
                                'data' => [ 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday'],
                                'language' => 'en',
                                'options' => ['placeholder' => 'Select day of the week ...'],
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

               

                <?= $form->field($model, 'tasks_done')->textarea(['rows' => 12]) ?>

                
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
