<?php
    use yii\helpers\Html;

    $this->title = 'Корзина'
?>
<div id="cart-view">

    <h1><?= $this->title ?></h1>

    <?php if (!empty($session['cart'])): ?>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                <?php foreach ($session['cart'] as $id => $item): ?>
                    <tr>
                        <td><?= Html::img($item['img']) ?></td>
                        <td>
                            <?= Html::a($item['name'], ['assortment/view', 'id' => $id]) ?>
                            <?= Html::tag('span',$item['price'] . ' р. / 100 г.') ?>
                        </td>
                        <td>
                            <span>Вес:</span>
                            <p><?= $item['weight'] ?> г.</p>
                        </td>
                        <td>
                            <span>Сумма:</span>
                            <p><?= $item['common_price'] ?></p>
                        </td>
                        <td>
                            <?= Html::a(Html::img('/web/icons/cross.png'), [''], ['onclick' => "deleteProduct({$id})"]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="total">
            <span>Итог:</span>
            <span><?= $session['cart.sum'] ?></span>
        </div>

        <div id="cart_control">
            <?= Html::a('Оформить заказ', ['/order']) ?>
            <?= Html::a('Очистить корзину', [''], ['onclick' => 'clearCart()']) ?>
        </div>
    <?php else: ?>
        <h3>Корзина пуста</h3>
    <?php endif; ?>
</div>
