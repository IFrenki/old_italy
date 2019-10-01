<?php

namespace app\controllers;

use app\models\OrderItems;
use app\models\Orders;
use yii\web\Controller;
use Yii;

class OrderController extends Controller {

    public function actionIndex() {
        $session = Yii::$app->session;
        $session->open();
        $order = new Orders();
        $order_items = new OrderItems();

        if ($order->load(Yii::$app->request->post())) {
           $order->full_weight = $session['cart.weight'];
           $order->amount = $session['cart.sum'];

           if ($order->save()) {
               $order_items->saveOrderItems($session['cart'], $order->id);
               Yii::$app->session->setFlash('success', 'Ваш заказ успешно отправлен');
               $session->remove('cart');
               $session->remove('cart.qty');
               $session->remove('cart.weight');
               $session->remove('cart.sum');
               return $this->redirect('/cart');
           } else {
               Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
               return $this->redirect('/cart');
           }
        }
        return $this->render('index', compact('session', 'order'));
    }
}