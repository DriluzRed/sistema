<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AlumnoPrograma;

/**
 * AlumnoProgramaSearch represents the model behind the search form of `app\models\AlumnoPrograma`.
 */
class SearchAlumnoPrograma extends AlumnoPrograma
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumno_id', 'programa_id'], 'integer'],
            [['cohorte'], 'safe'],
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
        $query = AlumnoPrograma::find()->joinWith(['estadoPrograma', 'alumno']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you want to return all records
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'programa_id' => $this->programa_id,
        ]);

        $query->select([
            'cohort',
            'totalInscriptos' => 'COUNT(*)',
            'totalDesmatriculados' => 'SUM(CASE WHEN estado_programa.desc = "desmatriculado" THEN 1 ELSE 0 END)',
            'totalActivos' => 'SUM(CASE WHEN alumno.status = "activo" THEN 1 ELSE 0 END)',
            'totalEgresados' => 'SUM(CASE WHEN estado_programa.desc = "egresado" THEN 1 ELSE 0 END)',
            'totalGraduados' => 'SUM(CASE WHEN estado_programa.desc = "graduado" THEN 1 ELSE 0 END)',
            'totalReinscriptos' => 'SUM(CASE WHEN estado_programa.desc = "reinscripto" THEN 1 ELSE 0 END)',
        ]);

        $query->groupBy(['cohort']);

        return $dataProvider;
    }
}