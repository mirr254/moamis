<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\LogBook */

$this->title = $model->record_no;
$this->params['breadcrumbs'][] = ['label' => 'Log Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->record_no], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->record_no], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'student_reg_no',           
            'week_number',            
            'date_to',
            'day',
            'tasks_done',
            'record_no',            
        ],
    ]) ?>

</div>
