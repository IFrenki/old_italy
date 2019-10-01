<?php

namespace app\modules\ap\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $first_name
 * @property string $second_name
 * @property string $birth_date
 * @property string $email
 * @property string $password
 * @property int $role
 */
class User extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'email', 'password'], 'required'],
            [['birth_date'], 'safe'],
            [['role'], 'integer'],
            [['first_name', 'second_name', 'email', 'password'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'second_name' => 'Фамилия',
            'birth_date' => 'Дата рождения',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'role' => 'Роль',
        ];
    }
}
