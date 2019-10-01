<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ap\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'phone',
            'address',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                ]
        ],
    ]); ?>
</div>
