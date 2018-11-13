<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Todo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="todo-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'text')->textarea(['maxlength' => true]) ?>
    <?php
        echo $form->field($model, 'status_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Status::find()->all(),  'id', 'name' ),
        'options' => [],
        'pluginOptions' => [
            //'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ])->label('статус');?>
    <?php
        echo $form->field($model, 'project_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Project::find()->all(),  'id', 'name' ),
        'options' => [],
        'pluginOptions' => [
         //   'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ])->label('проект');?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
