<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Products;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $discount_prices[] = null;

        $product_discount = new ActiveDataProvider([
             // Получаем только те товары, у которых есть скидка
            'query' => Products::find()->where(['!=', 'discount', 0])
        ]);

        return $this->render('index', [
            'product_discount' => $product_discount
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister() {
        $model = new User();
        $auth = new LoginForm();
        // ajax проверка
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) ) {
            if ($model->validate()) {
                $birth_date = $model->year . '-' . $model->month . '-' . $model->day;

                if (!empty($model->year) && !empty($model->month) && !empty($model->day)) {
                    $model->birth_date = $birth_date;
                } else {
                    $model->birth_date = '00-00-00';
                }

                if (User::find()->where(['email' => $model->email])->exists()) {
                    $message = 'Такой E-mail уже существует';

                    return $this->render('register', [
                        'message' => $message,
                        'model' => $model
                    ]);
                } else {
                     $model->role = 0;
                    /* ставим false, чтобы повторно не проходить валидацию, т.к все поля формы уже
                        прошли валидацию, по правилам которые мы задали в модели User */
                    $model->save(false);

                    // Авторизация пользователя в системе
                    Yii::$app->user->login(User::findOne(['email' => $model->email]));

                    // вывод сообщения
                    Yii::$app->session->setFlash('success', 'Вы успешно зарегистрированы!');

                    // перенаправление на главную
                    return $this->redirect('/');
                }
            }
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }



    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/site/login/');
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
