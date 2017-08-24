<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\LogBook */

$this->title = 'Create Log Book';
$this->params['breadcrumbs'][] = ['label' => 'Log Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
