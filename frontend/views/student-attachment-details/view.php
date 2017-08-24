<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentAttachmentDetails */

$this->title = $model->reg_no;
$this->params['breadcrumbs'][] = ['label' => 'Student Attachment Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-attachment-details-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->reg_no], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->reg_no], [
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
            'createdBy',
            'reg_no',
            'county_attached',
            'closest_town',
            'company_attached',
            'company_phone_number',
            'is_assessed',
            'location_description:ntext',
            'department_id',
            'allocated_staff_id',
        ],
    ]) ?>

</div>
