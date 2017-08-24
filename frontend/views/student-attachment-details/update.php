<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentAttachmentDetails */

$this->title = 'Update Student Attachment Details: ' . $model->reg_no;
$this->params['breadcrumbs'][] = ['label' => 'Student Attachment Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->reg_no, 'url' => ['view', 'id' => $model->reg_no]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-attachment-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
