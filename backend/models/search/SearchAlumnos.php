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
    public $programas;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'campus', 'subsidiary'], 'integer'],
            [['first_name', 'last_name', 'ci', 'low_line_number', 'phone', 'email', 'address', 'age', 'enrollment_date','programas', 'contract_number', 'year', 'promotion_year', 'born_at', 'promotion', 'document_front_file', 'document_back_file', 'status', 'study_certificate_file', 'finded_ips', 'finded_ruc', 'sex', 'created_at', 'updated_at'], 'safe'],
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
        $query->joinWith(['alumnoProgramas.programa']);

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
            'country_id' => $this->country_id,
            'campus' => $this->campus,
            'subsidiary' => $this->subsidiary,
            // 'programa_id' => $this->programa_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'ci', $this->ci])
            ->andFilterWhere(['like', 'low_line_number', $this->low_line_number])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'enrollment_date', $this->enrollment_date])
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
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'programas.nombre', $this->programas]);

        return $dataProvider;
    }
}
