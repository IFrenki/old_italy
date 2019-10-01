<?php

namespace app\modules\ap\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $comment
 * @property double $full_weight
 * @property string $amount
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property OrderItems[] $orderItems
 */
class Orders extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'address', 'full_weight', 'amount', 'created_at', 'updated_at'], 'required'],
            [['comment'], 'string'],
            [['full_weight', 'amount'], 'number'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя пользователя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адресс',
            'comment' => 'Комментарий',
            'full_weight' => 'Вес (грамм)',
            'amount' => 'Сумма (рублей)',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }
}
