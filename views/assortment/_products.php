<?php
    use yii\helpers\Html;
?>

<?php if ($model->discount != 0): ?>
    <div class="ribbon_round"><?= $model->discount ?> %</div>
<?php endif; ?>

<?= Html::a(
        Html::tag('div','', ['style' => ['background-image' => 'url(' . $model->image . ')'], 'class' => 'img']),
        ['view', 'id' => $model->id]
    ) .
    '<div class="info">' .
        Html::tag('span', $model->title, ['id' => 'title']) .
        '<hr>' .
        Html::tag('span',$model->price, ['id' => 'price']) .
    '</div>' .
    Html::button('В корзину', ['class' => 'add-to-cart_js add_to_cart', 'data-id' => $model->id]);
?>