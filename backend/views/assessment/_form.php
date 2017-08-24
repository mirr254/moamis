<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\arrayHelper;
use backend\models\Department;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\Assessment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assessment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $depart_data = Department::find()->all();
          $depart_data = ArrayHelper::map( $depart_data, 'department_id','department_name');
     ?>


    <div class="row">
        <div class="col-md-6">

          <div class="box box-danger">
            
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
              <div class="form-group">
              
               <?= $form->field($model,'department_id')->widget(Select2::classname(),[
                 'data' =>$depart_data,
                 'options'=>['placeholder' => 'Select department to assess', 'id'=>'select2-departs',
                               'label'=>'Departments']
                  ]);
                ?>  

          
              <?= $form->field($model,'student_reg_number')->widget(DepDrop::classname(), [ 
                        'type'=>DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                        'depends'=>['select2-departs'], // the id for faculty_id attribute
                        'placeholder'=>'Select student to assess...',
                        'url'=> Url::to(['assessment/subcat'])  
                        ]
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
            <?= $form->field($model, 'staff_id')->textInput(['maxlength' => true,'readOnly'=> true, 'value'=> Yii::$app->user->identity->username]) ?>

             
            <?= $form->field($model, 'date_of_assessment')->widget(DatePicker::classname(),
                  [
                    'options' => ['placeholder' => 'Date of Assessment ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-dd-mm',
                        'autoclose'=>true
                    ]
                  ]); ?>
           

            <?= $form->field($model, 'points_awarded')->textInput() ?>

    </div>
            <!-- /.box-body -->
          <!-- /.box -->
          </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
