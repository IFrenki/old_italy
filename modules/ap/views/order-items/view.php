<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\ap\models\OrderItems */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Заказанные товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="order-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_id',
            'prod_id',
            'title',
            'price',
            'weight',
        ],
    ]) ?>

</div>
