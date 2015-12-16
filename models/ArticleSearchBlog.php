<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `app\models\Article`.
 */
class ArticleSearchBlog extends Article
{
    public $page_size;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'category_id', 'attribute'], 'integer'],
            [['title', 'content', 'author', 'created', 'image'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Article::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => 
            [
                'pageSize' => $this->page_size,
            ],
            'sort' => 
            [
                //атрибуты по которым происходит сортировка
                'attributes' => 
                [
                    'Created' => 
                    [
                        'asc'  => ['created' => SORT_ASC,],
                        'desc' => ['created' => SORT_DESC,],
                    ],
                    'Title' => 
                    [
                        'asc'  => ['title' => SORT_ASC,],
                        'desc' => ['title' => SORT_DESC,],
                    ],
                    'Author' => 
                    [
                        'asc'  => ['author' => SORT_ASC,],
                        'desc' => ['author' => SORT_DESC,],
                    ],
                ],
                'defaultOrder' => 
                [
                    'Created' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created' => $this->created,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'attribute' => $this->attribute,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
    
    
}
