<?php
 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\ChangePasswordForm */
 
$this->title = Yii::t('app', 'Change password');

?>
<div class="user-profile-password-change">
 
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to change password:</p>
 
    <div class="user-form">
 
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>
 
        <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true, 'placeholder' => 'Current password'])->label(false) ?>
        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true, 'placeholder' => 'New password'])->label(false) ?>
        <?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => true, 'placeholder' => 'Confirm password'])->label(false) ?>
 
        <div class="form-group">
            <div class="col-lg-1 col-lg-1">
                <?= Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'change-pass-from-account-button']) ?>
            </div>
        </div>
 
        <?php ActiveForm::end(); ?>
 
    </div>
 
</div>