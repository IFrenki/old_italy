<?php

namespace app\controllers;

use app\models\Products;
use app\models\Cart;
use yii\web\Controller;
use Yii;


class CartController extends Controller {

    public function actionIndex() {
        $session = Yii::$app->session;
        $session->open();
        return $this->render('index', compact('session'));
    }

    public function actionAdd() {
        $product_id = Yii::$app->request->get('id');
        $product = Products::findOne($product_id);
        $weight = Yii::$app->request->get('weight');

        if (!isset($product)) return false;

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $product->discount != 0 ? $product->price = $product->price - ($product->price / 100) * ($product->discount) : null;
        !empty($weight) ? $cart->addToCart($product, $weight) : $cart->addToCart($product);

        $this->layout = false;
        return $this->render('modal-window', compact('session'));
    }

    public function actionClear() {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.weight');
        $session->remove('cart.sum');
        return $this->render('index', compact('session'));
    }

    public function actionDelete() {
        $product_id = Yii::$app->request->get('id');

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->reCalc($product_id);

        return $this->render('index', compact('session'));
    }
}