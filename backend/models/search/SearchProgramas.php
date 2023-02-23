<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Programa;

/**
 * SearchProgamas represents the model behind the search form of `backend\models\Programa`.
 */
class SearchProgramas extends Programa
{
    public $asignaturas;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'desc', 'asignaturas'], 'safe'],
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
        $query = Programa::find();
        $query->joinWith(['programaAsignaturas.asignatura']);

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
        ]);

        $query->andFilterWhere(['like', 'programa.nombre', $this->nombre])
        // ->andFilterWhere(['like', 'asignaturas', $this->asignaturas])
        ->andFilterWhere(['like', 'programa.desc', $this->desc])
            ->andFilterWhere(['like', 'asignatura.nombre', $this->asignaturas]);

        return $dataProvider;
    }
}
