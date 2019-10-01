    <?php
        use yii\helpers\Html;
        use yii\widgets\ActiveForm;

        $this->title = 'Оформление заказа'
    ?>

    <div id="order-view">
        <?php $form = ActiveForm::begin(); ?>
            <h1><?= $this->title ?></h1>
            <h3>Укажите информацию для доставки</h3>
            <?= $form->field($order, 'name') ?>
            <?= $form->field($order, 'email')->textInput(['placeholder' => 'name@mail.ru', 'maxlength' => true]) ?>
            <?= $form->field($order, 'phone')->textInput(['placeholder' => '+7 ..', 'maxlength' => true]) ?>
            <?= $form->field($order, 'address')->textInput(['placeholder' => 'ул. Герцена, 18', 'maxlength' => true]) ?>
            <?= $form->field($order, 'comment')->textarea(['rows' => 6]) ?>

            <div class="bottom_block">
                <span><span>*</span> - обязательные поля для заполнения</span>
                <h3>Проверьте ваш заказ</h3>
                <div class="total price">
                    <span>Товаров на сумму:</span>
                    <span><?= $session['cart.sum'] ?></span>
                </div>
                <div class="total shipment">
                    <span>Доставка:</span>
                    <span>0</span>
                </div>
            </div>
            <div class="total amount">
                <span>Итог</span>
                <span><?= $session['cart.sum'] ?></span>
            </div>
            <?= Html::submitButton('Оплатить заказ') ?>
        <?php $form = ActiveForm::end() ?>
    </div>
