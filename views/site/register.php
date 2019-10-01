<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
$this->title = 'Регистрация'
?>
<div id="site-register">
    <?php $form = ActiveForm::begin([
            'id' => 'register-form',
            'enableAjaxValidation' => true
    ]) ?>

    <h1><?= $this->title ?></h1>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'second_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <div class="form-group field-user-birth">
        <label class="control-label">Дата рождения</label>
        <div>
            <?= $form->field($model, 'day')
                ->textInput(['placeholder' => 'День'])
                ->label(false) ?>
            <?= $form->field($model, 'month')
                ->textInput(['placeholder' => 'Месяц'])
                ->label(false) ?>
            <?= $form->field($model, 'year')
                ->textInput(['placeholder' => 'Год'])
                ->label(false) ?>
        </div>
    </div>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'repeat_password')->passwordInput() ?>

    <div class="bottom_block">
        <?= Html::submitButton('Продолжить') ?>
        <span><span>*</span> - обязательные поля для заполнения</span>
    </div>

    <p class="message"><?= $message ?></p>
    <?php ActiveForm::end(); ?>
</div>
