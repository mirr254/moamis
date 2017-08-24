<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StaffDetails */

$this->title = 'Create Staff Details';
$this->params['breadcrumbs'][] = ['label' => 'Staff Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
