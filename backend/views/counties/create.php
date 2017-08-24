<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Counties */

$this->title = 'Create Counties';
$this->params['breadcrumbs'][] = ['label' => 'Counties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counties-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
