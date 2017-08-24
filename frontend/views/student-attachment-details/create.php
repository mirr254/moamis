<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\StudentAttachmentDetails */

$this->title = 'Create Student Attachment Details';
$this->params['breadcrumbs'][] = ['label' => 'Student Attachment Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-attachment-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
