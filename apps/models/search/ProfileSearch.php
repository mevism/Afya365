<?php

namespace search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['username','first_name','middle_name','last_name','dob', 'email','gender', 'blood_group', 'phone', 'residence'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Profile::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->orFilterWhere(['like', 'first_name', $this->first_name])
            ->orFilterWhere(['like', 'middle_name', $this->middle_name])
            ->orFilterWhere(['like', 'last_name', $this->last_name])
            ->orFilterWhere(['like', 'dob', $this->dob])
            ->orFilterWhere(['like', 'email', $this->email])
            ->orFilterWhere(['like', 'gender', $this->gender])
            ->orFilterWhere(['like', 'blood_group', $this->blood_group])
            ->orFilterWhere(['like', 'phone', $this->phone])
            ->orFilterWhere(['like', 'residence', $this->residence]);

        return $dataProvider;
    }
}
