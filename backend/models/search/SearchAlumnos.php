<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Alumno;

/**
 * SearchAlumnos represents the model behind the search form of `backend\models\Alumno`.
 */
class SearchAlumnos extends Alumno
{
    public $country_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'programa_id', 'campus', 'subsidiary'], 'integer'],
            [['first_name', 'last_name', 'ci', 'low_line_number', 'phone', 'email', 'address', 'age', 'enrrolment_date', 'contract_number', 'year', 'promotion_year', 'born_at', 'promotion', 'document_front_file', 'document_back_file', 'status', 'study_certificate_file', 'finded_ips', 'finded_ruc', 'country_name'], 'safe'],
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
        $query = Alumno::find();
        $query->alias('alumno');
        $query->joinWith('pais');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['last_name' => SORT_ASC]]
        ]);
        $dataProvider->sort->attributes['country_name'] = [
            'asc' => ['pais.nombre' => SORT_ASC],
            'desc' => ['pais.nombre' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
            'programa_id' => $this->programa_id,
            'campus' => $this->campus,
            'subsidiary' => $this->subsidiary,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'ci', $this->ci])
            ->andFilterWhere(['like', 'low_line_number', $this->low_line_number])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'enrrolment_date', $this->enrrolment_date])
            ->andFilterWhere(['like', 'contract_number', $this->contract_number])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'promotion_year', $this->promotion_year])
            ->andFilterWhere(['like', 'born_at', $this->born_at])
            ->andFilterWhere(['like', 'promotion', $this->promotion])
            ->andFilterWhere(['like', 'document_front_file', $this->document_front_file])
            ->andFilterWhere(['like', 'document_back_file', $this->document_back_file])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'study_certificate_file', $this->study_certificate_file])
            ->andFilterWhere(['like', 'finded_ips', $this->finded_ips])
            ->andFilterWhere(['like', 'finded_ruc', $this->finded_ruc])
            ->andFilterWhere(['like', 'pais.nombre', $this->country_name]);

        return $dataProvider;
    }
}
