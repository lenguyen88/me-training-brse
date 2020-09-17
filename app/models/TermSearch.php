<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Term;

/**
 * TermSearch represents the model behind the search form of `app\models\Term`.
 */
class TermSearch extends Term
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'project_id', 'parent_term_id'], 'integer'],
            [['language', 'vocabulary', 'description',], 'safe'],
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
        $query = Term::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'type' => $this->type,
            'project_id' => $this->project_id,
            'parent_term_id' => $this->parent_term_id,
        ]);

        $query->andFilterWhere(['ilike', 'language', $this->language])
            ->andFilterWhere(['ilike', 'vocabulary', $this->vocabulary])
            ->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }
}
