<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class AssortmentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @param $sorting
     * @return mixed
     */

    public function actionIndex() {
        $searchModel = new ProductsSearch();
        $user_query = Yii::$app->request->get('user_query');

        if($user_query) {
            $search_products = new ActiveDataProvider([
                'query' => Products::find()->where(['like', 'title', $user_query]),
                'pagination' => ['pageSize' => 12]
            ]);
        } else {
            $search_products = $searchModel->search(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'products' => $search_products,
            'user_query' => $user_query
        ]);
    }

     /**
    * Displays a single Products model.
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionView($id)
    {
       return $this->render('view', [
           'model' => $this->findModel($id),
       ]);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
