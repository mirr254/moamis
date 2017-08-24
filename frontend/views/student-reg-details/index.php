<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StudentRegDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Student Reg Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-reg-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Student Reg Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'user_id',
            'first_name',
            'middle_name',
           // 'last_name',
            'department_id',
             'reg_no',
             'phone_number',
             'year_of_study',
            // 'current_semester',
            // 'course',
             'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
