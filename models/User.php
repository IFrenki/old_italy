<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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
class User extends ActiveRecord implements IdentityInterface
{
    public $repeat_password;
    public $year;
    public $month;
    public $day;

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
            [['role', 'day', 'month', 'year'], 'integer'],
            [['birth_date'], 'safe'],
            [['first_name', 'email', 'password', 'repeat_password'], 'required'],
            [['first_name','second_name', 'email'], 'string', 'max' => 50],
            [['first_name','second_name'], 'match', 'pattern' => '/^[а-яА-ЯёЁ ]+$/u'],  // только кириллица без знаков препинания
            [['email'], 'email'],  // email формат
            [['password'], 'string', 'max' => 150],
            [['password'],
                'match',
                'pattern' => '/^(?=.*[0-9])(?=.*[a-z])[0-9a-z]{5,}$/u'  // латиница, не менее 6 символов нижнего регистра, с цифрами
                /*
                     * (?=.*[0-9]) - строка содержит хотя бы одно число;
                     * (?=.*[!@#$%^&*]) - строка содержит хотя бы один спецсимвол;
                     * (?=.*[a-z]) - строка содержит хотя бы одну латинскую букву в нижнем регистре;
                     * (?=.*[A-Z]) - строка содержит хотя бы одну латинскую букву в верхнем регистре;
                     * [0-9a-zA-Z!@#$%^&*]{6,} - строка состоит не менее, чем из 6 вышеупомянутых символов.
                 */
            ],
            [['repeat_password'], 'string', 'max' => 150],
            [['repeat_password'], 'compare', 'compareAttribute' => 'password']  // должен совпадать с password
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
            'email' => 'E-mail',
            'password' => 'Пароль',
            'repeat_password' => 'Повторите пароль'
        ];
    }

    public static function findIdentity($id) { return static::findOne($id); }
    public static function findIdentityByAccessToken($token, $type = null) { return static::findOne(['access_token' => $token]); }
    public function getId() { return $this->id; }
    public function getAuthKey() { return $this->authKey; }
    public function validateAuthKey($authKey) { return $this->authKey === $authKey; }
    public function validatePassword($password) { return $this->password == $password; }
}
