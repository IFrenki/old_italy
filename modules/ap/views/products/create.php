<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\ap\models\Products */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => 'Склад', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
