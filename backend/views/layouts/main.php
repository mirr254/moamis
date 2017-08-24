<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'MOAMIS',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        //['label' => 'Assessment', 'url' => ['/assessment/index']],
        /*['label' => 'Faculty Details', 'url' => ['/faculties/index']],
        ['label' => 'Department Details', 'url' => ['/department/index']],*/
        
    ];
    /*if lecturer logs in, show the assessment link*/
    if (Yii::$app->user->can('lecturer')) {
        $menuItems[] =['label' => 'Assessments', 'url' => ['/assessment/index']];    
    
    }

    if (Yii::$app->user->can('permision_admin')) {
       $menuItems =[
              ['label' => 'All Records', 'url' => ['/admin/index']],
              ['label' => 'Faculty Details', 'url' => ['/faculties/index']],
              ['label' => 'Department Details', 'url' => ['/department/index']],
              ['label' => 'Assign Permisions', 'url' => ['/admins/assignment']],

       ];
    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Register', 'url' => ['/staff-details/create']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];

    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; MAOS <?= date('Y') ?></p>

      
    </div>
</footer>

<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    //'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

