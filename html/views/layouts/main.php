<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= Html::csrfMetaTags() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Task Helper',
        'brandUrl' => Yii::$app->user->isGuest ? Yii::$app->homeUrl : Url::to(['lists/index']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
        
    $widgetItems = [];
    if (Yii::$app->user->isGuest)
    {
        $widgetItems = [
            ['label' => 'Login', 'url' => ['/site/login']],
            ['label' => 'Signup', 'url' => ['/site/signup']],
        ];
    }
    else 
    {
        $widgetItems = [
        ['label' => 'Lists', 'url' => ['/lists/index']],
        ['label' => 'Change password', 'url' => ['/site/reset-password-from-account']],
        '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
                )
        . Html::endForm()
        . '</li>'       
        ];
    }
    
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $widgetItems
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
        <p class="pull-left">&copy; Mr.Preston <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
