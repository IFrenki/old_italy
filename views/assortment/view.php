<?php

use yii\helpers\Html;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->title;
YiiAsset::register($this);
?>
<div id="products-view">
    <div class="top_section">
        <div class="picture pull-left">
            <?= Html::tag('div','', ['style' => ['background-image' => 'url(' . $model->image . ')']]) ?>
        </div>

        <div class="right_block pull-right">
            <div class="main_info">
                <h1><?= $model->title ?></h1>
                <?php if ($model->discount != 0): ?>
                    <div class="price_block">
                        <h3><?= $model->price ?></h3>
                        <h3><?= $model->price - ($model->price / 100) * ($model->discount) ?></h3>
                    </div>
                <?php else: ?>
                    <h3><?= $model->price ?></h3>
                <?php endif; ?>
            </div>

            <div class="control_panel">
                <select name="select-box" id="selectId" class="select list_weight">
                    <option value="100" name="value">100 г</option>
                    <option value="150" name="value">150 г</option>
                    <option value="200" name="value">200 г</option>
                    <option value="250" name="value">250 г</option>
                    <option value="300" name="value">300 г</option>
                    <option value="500" name="value">500 г</option>
                    <option value="700" name="value">700 г</option>
                    <option value="1000" name="value">1000 г</option>
                </select>
                <?= Html::a('В корзину', [''], ['class' => 'add-to-cart_js add_to_cart', 'data-id' => $model->id]) ?>
            </div>
        </div>
    </div>

    <div class="middle_section">
        <h2>Описание</h2>
        <div class="description">
            <p><?= $model->description ?></p>

            <?php if ($model->sort === 'Смесь Арабики и Робусты'): ?>
                <p><span>Состав: </span><?= $model->sort ?></p>
            <?php else: ?>
                <p><span>Состав: </span>100% <?= $model->sort ?></p>
            <?php endif; ?>

            <p><span>Степень обжарки: </span>Средняя</p>
        </div>
    </div>
</div>
