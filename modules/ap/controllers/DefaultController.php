<?php

namespace app\modules\ap\controllers;

use app\modules\ap\models\User;
use yii\web\Controller;

/**
 * Default controller for the `ap` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

     public function actionIndex() {
          $users = User::find()->orderBy('id desc')->limit(3)->all();
          return $this->render('index', ['last_users' => $users]);
    }
}
