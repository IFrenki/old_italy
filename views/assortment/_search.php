<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Products;

/* @var $this yii\web\View */
/* @var $model app\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1
    ],
]); ?>

     <?= $form->field($model, 'sort')
      ->checkboxList(ArrayHelper::map(Products::find()
          ->all(), 'sort', 'sort'), ['item' => function ($index, $label, $name, $checked, $value) {
            $checked ? $checked = 'checked' : $checked = '';
            return
                '<div class="checkbox">
                    <label>
                        <input type="checkbox" name="'.$name.'" value="'.$value.'" '. $checked .' >
                            <span class="pseudo-checkbox">'.$label.'</span>
                    </label>
                </div>';
    }]) ?>

    <?= $form->field($model, 'country')
      ->checkboxList(ArrayHelper::map(Products::find()
          ->all(), 'country', 'country'), ['item' => function ($index, $label, $name, $checked, $value) {
            $checked ? $checked = 'checked' : $checked = '';
            return
                '<div class="checkbox">
                    <label>
                        <input type="checkbox" name="'.$name.'" value="'.$value.'" '. $checked .' >
                            <span class="pseudo-checkbox">'.$label.'</span>
                    </label>
                </div>';
    }]) ?>

    <?= $form->field($model, 'price_sort')
      ->radioList(['default' => 'По умолчанию', 'ASC' => 'По возрастанию', 'DESC' => 'По убыванию'],
          ['item' => function ($index, $label, $name, $checked, $value) {
            $checked ? $checked = 'checked' : $checked = '';
            return
                '<div class="radio">
                    <label>
                        <input type="radio" name="'.$name.'" value="'.$value.'" '. $checked .' >
                            <span class="pseudo-radio">'.$label.'</span>
                    </label>
                </div>';
    }]) ?>

    <?= Html::submitButton('Применить') ?>
    <?= Html::a('Очистить', '/assortment') ?>

<?php ActiveForm::end(); ?>
