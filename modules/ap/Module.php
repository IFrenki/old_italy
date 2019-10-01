<?php

namespace app\modules\ap;

/**
 * ap module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\ap\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        // если пользователь неавторизован или не имеет роль администратора
        if (\Yii::$app->user->isGuest || \Yii::$app->user->identity->role!=1) {
            return \Yii::$app->response->redirect(['site/login']);
        }
        parent::init();
        $this->layout = 'admin';
    }
}
