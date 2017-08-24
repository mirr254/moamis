<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use frontend\models\StudentAttachmentDetails;
use backend\models\StaffDetails;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Page';
$this->params['breadcrumbs'][] = $this->title;

//#######################################################student data ########################################
//grid columns

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'reg_no',
    'county_attached',
    'allocated_staff_id',
    'company_attached',
    // 'location_description:ntext',
     'company_phone_number',
     'is_assessed',   
    //['class' => 'yii\grid\ActionColumn']
];


$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $student_dataProvider,
    'columns' => $gridColumns,
    'target' => ExportMenu::TARGET_BLANK,
    'fontAwesome' => true,
    'pjaxContainerId' => 'kv-pjax-container',
    'dropdownOptions' => [
        'label' => 'Full',
        'class' => 'btn btn-default',
        'itemsBefore' => [
            '<li class="dropdown-header">Export All Data</li>',
        ],
    ],
]);

//#####################################################################################################


//#####################################staff data ####################################################

$staff_gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    ['class' => 'yii\grid\SerialColumn'],

            //'user_id',
            'staff_id',
            'first_name',
            'middle_name',
            'last_name',
            'county_id',
            'phone_number',
            // 'department_id',            
            // 'email:email',
];


$staff_fullExportMenu = ExportMenu::widget([
    'dataProvider' => $student_dataProvider,
    'columns' => $gridColumns,
    'target' => ExportMenu::TARGET_BLANK,
    'fontAwesome' => true,
    'pjaxContainerId' => 'kv-pjax-container',
    'dropdownOptions' => [
        'label' => 'Full',
        'class' => 'btn btn-default',
        'itemsBefore' => [
            '<li class="dropdown-header">Export All Data</li>',
        ],
    ],
]);

//####################################################################################################
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
              $student_details = StudentAttachmentDetails::find()
                                    ->where(['allocated_staff_id'=>'no'])
                                    ->all();
        $num_of_students_not_allocated = count($student_details);
        if($num_of_students_not_allocated != 0){
             echo Html::a('Assign Lecturers To Students', ['assign'], ['class' => 'btn btn-success']);
           }
         ?>
    </p>
</div>


 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">



        <?php echo GridView::widget([
    'dataProvider' => $student_dataProvider,
    'filterModel' => $studentSearchModel,
    'columns' => $gridColumns,
    'pjax' => true,
    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Students on Attachment</h3>',
    ],
    // set a label for default menu
    'export' => [
        'label' => 'Page',
        'fontAwesome' => true,
    ],
    // your toolbar can include the additional full export menu
    'toolbar' => [
        '{export}',
        $fullExportMenu,
        /*['content'=>
            Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                'type'=>'button', 
                'title'=>Yii::t('kvgrid', 'Add Book'), 
                'class'=>'btn btn-success'
            ]) . ' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
                'data-pjax'=>0, 
                'class' => 'btn btn-default', 
                'title'=>Yii::t('kvgrid', 'Reset Grid')
            ])
        ],*/
    ]
  ]);
?>


    </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
<div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">

          <?php echo GridView::widget([
          'dataProvider' => $staff_dataProvider,
          'filterModel' => $staffSearchModel,
          'columns' => $staff_gridColumns,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Lecturers registered</h3>',
          ],
          // set a label for default menu
          'export' => [
              'label' => 'Page',
              'fontAwesome' => true,
          ],
          // your toolbar can include the additional full export menu
          'toolbar' => [
              '{export}',
              $staff_fullExportMenu,
              /*['content'=>
                  Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                      'type'=>'button', 
                      'title'=>Yii::t('kvgrid', 'Add Book'), 
                      'class'=>'btn btn-success'
                  ]) . ' '.
                  Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
                      'data-pjax'=>0, 
                      'class' => 'btn btn-default', 
                      'title'=>Yii::t('kvgrid', 'Reset Grid')
                  ])
              ],*/
          ]
      ]);
?>
     </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


