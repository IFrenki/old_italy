<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "cart".
 *
 * @property int $_id
 * @property string $_key
 * @property int $_prod_id
 * @property string $_image
 * @property double $_weight
 * @property string $_amount
 *
 * @property Products $prod
 */
class Cart extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', '_key', '_prod_id', '_image', '_weight', '_amount'], 'required'],
            [['_id', '_prod_id'], 'integer'],
            [['_weight', '_amount'], 'number'],
            [['_key'], 'string', 'max' => 100],
            [['_image'], 'string', 'max' => 255],
            [['_id'], 'unique'],
            [['_prod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['_prod_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'Id',
            '_key' => 'Key',
            '_prod_id' => 'Prod ID',
            '_image' => 'Image',
            '_weight' => 'Weight',
            '_amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProd()
    {
        return $this->hasOne(Products::className(), ['id' => '_prod_id']);
    }

    public function priceComputed($price, $weight, $qty) {
        switch ($price && $weight && $qty) {
            case $weight == 150: $price += $price / 2; break;
            case $weight == 200: $qty = 2; break;
            case $weight == 250: $price = ($price * 2) + ($price / 2); break;
            case $weight == 300: $qty = 3; break;
            case $weight == 500: $qty = 5; break;
            case $weight == 700: $qty = 7; break;
            case $weight == 1000: $qty = 10; break;
        }
        return $qty * $price;
    }

    public function addToCart($product, $weight = 100) {
        $qty = 1;

        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty;
            $_SESSION['cart'][$product->id]['weight'] += $weight;
            $_SESSION['cart'][$product->id]['common_price'] += $this->priceComputed($product->price, $weight, $qty);
        } else {
            $_SESSION['cart'][$product->id] = [
                'weight' => $weight,
                'qty' => $qty,
                'name' => $product->title,
                'price' => $product->price,
                'common_price' => $this->priceComputed($product->price, $weight, $qty),
                'img' => $product->image
            ];
        }

        $_SESSION['cart.weight'] = isset($_SESSION['cart.weight']) ? $_SESSION['cart.weight'] + $weight : $weight;
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;

        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ?
            $_SESSION['cart.sum'] += $this->priceComputed($product->price, $weight, $qty) :
            $_SESSION['cart.sum'] = $this->priceComputed($product->price, $weight, $qty);
    }

    public function reCalc($id) {
        if (!isset($_SESSION['cart'][$id])) return false;

        $price = $_SESSION['cart'][$id]['common_price'];
        $weight = $_SESSION['cart'][$id]['weight'];
        $quantity = $_SESSION['cart'][$id]['qty'];

        $_SESSION['cart.qty'] -= $quantity;
        $_SESSION['cart.weight'] -= $weight;
        $_SESSION['cart.sum'] -= $price;

        unset($_SESSION['cart'][$id]);
    }
}
