<?php
use yii\helpers\Url;

$this->title = 'Task Helper';
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to the club, buddy!</h1>

        <p class="lead">You must be logged in to continue</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['site/login'])?>">Login</a></p>
    </div>
</div>
