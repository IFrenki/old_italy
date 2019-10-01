<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ap\models\OrderItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказанные товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_id',
            'title',
            'price',
            'weight',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}']
        ],
    ]); ?>
</div>
