<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal; 
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FacultiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faculties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faculties-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?> 

    <p>
        <?= Html::button('Create Faculties', ['value'=>Url::to('index.php?r=faculties/create'), 'class' => 'btn btn-success showModalButton', 
        'title' => 'Creating New Faculty']) ?>
    </p>

    
<?php Pjax::begin(['id'=>'faculties_grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'faculty_name',
            'faculty_id',
            'faculty_initials',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
