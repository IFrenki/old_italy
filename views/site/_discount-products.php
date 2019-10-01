<?php
    use yii\helpers\Html;
?>

<?= Html::tag('h1', Html::encode(($model->discount . '%')), ['id' => 'discount_percent']) ?>
<div class="discount_picture">
    <?= Html::a(
            Html::tag('img','', ['src' => '/web/icons/link-solid.svg']) . 'Подробнее',
            ['/assortment/view', 'id' => $model->id]
        ) ?>
    <?= Html::a(
            Html::tag('img','', ['src' => '/web/icons/bag.png']) . 'В корзину',
            [''], ['class' => 'add-to-cart_js add_to_cart', 'data-id' => $model->id]
        ) ?>
    <?= Html::tag('div','', ['style' => ['background-image' => 'url(' . $model->image . ')'], 'class' => 'img']) ?>
</div>

<?= Html::tag('h2', Html::encode($model->title), ['id' => 'title']) ?>
<?= '<div class="bottom_block">'.
            Html::tag('span', Html::encode(($model->price)), ['id' => 'price']).
            Html::tag('span', ($model->price - ($model->price / 100) * ($model->discount)), ['id' => 'discount_price_' . $model->id, 'class' => 'real_price']).
    '</div>' ?>
