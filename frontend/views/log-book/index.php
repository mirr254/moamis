<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LogBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log Books';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    //'user_id',
            'student_reg_no',           
            'week_number',             
             'date_to',
             'day',
             'tasks_done',
            // 'record_no',
           
            ['class' => 'yii\grid\ActionColumn'],
];


$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'target' => ExportMenu::TARGET_BLANK,
    'fontAwesome' => true,
    'pjaxContainerId' => 'kv-pjax-container',
    'dropdownOptions' => [
        'label' => 'Full',
        'class' => 'btn btn-default',
        'itemsBefore' => [
            '<li class="dropdown-header">Export All Data</li>',
        ],
    ],
]);

?>
<div class="log-book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Log Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'pjax' => true,
    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>Attachment Daily tasks records</h3>',
    ],
    // set a label for default menu
    'export' => [
        'label' => 'Page',
        'fontAwesome' => true,
    ],
    // your toolbar can include the additional full export menu
    'toolbar' => [
        '{export}',
        $fullExportMenu,
        /*['content'=>
            Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                'type'=>'button', 
                'title'=>Yii::t('kvgrid', 'Add Book'), 
                'class'=>'btn btn-success'
            ]) . ' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
                'data-pjax'=>0, 
                'class' => 'btn btn-default', 
                'title'=>Yii::t('kvgrid', 'Reset Grid')
            ])
        ],*/
    ]
  ]);
?>

</div>
