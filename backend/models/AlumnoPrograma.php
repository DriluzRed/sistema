<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alumno_programa".
 *
 * @property int $id
 * @property int $alumno_id
 * @property int $programa_id
 * @property int $cohort
 * @property int $estado_programa_id
 * @property int $estado_titulo_id
 * @property string $resolution
 * @property string $resolution_date
 * @property string $promotion_year
 * @property string $seller
 * @property string $charge
 */
class AlumnoPrograma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alumno_programa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumno_id', 'programa_id', 'cohort', 'estado_programa_id', 'estado_titulo_id', 'resolution', 'resolution_date', 'promotion_year', 'seller', 'charge'], 'required'],
            [['id', 'alumno_id', 'programa_id', 'cohort', 'estado_programa_id', 'estado_titulo_id'], 'integer'],
            [['resolution', 'resolution_date', 'promotion_year', 'seller', 'charge'], 'string'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alumno_id' => 'Alumno ID',
            'programa_id' => 'Programa ID',
            'cohort' => 'Cohort',
            'estado_programa_id' => 'Estado Programa ID',
            'estado_titulo_id' => 'Estado Titulo ID',
            'resolution' => 'Resolution',
            'resolution_date' => 'Resolution Date',
            'promotion_year' => 'Promotion Year',
            'seller' => 'Seller',
            'charge' => 'Charge',
        ];
    }
}
