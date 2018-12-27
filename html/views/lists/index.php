<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Lists';
?>
<div class="lists-index">
       
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin([
        'id' => 'show-lists-form',
        'method' => 'post',
        'action' => Url::to(['lists/create']),
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
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-list-button']) ?> 
        </div>
    </div>    
    
    <?php ActiveForm::end(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'value' => function (\app\models\Lists $data) {
                    return Html::a(Html::encode($data->name), Url::to(['tasks/index', 'ownerListId' => $data->id]));
                },
                'format' => 'raw',
            ],
            'description',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
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
