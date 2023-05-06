<?php

namespace adminSearch;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use doctorModels\Doctorschedule;

/**
 * DoctorScheduleSearch represents the model behind the search form of `adminModels\Doctor`.
 */
class DoctorScheduleSearch extends Doctorschedule
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['staff_number','schedule_date', 'schedule_start', 'schedule_end'], 'safe'],
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
        $query = Doctorschedule::find();

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
        ]);

        $query->andFilterWhere(['like', 'staff_number', $this->staff_number])
            ->andFilterWhere(['like', 'schedule_date', $this->schedule_date])
            ->andFilterWhere(['like', 'schedule_start', $this->schedule_start])
            ->andFilterWhere(['like', 'schedule_end', $this->schedule_end]);
        return $dataProvider;
    }
}
