<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductsSearch represents the model behind the search form of `app\models\Products`.
 */
class ProductsSearch extends Products
{
    public $price_sort;  // for sorted price

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price_sort'], 'string'],
            [['id', 'discount'], 'integer'],
            [['title', 'description', 'sort', 'country', 'image'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Products::find();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12
            ]
        ]);

        if ($params['ProductsSearch']['price_sort'] === 'ASC') {
            $dataProvider->sort->defaultOrder['price'] = SORT_ASC;
        }
        else if ($params['ProductsSearch']['price_sort'] === 'DESC') {
            $dataProvider->sort->defaultOrder['price'] = SORT_DESC;
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sort' => $this->sort,
            'country' => $this->country,
            'id' => $this->id,
            'price' => $this->price,
            'discount' => $this->discount
        ]);

        return $dataProvider;
    }
}
