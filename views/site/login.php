<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
?>
<div id="site-login">
    <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

        <h1><?= $this->title ?></h1>

        <?= $form->field($model, 'email')
            ->textInput(['autofocus' => true, 'maxlength' => true])
            ->label('E-mail') ?>

        <?= $form->field($model, 'password')
            ->passwordInput(['maxlength' => true])
            ->label('Пароль') ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<label><div>{input}<span class='pseudo-checkbox'>{label}</span></label></div>\n<div>{error}</div>",
        ])->label('Чужой компьютер') ?>

        <div class="form-group">
            <?= Html::submitButton('Войти', ['name' => 'login-button']) ?>
            <?= Html::a('Зарегистрироваться', ['site/register']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
