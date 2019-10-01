<?php

/* @var $this yii\web\View */

$this->title = 'Главная';
use yii\widgets\ListView;

?>
<div class="slider">
    <div class="slider__wrapper">
        <div class="slider__item">
            <h1>Добро пожаловать</h1>
            <p>"Старая Италия" предлает вам окунуться во времена, когда само понятние "растворимый" для кофе еще не существовало,
а вкус и аромат по истине восхищали и радовали даже самого строгого гурмана</p>
            <div></div>
        </div>
        <div class="slider__item">
            <h1>Лучшие сорта</h1>
            <p>В нашем ассортименте присутствует более 100 самых различных элитных сортов кофе. Закуп товара производиться напрямую из стран его происхождения</p>
            <div></div>
        </div>
        <div class="slider__item">
            <h1>Сервис для клиента</h1>
            <p>Здесь вы можете не только приобрести изысканные сорта кофе, но и получить квалифицированную консультацию по всем интересующим вас вопросам</p>
            <div></div>
        </div>
      </div>
      <a class="slider__control slider__control_left" href="#" role="button"></a>
      <a class="slider__control slider__control_right" href="#" role="button"></a>
</div>
<h1 id="title_discount_block">Скидки недели</h1>

<?= ListView::widget([
    'dataProvider' => $product_discount,
    'itemView' => '_discount-products',
    'options' => ['class' => 'discount_list'],
]) ?>