<?php

use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\TodoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Todos';
$this->params['breadcrumbs'][] = ['label'=>$this->title,  'url'=>['/todo/index']];
?>
<div class="todo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Todo', ['create'], ['class' => 'btn btn-success']) ?>
        <?= \yii\bootstrap\ButtonGroup::widget([
            'buttons' => [
                Html::a('сегодня', ['todo/index',  'TodoSearch[timestamp]' => 'day']),
                Html::a('неделя', ['todo/index', 'TodoSearch[timestamp]' => 'week']),
                Html::a('все', ['todo/index', ]),
            ]
        ]); ?>
    </p>
<?=implode('&ndash;',  [!empty($searchModel->startTime)?date('d.m.Y:H:i:s', $searchModel->startTime ):'' ,!empty($searchModel->endTime)?date('d.m.Y:H:i:s', $searchModel->endTime ):'' ])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['label'=>'день недели',  'value'=> /**
             * @param $model \app\models\Todo
             * @param $key
             * @return mixed
             */
                function($model, $key){return \yii\helpers\ArrayHelper::getValue($model->namesDays,   $day = $model->getDateTime('D'),  $day); },  'group' => true,  /* enable grouping*/ ],
            'timestamp:datetime',
            'text',
            'project.name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
