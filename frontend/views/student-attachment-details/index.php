<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\StudentAttachmentDetails;
use backend\models\StaffDetails;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StudentAttachmentDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Student Attachment Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-attachment-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
        $stu_model = StudentAttachmentDetails::find()
                    ->where(['is_assessed'=>'no', 'createdBy' => Yii::$app->user->identity->id])
                    ->one();
         if ( (count($stu_model) != 0 ) && ($stu_model->allocated_staff_id != 'no')  ) {
             //not assed. Show details of assessor

            $staf_det = StaffDetails::find()
                            ->where(['staff_id'=> $stu_model->allocated_staff_id ])
                            ->one();
            echo "You are to supervised by: ".$staf_det->first_name." ".$staf_det->middle_name." Phone Number : ".$staf_det->phone_number;
         }

         
     ?>

    <p>
        <?= Html::a('Add Student Attachment Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'rowOptions' => function($model){
               if($model ->is_assessed == 'no'){
                return ['class' =>'danger'];
                  }
                 
                },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'createdBy',
            //'reg_no',
            'county_attached',
            'closest_town',
            'company_attached',
            // 'location_description:ntext',
             'company_phone_number',
             'is_assessed',
             // 'department_id',
              'allocated_staff_id',
        
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
