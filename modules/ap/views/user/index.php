<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ap\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'second_name',
            'birth_date',
            'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
