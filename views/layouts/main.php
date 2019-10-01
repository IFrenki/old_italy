<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\bootstrap\Modal;
use yii\helpers\Url;

AppAsset::register($this);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Url::to(['/web/favicon.png'])]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <header>

            <div class="child_header">
                <a href="/site/"><img src="/web/img/logo.png" alt="Логотип"/></a>

                <div class="middle-block">
                    <p>Пн-Пт, с 9.00 до 18.00</p>
                    <p><img src="/web/icons/phone.png">+7 (955) 765-45-55</p>
                    <p>Звонок по России бесплатный</p>
                </div>

                <div class="right-block">
                    <a href="/cart/">
                        <span>Корзина</span>
                        <span><?php
                            if (Yii::$app->session['cart.sum'] == '') Yii::$app->session['cart.sum'] = 0;
                            echo Yii::$app->session['cart.sum']
                            ?> р.
                    </span>
                    </a>

                    <div class="search_box">
                        <form action="/assortment">
                            <input type="text" placeholder="Поиск.." name="user_query">
                        </form>
                    </div>
                </div>
            </div>

            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'my-navbar navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => [
                    ['label' => 'Ассортимент', 'url' => ['/assortment'], 'linkOptions' => ['class' => 'fa fa-home']],
                    ['label' => 'Новости', 'url' => ['/site/news']],
                    ['label' => 'О нас', 'url' => ['/site/about']],
                    ['label' => 'Контакты', 'url' => ['/site/contact']],
                    ['label' => 'Доставка и оплата ', 'url' => ['/site/shipment']]
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    Yii::$app->user->isGuest ? (
                        '<div id="link_sign-in">'.
                            '<img src="/web/icons/sign_in.png">'.
                            '<li><a href="/site/login/">Вход</a></li>'.
                        '</div>'.
                        '<div id="link_register">'.
                            '<img src="/web/icons/user.png">'.
                            '<li><a href="/site/register/">Регистрация</a></li>'.
                        '</div>'
                    ) : (
                        '<div id="link_logout">'
                        .'<img src="/web/icons/sign_in.png">'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Выйти (' . Yii::$app->user->identity->first_name . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</div>'
                    )
                ]
            ]);
            NavBar::end();
            ?>
        </header>

        <div class="container">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <span>&copy; «Old Italy» <?= date('Y') ?></span>
            <nav class="footer-navigation pull-left">
                <a href="/site">Главная</a>
                <a href="/site/news">Новости</a>
                <a href="/site/contact">Контакты</a>
            </nav>
            <img src="/web/img/logo_2.png" alt="Логотип" class="pull-right">
        </div>
    </footer>

    <?php Modal::begin([
        'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить</button>
                     <a href="'. Url::to(['/cart/']) .'" class="btn btn-success">Оформить заказ</a>',
        'size' => 'modal-sm',
        'id' => 'cart'
    ]); ?>
    <?php Modal::end(); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
