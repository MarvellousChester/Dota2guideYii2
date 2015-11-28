<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GuideUser;

/**
 * GuideUserSearch represents the model behind the search form about `app\models\GuideUser`.
 */
class GuideUserSearch extends GuideUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ban', 'role'], 'integer'],
            [['username', 'email', 'password', 'fullname', 'created'], 'safe'],
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
        $query = GuideUser::find();

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
            'created' => $this->created,
            'ban' => $this->ban,
            'role' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'fullname', $this->fullname]);

        return $dataProvider;
    }
}
