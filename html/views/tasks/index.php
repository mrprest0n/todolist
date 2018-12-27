<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Tasks';
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin([
        'id' => 'show-tasks-form',
        'method' => 'post',
        'action' => Url::to(['tasks/create', 'ownerListId' => $ownerListId]),
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-10\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ]
        ]);
    ?>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'name')->textInput(['style'=>'width:200px', 'placeholder' => 'Name'])->label(false) ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'description')->textInput(['style'=>'width:250px', 'placeholder' => 'Description'])->label(false) ?>
        </div>

        <div class="col-xs-3">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-task-button']) ?> 
        </div>
    </div>

    
    
    <?php ActiveForm::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($mod)
                {
                    return ['checked' => $mod->done, 'disabled' => true];
                },
                'name' => 'Done'
            ],
            'name',
            'description',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => ['color' => '#337ab7', 'width' =>'200px']],
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url) 
                    {
                        return Html::a('Update', $url, ['class' => 'btn btn-primary']);
                    },
                    'delete' => function ($url)
                    {
                        return Html::a('Delete', $url, [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                                ],
                            ]);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
