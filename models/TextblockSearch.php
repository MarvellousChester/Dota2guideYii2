<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Textblock;

/**
 * TextblockSearch represents the model behind the search form about `app\models\Textblock`.
 */
class TextblockSearch extends Textblock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_on_mainpage'], 'integer'],
            [['icon', 'text'], 'safe'],
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
        $query = Textblock::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'is_on_mainpage' => $this->is_on_mainpage,
        ]);

        $query->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
    
}
