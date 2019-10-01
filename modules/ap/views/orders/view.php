<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\ap\models\Orders */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="orders-view">

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
            'name',
            'email:email',
            'phone',
            'address',
            'comment:ntext',
            'full_weight',
            'amount',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
