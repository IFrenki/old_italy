<?php

namespace app\modules\ap\models;

use app\models\Cart;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $sort
 * @property string $country
 * @property string $price
 * @property int $discount
 * @property string $image
 *
 * @property Cart[] $carts
 * @property OrderItems[] $orderItems
 */
class Products extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'sort', 'country', 'price', 'discount'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['discount'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['sort', 'country'], 'string', 'max' => 30],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'sort' => 'Вид',
            'country' => 'Страна',
            'price' => 'Цена (рублей)',
            'discount' => 'Скидка (%)',
            'image' => 'Изображение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['_prod_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['prod_id' => 'id']);
    }
}
